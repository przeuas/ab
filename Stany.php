<?php

$stany = [
    'rozpoczete',
    'zakonczone',
    'w trakcie egzekucji komorniczej',
    'postepowanie sadowe',
    'przedawione',
    'stanx',
    'stany',
    'stanz'
];

$stany_ti = "";
foreach ($stany as $stan) {
    $stany_ti .= "('" . $stan . "'),";
}

$stany_ti = substr($stany_ti, 0, -1);

$query = "INSERT INTO `Stany` (NazwaStanu) VALUE $stany_ti";
$prep = $pdo->prepare($query)->execute();

if ($prep) {
    echo "\033[32m \n  Dodano " . sizeof($stany) . " rekordow do tabeli Stany \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Stany \e[0m \n";

}

