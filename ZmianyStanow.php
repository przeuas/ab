<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `ZmianyStanow` (IdPostepowania, DataZmiany, IdStanu) values ";
$query = $sql;


for ($i = 0; $i < $config['zmianyStanow']; $i++) {
    $idPostepowania = rand(1, $config['postepowania']);
    $dataZmiany = rand(time() - 11100000, time());
    $idStanu = array_rand($config['stany']);
    $query .= "('" . $idPostepowania . "','" . date('Y-m-d', $dataZmiany) . "','" . $idStanu . "'),";

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

check($prep,$i,"ZmianyStanow");
