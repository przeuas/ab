<?php

$rodzaje = [
    'Windykacja powiernicza',
    'Windykacja powiernicza z zaliczką',
    'Windykacja na zlecenie',
    'Windykacja na zlecenie polubowna',
];

$rodzaje_ti = "";
foreach ($rodzaje as $rodzaj) {
    $rodzaje_ti .= "('" . $rodzaj . "'),";
}

$rodzaje_ti = substr($rodzaje_ti, 0, -1);

$query = "INSERT INTO `Rodzaje` (NazwaRodzaju) VALUE $rodzaje_ti";
$prep = $pdo->prepare($query);

if ($prep->execute()) {
    echo "\033[32m \n  Dodano " . sizeof($rodzaje) . " rekordow do tabeli Rodzaje \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Rodzaje \e[0m \n";
    print_r($pdo->errorInfo());
}

