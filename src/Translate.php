<?php

namespace Gruppe\Petlocator;

class Translate{

    public static function translate(int $code) : string{
        if (isset($_SESSION['lang'])) {
            if ($_SESSION['lang'] == "de") {
                return $_SESSION['parsed']['files'][1]['trans-units'][$code]['target']['raw-content'];
            } elseif ($_SESSION['lang'] == "es") {
                return $_SESSION['parsedEs']['files'][1]['trans-units'][$code]['target']['raw-content'];
            } elseif ($_SESSION['lang'] == "fr") {
                return $_SESSION['parsedFr']['files'][1]['trans-units'][$code]['target']['raw-content'];
            } elseif ($_SESSION['lang'] == "pl") {
                return $_SESSION['parsedPl']['files'][1]['trans-units'][$code]['target']['raw-content'];
            } else {
                return $_SESSION['parsed']['files'][1]['trans-units'][$code]['source']['raw-content'];
            }
        }
        return $_SESSION['parsed']['files'][1]['trans-units'][$code]['source']['raw-content'];
    }

}