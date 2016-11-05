<?php

function check($prep,$rekords, $name){
    if ($prep) {
        echo "\033[32m \n  Dodano " . $rekords . " rekordow do tabeli ".$name."\e[0m \n";
    } else {
        echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli ".$name."\e[0m \n";

    }
}
$config = include('config.php');
require_once 'vendor/autoload.php';
require_once 'dbConnection.php';
require_once 'DeleteDatabase.php';
require_once 'Miasta.php';
require_once 'Stany.php';
require_once 'Rodzaje.php';
require_once 'Podmioty.php';
require_once 'Dlugi.php';
require_once 'Upowaznienia.php';
require_once 'TypyWindykatorow.php';
require_once 'Windykatorzy.php';
require_once 'Postepowania.php';
require_once 'Ponaglenia.php';
require_once 'faktury.php';
require_once 'BierzeUdzial.php';
require_once 'Ugody.php';
require_once 'Pozwy.php';
require_once 'ZmianyStanow.php';













