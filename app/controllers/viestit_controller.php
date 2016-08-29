<?php

require 'app/models/alue.php';
require 'app/models/viesti.php';
require 'app/models/ketju.php';

class ViestiController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $viestit = Viesti::all();

        View::make('etusivu.html', array('viestit' => $viestit));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $viesti = new Viesti(array(
            'ketjuId' => $params['ketjuid'],
            'kayttajaId' => $params['kayttajaid'],
            'sisalto' => $params['sisalto']
        ));

        $errors = $viesti->errors();

        if (count($errors) == 0) {
            $viesti->save();

            Redirect::to('/ketju/' . $params['ketjuid'], array('onnistui' => "Viestin lähetys onnistui"));
        } else {
            Redirect::to('/ketju/' . $params['ketjuid'], array('errors' => $errors));
        }
    }
    
    public static function edit($id) {
        self::check_logged_in();
        $viesti = Viesti::find($id);
        View::make('/viesti/edit.html', array('viesti' => $viesti));
    }
    
    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        
        $attributes = array(
            'id' => $id,
            'ketjuId' => $params['ketjuid'],
            'kayttajaId' => $params['kayttajaid'],
            'sisalto' => $params['sisalto'],
            'paivays' => $params['paivays']
        );
        
        $viesti = new Viesti($attributes);
        $palautusviesti = Viesti::find($id);
        $errors = $viesti->errors();
        
        if(count($errors) > 0) {
            View::make('/viesti/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'viesti' => $palautusviesti));
        } else {
            $viesti->update();
            
            Redirect::to('/ketju/' . $params['ketjuid'], array('onnistui' => 'Viestiä muokattiin onnistuneesti.'));
        }        
    }
    
    public static function destroy($id) {
        self::check_logged_in();
        $viesti = new Viesti(array('id' => $id));
        $viesti->destroy();
        
        Redirect::to('/etusivu', array('onnistui' => 'Viesti poistettu.'));
    }
    

}
