<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Upowaznienia` (IdDlugu, DataWydania, DataObowiazywania) values ";
$query = $sql;

for ($i = 0; $i < $config['upowaznienia']; $i++) {
    $idDlugu = rand(1, $config['dlugi']);
    $dataWydania = time();
    $dataObowiazywania = rand($dataWydania, $dataWydania + 315360000);
    $query .= "(" . $idDlugu . ",'" . date('Y-m-d', $dataWydania) . "','" . date('Y-m-d', $dataObowiazywania) . "'),";

}
$prep = $pdo->prepare(substr($query, 0, -1))->execute();


if ($config['upowaznienia'] > 1000) {
    $added = false;
    for ($i = 0; $i < $config['upowaznienia']; $i++) {
        $idDlugu = rand(1, $config['dlugi']);
        $dataWydania = time();
        $dataObowiazywania = rand($dataWydania, $dataWydania + 315360000);
        $query .= "(" . $idDlugu . ",'" . date('Y-m-d', $dataWydania) . "','" . date('Y-m-d', $dataObowiazywania) . "'),";
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
} else {
    for ($i = 0; $i < $config['upowaznienia']; $i++) {
        $idDlugu = rand(1, $config['dlugi']);
        $dataWydania = time();
        $dataObowiazywania = rand($dataWydania, $dataWydania + 315360000);
        $query .= "(" . $idDlugu . ",'" . date('Y-m-d', $dataWydania) . "','" . date('Y-m-d', $dataObowiazywania) . "'),";
    }
    $prep = $pdo->prepare(substr($query, 0, -1))->execute();

}
if ($prep) {
    echo "\033[32m \n  Dodano " . $i . " rekordow do tabeli Upowaznienia \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Upowaznienia \e[0m \n";

}
