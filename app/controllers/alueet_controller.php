<?php

require 'app/models/alue.php';
require 'app/models/viesti.php';
require 'app/models/ketju.php';

class AlueController extends BaseController {
    
    public static function index() {
        $alueet = Alue::all();
        
        View::make('etusivu.html', array('alueet' => $alueet));
    }
    
    public static function show($id) {
        $alue = Alue::find($id);
        $nimi = array();
        $nimi = $alue->nimi;
        $ketjut = Ketju::all();
        
        View::make('alue/keskustelualue.html', array('ketjut' => $ketjut));
        
    }
    
}
