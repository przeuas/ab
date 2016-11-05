<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Faktury` (DataWystawienia, IdPostepowania, NumerFaktury, TerminPlatnosci) values ";
$query = $sql;

if ($config['faktury'] > 1000) {
    $added = false;
    for ($i = 0; $i < $config['faktury']; $i++) {
        $dataWystawienia = rand(time() - 100000, time() - 1);
        $idPostepowania = rand(1, $config['postepowania']);
        $numerFaktury = $faker->randomNumber();
        $terminPlatnosc = $dataWystawienia + 60 * 60 * 24 * 31;
        $query .= "('" . date('Y-m-d', $dataWystawienia) . "','" . $idPostepowania . "','" . $numerFaktury . "','" . date('Y-m-d', $terminPlatnosc) . "'),";
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
    for ($i = 0; $i < $config['faktury']; $i++) {
        $dataWystawienia = rand(time() - 100000, time() - 1);
        $idPostepowania = rand(1, $config['postepowania']);
        $numerFaktury = $faker->randomNumber();
        $terminPlatnosc = $dataWystawienia + 60 * 60 * 24 * 31;
        $query .= "('" . date('Y-m-d', $dataWystawienia) . "','" . $idPostepowania . "','" . $numerFaktury . "','" . date('Y-m-d', $terminPlatnosc) . "'),";
    }
    $prep = $pdo->prepare(substr($query, 0, -1))->execute();
}
if ($prep) {
    echo "\033[32m \n  Dodano " . $i . " rekordow do tabeli Faktury \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Faktury \e[0m \n";

}
