<?php

class Kayttaja extends BaseModel {

    public $id, $nimi, $luomispaivamaara, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (nimi, luomispaivamaara, password) VALUES (:nimi, :luomispaivamaara, :password) RETURNING id ');
        $query->execute(array('nimi' => $this->nimi, 'luomispaivamaara' => $this->luomispaivamaara, 'password' => $this->password));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();

        $rows = $query->fetchAll();
        $kayttajat = array();

        foreach ($rows as $row) {
            $kayttajat[] = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'luomispaivamaara' => $row['luomispaivamaara'],
                'password' => $row['password']
            ));
        }
        return $kayttajat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'luomispaivamaara' => $row['luomispaivamaara'],
                'password' => $row['password']
            ));
        }
        return $kayttaja;
    }

    public static function authenticate($nimi, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND password = :password LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'luomispaivamaara' => $row['luomispaivamaara'],
                'password' => $row['password']
            ));
            return $kayttaja;
        } else {
            return null;
        }
         
         
    }

}
