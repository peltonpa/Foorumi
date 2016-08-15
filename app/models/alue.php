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
        $query->execute();

        $row = $query->fetch();

        if ($row) {
            $alue = new Alue(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }

        return $alue;
    }

}
