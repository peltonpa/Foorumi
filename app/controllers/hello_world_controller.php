<?php

require 'app/models/viesti.php';
require 'app/models/alue.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('suunnitelmat/etusivu.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        $alue = Alue::find(1);
        $alueet = Alue::all();

        Kint::dump($alue);
        Kint::dump($alueet);
        View::make('helloworld.html');
    }

    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function keskustelualue() {
        View::make('alue/keskustelualue.html');
    }

    public static function ketju() {
        View::make('suunnitelmat/ketju.html');
    }

    public static function kirjautuminen() {
        View::make('suunnitelmat/kirjautuminen.html');
    }

}
