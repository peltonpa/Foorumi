<?php

require 'app/models/alue.php';
require 'app/models/viesti.php';
require 'app/models/ketju.php';

class ViestiController extends BaseController {
    
    public static function index() {
        $viestit = Viesti::all();
        
        View::make('etusivu.html', array('viestit' => $viestit));
    }
    
    public static function store() {
        $params = $_POST;
        
        $viesti = new Viesti(array(
            'ketjuId' => $params['ketjuid'],
            'kayttajaId' => $params['kayttajaid'],
            'sisalto' => $params['sisalto']
        ));
        
        Kint::dump($params);
        
        $viesti->save();
        
        Redirect::to('/ketju/' . $params['ketjuid'], array('onnistui' => "Viestin lähetys onnistui"));
    }
    
}
