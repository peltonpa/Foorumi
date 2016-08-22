<?php

require 'app/models/alue.php';
require 'app/models/kayttaja.php';
require 'app/models/ketju.php';
require 'app/models/viesti.php';

class KayttajaController extends BaseController {

    public static function kirjaudu() {
        View::make('/kayttaja/kirjautuminen.html');
    }

    public static function kasittele() {
        $params = $_POST;

        $nimi = $params['nimi'];
        $password = $params['password'];

        $user = Kayttaja::authenticate($nimi, $password);

        
        if (!$user) {
            View::make('kayttaja/kirjautuminenh.tml', array('error' => 'Väärä käyttäjätunnus tai salasana.'));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/', array('kirjautuminenOnnistui' => 'Sisäänkirjautuminen onnistui, ' . $user->nimi . '.'));
        }
    }

}
