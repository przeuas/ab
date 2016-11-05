<?php

$typyWindykatora = "";
foreach ($config['typyWindykatorow'] as $typ) {
    $typyWindykatora .= "('" . $typ. "'),";
}

$typyWindykatora = substr($typyWindykatora , 0, -1);

$query = "INSERT INTO `TypyWindykatorow` (NazwaTypuWindykatora) VALUE $typyWindykatora";
$prep = $pdo->prepare($query)->execute();

check($prep,$config['typyWindykatorow'],"typyWindykatora");
