<?php

require 'app/models/alue.php';

class AlueController extends BaseController {
    
    public static function index() {
        $alueet = Alue::all();
        
        View::make('etusivu.html', array('alueet' => $alueet));
    }
    
}
