<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Dlugi` (IdDluznika, IdWierzyciela, KwotaZobowiazania, DataPowstania, DataPlanowanejSplaty, KosztObslugi, Waluta, Odsetki) values ";
$query = $sql;

function idWierzyciela($idDluznika, $podmioty)
{
    $idWierzyciela = rand(1, $podmioty);
    while ($idDluznika == $idWierzyciela) {
        $idWierzyciela = rand(1, $podmioty);
    }
    return $idWierzyciela;
}


for ($i = 0; $i < $config['dlugi']; $i++) {
    $idDluznika = rand(1, $config['podmioty']);
    $idWierzyciela = idWierzyciela($idDluznika, $config['podmioty']);
    $kwotaZobowiązania = number_format((float)rand(1, rand(100, 1000000000)) / rand(10, 100), 2, '.', '');
    $dataPowstania = time();
    $dataPlanowanejSplaty = rand($dataPowstania + 1, $dataPowstania + 315360000);
    $koszObslugi = number_format((float)rand(1, rand(100, 100000)) / rand(10, 100), 2, '.', '');
    //TODO koszt obliczany za pomoca kwotaZobowiazania * Odestki + kwotaZobowiazania?
    $waluta = $config['waluta'][array_rand($config['waluta'])];
    $Odsetki = rand(1, 10000);
    $query .= "('" . $idDluznika . "','" . $idWierzyciela . "','" . $kwotaZobowiązania . "','" . date('Y-m-d', $dataPowstania) . "','" . date('Y-m-d', $dataPlanowanejSplaty) . "','" . $koszObslugi . "','" . $waluta . "','" . $Odsetki . "'),";
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

check($prep,$i,"Dlugi");

