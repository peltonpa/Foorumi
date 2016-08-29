<?php

require 'app/models/ketju.php';
require 'app/models/viesti.php';
require 'app/models/alue.php';
require 'app/models/kayttaja.php';

class KetjuController extends BaseController {

    public static function index() {
        $ketjut = Ketju::all();

        View::make('ketju/ketju.html', array('ketjut' => $ketjut));
    }

    public static function show($id) {
        $otsikko = Ketju::get_otsikko($id);
        $kirjoittajat = Kayttaja::all();
        $kirjoittajienNimet = array();

        foreach ($kirjoittajat as $kirjoittaja) {
            $kirjoittajienNimet[] = $kirjoittaja->nimi;
        }
        $viestit = Viesti::ketjun_viestit($id);

        View::make('ketju/ketju.html', array('viestit' => $viestit, 'otsikko' => $otsikko, 'ketjuid' => $id, 'kirjoittajat' => $kirjoittajienNimet));
    }

    public static function uusiketju($id) {
        self::check_logged_in();
        View::make('alue/uusiketju.html', array('alueid' => $id));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $ketju = new Ketju(array(
            'alueId' => $params['alueid'],
            'otsikko' => $params['otsikko']
        ));

        $errors = $ketju->errors();

        $viesti = new Viesti(array(
            'kayttajaId' => $params['kayttajaid'],
            'sisalto' => $params['sisalto']
        ));

        $errors = array_merge($errors, $viesti->errors());
        
        if (count($errors) == 0) {
            $ketju->save();
            $viesti->ketjuId = $ketju->id;
            $viesti->save();
            Redirect::to('/ketju/' . $ketju->id, array('onnistui' => "Uusi aihe luotiin onnistuneesti."));
        } else {
            Redirect::to('/alue/' . $params['alueid'], array('errors' => $errors));
        }
    }
    
    

}
