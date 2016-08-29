<?php

class BaseController {

    public static function get_user_logged_in() {
        // Toteuta kirjautuneen käyttäjän haku tähän
        return null;
    }

    public static function check_logged_in() {
        if(!isset($_SESSION['user'])) {
            Redirect::to('/kirjautuminen', array('error' => 'Kirjaudu ensin sisään!'));
        }
    }
    
    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/kirjautuminen', array('ulos' => 'Olet kirjautunut ulos!'));
    }

}
