<?php

require 'app/models/alue.php';
require 'app/models/viesti.php';
require 'app/models/ketju.php';

class AlueController extends BaseController {
    
    public static function index() {
        $alueet = Alue::all();
        $ketjut = haeEnsimmaiset();
        View::make('etusivu.html', array('alueet' => $alueet, 'ketjut' => $ketjut));
    }
    
    public static function show($id) {
        $nimi = Alue::get_nimi($id);
        $ketjut = Ketju::alueen_ketjut($id);
        
        View::make('alue/keskustelualue.html', array('ketjut' => $ketjut, 'nimi' => $nimi, 'alueid' => $id));
        
    }
    
    public static function haeEnsimmaiset() {
        $ketjut = array();
        $alueet = Alue::all();
        foreach($alueet as $alue) {
            $ketjulista = Ketju::alueen_ketjut($alue->id);
            $ketjut[] = $ketjulista[0];
        }
        return $ketjut;
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