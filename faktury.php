<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Faktury` (DataWystawienia, IdPostepowania, NumerFaktury, TerminPlatnosci) values ";
$query = $sql;


for ($i = 0; $i < $config['faktury']; $i++) {
    $added=false;
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

check($prep,$i,"Faktury");

