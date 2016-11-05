<?php

require_once 'vendor/autoload.php';

$miasta = [];
$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Miasta` (NazwaMiasta) values ";
$query = $sql;


for ($i = 0; $i < $config['city']; $i++) {
    $added = false;
    $query .= "('" . $faker->city() . "'),";
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
    echo "\033[32m \n  Dodano " . $i . " rekordow do tabeli Miasta \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Miasta \e[0m \n";

}
