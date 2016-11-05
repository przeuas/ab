<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Pozwy` (IdPostepowania, DataRozpoczecia, NazwaSadu, KosztObslugi) values ";
$query = $sql;


for ($i = 0; $i < $config['pozwy']; $i++) {
    $idPostepowania = rand(1, $config['postepowania']);
    $dataRozpoczecia = rand(time() - 11100000, time());
    $nazwaSadu = $faker->company;
    $koszObslugi = rand(10, 10000);
    $query .= "(" . $idPostepowania . ",'" . date('Y-m-d', $dataRozpoczecia) . "','" . $nazwaSadu . "','" . $koszObslugi . "'),";

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
    echo "\033[32m \n  Dodano " . $i . " rekordow do tabeli Pozwy\e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Pozwy \e[0m \n";

}
