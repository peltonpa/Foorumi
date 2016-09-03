<?php

class Tagi extends BaseModel {

    public $id, $tagi, $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_sisalto');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tagi');
        $query->execute();

        $rows = $query->fetchAll();
        $tagit = array();

        foreach ($rows as $row) {
            $tagit[] = new Tagi(array(
                'id' => $row['id'],
                'tagi' => $row['tagi']
            ));
        }

        return $tagit;
    }

    public static function ketjunTagit($id) {
        $query = DB::connection()->prepare('SELECT tagiId FROM Tagiliitos WHERE ketjuId = :id');
        $query->execute(array('id' => $id));

        $tagit = array();

        $rows = $query->fetchAll();

        if ($rows) {
            foreach ($rows as $row) {
                $tagi = self::find($row['tagiid']);
                $tagit[] = $tagi;
            }
        }

        return $tagit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tagi WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $tagi = new Tagi(array(
                'id' => $row['id'],
                'tagi' => $row['tagi']
            ));
        }

        return $tagi;
    }
    
    public function save($ketjuid) {
        $query = DB::connection()->prepare('INSERT INTO Tagiliitos (ketjuId, tagiId) VALUES (:ketjuid, :tagiid)');
        $query->execute(array('ketjuid' => $ketjuid, 'tagiid' => $this->id));
    }

}
