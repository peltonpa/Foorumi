<?php

require 'app/models/ketju.php';
require 'app/models/viesti.php';
require 'app/models/alue.php';
require 'app/models/kayttaja.php';
require 'app/models/tagi.php';

class KetjuController extends BaseController {

    public static function index() {
        $ketjut = Ketju::all();

        View::make('ketju/ketju.html', array('ketjut' => $ketjut));
    }

    public static function show($id) {
        $tagit = Tagi::ketjunTagit($id);
        $otsikko = Ketju::find($id)->otsikko;
        $kirjoittajat = Kayttaja::all();
        $kirjoittajienNimet = array();
        $ketju = Ketju::find($id);

        foreach ($kirjoittajat as $kirjoittaja) {
            $kirjoittajienNimet[] = $kirjoittaja->nimi;
        }
        $viestit = Viesti::ketjun_viestit($id);

        View::make('ketju/ketju.html', array('tagit' => $tagit, 'viestit' => $viestit, 'otsikko' => $otsikko, 'ketjuid' => $id, 'kirjoittajat' => $kirjoittajienNimet, 'ketju' => $ketju));
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
            'otsikko' => $params['otsikko'],
            'perustaja' => $params['perustaja']
        ));

        $errors = $ketju->errors();

        $viesti = new Viesti(array(
            'kayttajaId' => $params['perustaja'],
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

    public static function edit($id) {
        self::check_logged_in();
        $ketju = Ketju::find($id);
        $tagit = Tagi::all();
        View::make('/ketju/ketjuedit.html', array('ketju' => $ketju, 'tagit' => $tagit));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        
        $tagit = $params['tagi'];
        
        $attributes = array(
            'id' => $id,
            'alueId' => $params['alueid'],
            'otsikko' => $params['otsikko'],
            'viimeinenViestiPaivays' => $params['viimeinenviestipaivays'],
            'perustaja' => $params['perustaja']
        );

        $ketju = new Ketju($attributes);
        $palautusketju = Ketju::find($id);
        $errors = $ketju->errors();

        if (count($errors) > 0) {
            View::make('/ketju/ketjuedit.html', array('errors' => $errors, 'attributes' => $attributes, 'ketju' => $palautusketju));
        } else {
            $ketju->update();
            $ketju->poistaTagit();
            
            foreach ($tagit as $tagi) {
                $tag = Tagi::find($tagi);
                $tag->save($ketju->id);
            }

            Redirect::to('/ketju/' . $params['id'], array('onnistui' => 'Ketjua muokattiin onnistuneesti.'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $ketju = new Ketju(array('id' => $id));
        $ketju->destroy();

        Redirect::to('/etusivu', array('onnistui' => 'Ketju poistettu.'));
    }

}
