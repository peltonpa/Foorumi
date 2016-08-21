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
        
        View::make('ketju/ketju.html', array('viestit' => $viestit, 'otsikko' => $otsikko, 'kirjoittajat' => $kirjoittajienNimet));
    }
    
}