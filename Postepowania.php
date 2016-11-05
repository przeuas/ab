<?php

$sql = "INSERT INTO `Postepowania` (IdUpowaznienia, IdRodzaju) VALUE ";
$query =$sql;


for($i=0;$i<$config['postepowania']; $i++){
    $idUpowaznienia = rand(1, $config['upowaznienia']);
    $idRodzaju = rand(1, sizeof($config['rodzaje']));
    $query.="('".$idUpowaznienia."','".$idRodzaju."'),";
}
$prep = $pdo->prepare(substr($query, 0, -1))->execute();

check($prep,$i,"Postepowania");

