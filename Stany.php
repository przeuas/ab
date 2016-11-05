<?php

$stany = "";
foreach ($config['stany'] as $stan) {
    $stany .= "('" . $stan . "'),";
}

$stany = substr($stany, 0, -1);

$query = "INSERT INTO `Stany` (NazwaStanu) VALUE $stany";
$prep = $pdo->prepare($query)->execute();

check($prep,$i,"Stany");
