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
            View::make('kayttaja/kirjautuminen.html', array('error' => 'Väärä käyttäjätunnus tai salasana.'));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/', array('kirjautuminenOnnistui' => 'Sisäänkirjautuminen onnistui, ' . $user->nimi . '.'));
        }
    }

    public static function rekisterointi() {
        View::make('/kayttaja/rekisteroidy.html');
    }
    
    public static function rekisteroidy() {
        if(isset($_SESSION['user'])) {
            Redirect::to('/', array('error' => 'Et voi rekisteröidä uutta käyttäjätunnusta kirjautuneena.'));
        }
        $params = $_POST;
        $nimi = $params['nimi'];
        $salasana = $params['password'];
        
        if(Kayttaja::findNimi($nimi)) {
            Redirect::to('/rekisteroidy', array('error' => 'Käyttäjänimi "' . $nimi . '" on jo varattu.'));
        }
        
        $kayttaja = new Kayttaja(array(
           'nimi' => $nimi,
            'password' => $salasana
        ));
        
        $errors = $kayttaja->errors();
        
        if (count($errors) == 0) {
            $kayttaja->save();
            
            Redirect::to('/', array('onnistui' => "Rekisteröinti onnistui, voit nyt kirjautua sisään käyttäjätunnuksillasi."));
        } else {
            Redirect::to('/rekisteroidy', array('error' => $errors));
        }
        
    }

}
