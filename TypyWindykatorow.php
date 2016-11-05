<?php

$typyWindykatora = [
    'typ1',
    'typ2',
    'typ3',
    'typ4',
];

$typyWindykatora_ti = "";
foreach ($typyWindykatora as $typ) {
    $typyWindykatora_ti .= "('" . $typ. "'),";
}

$typyWindykatora_ti = substr($typyWindykatora_ti, 0, -1);

$query = "INSERT INTO `TypyWindykatorow` (NazwaTypuWindykatora) VALUE $typyWindykatora_ti";
$prep = $pdo->prepare($query);

if ($prep->execute()) {
    echo "\033[32m \n  Dodano " . sizeof($typyWindykatora) . " rekordow do tabeli TypyWindykatorow \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli TypyWindykatorow \e[0m \n";
    print_r($pdo->errorInfo());
}

