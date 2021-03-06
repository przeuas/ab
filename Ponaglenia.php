<?php

require_once 'vendor/autoload.php';

$miasta = [];
$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Ponaglenia` (IdPostepowania, DataWyslania, PotwierdzenieOdbioru, KosztObslugi) values ";
$query = $sql;


for ($i = 0; $i < $config['ponaglenia']; $i++) {
    $added = false;
    $idPostepowania = rand(1, $config['postepowania']);
    $dataWysłania = rand(time() - 10000, time());
    $potwierdzenieObioru = random_int(0, 1);
    $kosztObslugi = rand(10, 10000);

    $query .= "('" . $idPostepowania . "','" . date('Y-m-d', $dataWysłania) . "','" . $potwierdzenieObioru . "','" . $kosztObslugi . "'),";

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
check($prep,$i,"Ponaglenia");
