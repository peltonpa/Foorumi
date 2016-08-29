<?php

require 'app/models/alue.php';
require 'app/models/viesti.php';
require 'app/models/ketju.php';

class AlueController extends BaseController {
    
    public static function index() {
        self::check_logged_in();
        $alueet = Alue::all();
        View::make('etusivu.html', array('alueet' => $alueet));
    }
    
    public static function show($id) {
        self::check_logged_in();
        $nimi = Alue::get_nimi($id);
        $ketjut = Ketju::alueen_ketjut($id);
        
        View::make('alue/keskustelualue.html', array('ketjut' => $ketjut, 'nimi' => $nimi, 'alueid' => $id));
        
    }
    
    public static function sandbox() {
        self::check_logged_in();
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