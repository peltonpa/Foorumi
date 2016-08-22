<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        $errors = array();

        foreach ($this->validators as $validator) {
            $error = $this->{$validator}();
            if (count($error) > 0) {
                foreach($error as $err) {
                    $errors[] = $err;
                }
            }
        }
        return $errors;
    }

    public static function string_pituus($validoitava, $pituus) {
        if (strlen($validoitava) > $pituus || strlen($validoitava) === 0) {
            return false;
        }
        return true;
    }

}
