<?php

class Ketju extends BaseModel {

    public $id, $alueId, $otsikko;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Ketju (alueId, otsikko) VALUES (:alueId, :otsikko) RETURNING id');
        
        $query->execute(array('alueId' => $this->alueId, 'otsikko' => $this->otsikko));
        
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
                'otsikko' => $row['otsikko']
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
                'otsikko' => $row['otsikko']
            ));

            return $ketju;
        }
    }

    public static function alueenKetjut($id) {
        $ketjut = self::all();
        $palautusketjut = array();
        
        foreach ($ketjut as $ketju) {
            if ($ketju->alueId == $id) {
                $palautusketjut[] = $ketju;
            }
        }

        return $palautusketjut;
    }

}
