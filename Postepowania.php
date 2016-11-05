<?php

$sql = "INSERT INTO `Postepowania` (IdUpowaznienia, IdRodzaju) VALUE ";
$query =$sql;


for($i=0;$i<$config['postepowania']; $i++){
    $idUpowaznienia = rand(1, $config['upowaznienia']);
    $idRodzaju = rand(1, sizeof($config['rodzaje']));
    $query.="('".$idUpowaznienia."','".$idRodzaju."'),";
}
$prep = $pdo->prepare(substr($query, 0, -1));



if ($prep->execute()) {
    echo "\033[32m \n  Dodano " . $config['postepowania'] . " rekordow do tabeli TypyWindykatorow \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli TypyWindykatorow \e[0m \n";
    print_r($pdo->errorInfo());
}

