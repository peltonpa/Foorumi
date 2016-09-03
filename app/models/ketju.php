<?php

class Ketju extends BaseModel {

    public $id, $alueId, $otsikko, $viimeinenViestiPaivays, $perustaja, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_sisalto');
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Ketju (alueId, otsikko, viimeinenViestiPaivays, perustaja) VALUES (:alueId, :otsikko, :viimeinenViestiPaivays, :perustaja) RETURNING id');
        $query->execute(array('alueId' => $this->alueId, 'otsikko' => $this->otsikko, 'viimeinenViestiPaivays' => date("M Y d h:i:s"), 'perustaja' => $this->perustaja));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Ketju');

        $query->execute();

        $rows = $query->fetchAll();
        $ketjut = array();

        foreach ($rows as $row) {
            $ketjut[] = new Ketju(array(
                'id' => $row['id'],
                'alueId' => $row['alueid'],
                'otsikko' => $row['otsikko'],
                'viimeinenViestiPaivays' => $row['viimeinenviestipaivays'],
                'perustaja' => $row['perustaja']
            ));
        }
        return $ketjut;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Ketju WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $ketju = new Ketju(array(
                'id' => $row['id'],
                'alueId' => $row['alueid'],
                'otsikko' => $row['otsikko'],
                'viimeinenViestiPaivays' => $row['viimeinenviestipaivays'],
                'perustaja' => $row['perustaja']
            ));

            return $ketju;
        }

        return null;
    }

    public static function alueen_ketjut($id) {
        $ketjut = self::all();
        $palautusketjut = array();

        foreach ($ketjut as $ketju) {
            if ($ketju->alueId == $id) {
                $palautusketjut[] = $ketju;
            }
        }

        if (!function_exists("comp")) {

            function comp($a, $b) {
                if ($a->viimeinenViestiPaivays > $b->viimeinenViestiPaivays) {
                    return 1;
                } else {
                    return -1;
                }
            }

        }
        usort($palautusketjut, "comp");

        return $palautusketjut;
    }
    
    public function poistaTagit() {
        $query = DB::connection()->prepare('DELETE FROM Tagiliitos WHERE ketjuId = :id');
        $query->execute(array('id' => $this->id));
    }

    public static function get_otsikko($id) {
        $ketju = self::find($id);
        return $ketju->otsikko;
    }

    public function validoi_sisalto() {
        $errors = array();
        if ($this->otsikko == '') {
            $errors[] = 'Otsikko ei saa olla tyhjä.';
        }
        if (strlen($this->otsikko) > 39) {
            $errors[] = 'Otsikon maksimipituus 40 merkkiä.';
        }
        return $errors;
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Ketju WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function updatePaivays($aika) {
        $query = DB::connection()->prepare('UPDATE Ketju SET viimeinenViestiPaivays = :viimeinenViestiPaivays WHERE ID = :id');
        $query->execute(array('id' => $this->id, 'viimeinenViestiPaivays' => $aika));
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Ketju SET otsikko = :otsikko WHERE ID = :id');
        $query->execute(array('id' => $this->id, 'otsikko' => $this->otsikko));
    }

}
