<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Ugody` (IdPostepowania, DataZawarciaUgody, Warunki, KosztObslugi) values ";
$query = $sql;


for ($i = 0; $i < $config['upowaznienia']; $i++) {
    $idPostepowania = rand(1, $config['postepowania']);
    $dataZawarciaUgody = rand(time() - 13123, time());
    $warunki = $faker->text();
    $koszObslugi = rand(10, 1000);
    $query .= "(" . $idPostepowania . ",'" . date('Y-m-d', $dataZawarciaUgody) . "','" . $warunki . "','" . $koszObslugi . "'),";

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
    echo "\033[32m \n  Dodano " . $i . " rekordow do tabeli Ugody \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Ugody \e[0m \n";

}
