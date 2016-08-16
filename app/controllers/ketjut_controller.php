<?php

require 'app/models/alue.php';
require 'app/models/viesti.php';
require 'app/models/ketju.php';

class KetjuController extends BaseController {
    
    public static function index() {
        $ketjut = Ketju::all();
        
        View::make('ketju/ketju.html', array('ketjut' => $ketjut));
    }
    
    public static function show($id) {
        $nimi = Ketju::getOtsikko($id);
        $viestit = Viesti::ketjunViestit($id);
        $viestit[] = $nimi;
        
        View::make('ketju/ketju.html', array('viestit' => $viestit));
    }
    
}