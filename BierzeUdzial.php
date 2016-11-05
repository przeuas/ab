<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `BierzeUdzial` (IdPostepowania, IdWindykatora) values ";
$query = $sql;


for ($i = 0; $i < $config['city']; $i++) {
    $added = false;
    $idPostepowania = $i;
    $idWindykatora = rand(1, $config['windykatorzy']);
    $query .= "('" . $idPostepowania . "','" . $idWindykatora . "'),";
    if ($i % 1000 == 0) {
        $prep = $pdo->prepare(substr($query, 0, -1))->execute();
        $query = $sql;
        $added = true;

        if (!$prep) {
            break;
        }
    }
}
if (!$added) {
    $prep = $pdo->prepare(substr($query, 0, -1))->execute();
}

if ($prep) {
    echo "\033[32m \n  Dodano " . $i . " rekordow do tabeli BierzeUdzial \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli BierzeUdzial \e[0m \n";

}
