<?php

$rodzaje = "";
foreach ($config['rodzaje'] as $rodzaj) {
    $rodzaje .= "('" . $rodzaj . "'),";
}

$rodzaje = substr($rodzaje, 0, -1);

$query = "INSERT INTO `Rodzaje` (NazwaRodzaju) VALUE $rodzaje";
$prep = $pdo->prepare($query)->execute();

check($prep,sizeof($config['rodzaje']),"Rodzaje");

