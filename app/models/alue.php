<?php

class Alue extends BaseModel {

    public $id, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Alue');

        $query->execute();

        $rows = $query->fetchAll();
        $alueet = array();

        foreach ($rows as $row) {
            $alueet[] = new Alue(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }
        return $alueet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Alue WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $alue = new Alue(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }

        return $alue;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Alue (nimi) VALUES (:nimi) RETURNING id');
        
        $query->execute(array('nimi' => $this->nimi));
        
        $row = $query->fetch();
        
        $this->id = $row['id'];
    }

}
