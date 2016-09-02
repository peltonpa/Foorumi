<?php

require 'app/models/alue.php';
require 'app/models/viesti.php';
require 'app/models/ketju.php';

class AlueController extends BaseController {

    public static function index() {
        $alueet = Alue::all();
        foreach ($alueet as $alue) {
            $ketju = self::haeEnsimmainen($alue->id);
            $alue->viimeinenKetju = $ketju;
        }
        View::make('etusivu.html', array('alueet' => $alueet));
    }

    public static function show($id) {
        $nimi = Alue::get_nimi($id);
        $ketjut = Ketju::alueen_ketjut($id);

        View::make('alue/keskustelualue.html', array('ketjut' => $ketjut, 'nimi' => $nimi, 'alueid' => $id));
    }

    public static function haeEnsimmainen($id) {
        $ketjut = Ketju::alueen_ketjut($id);
        if ($ketjut) {
            return $ketjut[0];
        }
        return null;
    }

    public static function sandbox() {
        $viesti = new Viesti(array(
            'sisalto' => ''
        ));

        $errors = $viesti->errors();

        Kint::dump($errors);
    }

    public static function kirjautuminen() {
        View::make('kirjautuminen/kirjautuminen.html');
    }

}
