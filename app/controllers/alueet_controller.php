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
        $nimi = Alue::getNimi($id);
        $ketjut = Ketju::alueenKetjut($id);
        $ketjut[] = $nimi;
        
        View::make('alue/keskustelualue.html', array('ketjut' => $ketjut));
        
    }
    
}