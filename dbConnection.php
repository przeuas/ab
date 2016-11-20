<?php

$mysql_host = '127.0.0.1';
$port = '33666';
$username = 'root';
$password = 'Haslo';
$database = 'bazy';

try{
    $pdo = new PDO('mysql:host='.$mysql_host.';dbname='.$database.';charset=utf8;port='.$port, $username, $password );
    $pdo->query('SET NAMES utf8');
    $pdo -> query ('SET CHARACTER_SET utf8_unicode_ci');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    echo "\e[32m  Połączenie nawiązane! \e[0m \n";
}catch(PDOException $e){
    echo "\e[31m  Połączenie nie mogło zostać utworzone".$e->getMessage() ."[0m  \n";
}




