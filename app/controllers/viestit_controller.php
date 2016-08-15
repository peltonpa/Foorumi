<?php

class ViestiController extends BaseController {
    
    public static function index() {
        $viestit = Viesti::all();
        
        View::make('etusivu.html', array('viestit' => $viestit));
    }
    
}
