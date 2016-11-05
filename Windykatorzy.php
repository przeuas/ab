<?php

require_once 'vendor/autoload.php';

$miasta = [];
$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Windykatorzy` (Imie, Nazwisko, Plec, DataZatrudnienia, IdTypWindykatora, NrTelefonu, Adres, Email) values ";
$query = $sql;

for ($i = 0; $i < $config['city']; $i++) {
    $added = false;
    $imie = $faker->name;
    $nazwisko = $faker->lastName;
    if (substr($imie, -1) == 'a') {
        $plec = "K";
    } else {
        $plec = "M";
    }
    $dataZatrudnienia = rand(time() - 100000, time());
    $idTypWindykatora = rand(1, sizeof($config['typyWindykatorow']) - 1);
    $numerTelefonu = $faker->phoneNumber;
    $adres = str_replace(',', '.', $faker->address);
    $email = $faker->email;
    $query .= "('" . $imie . "','" . $nazwisko . "','" . $plec . "','" . date('Y-m-d', $dataZatrudnienia) . "','" . $idTypWindykatora . "','" . $numerTelefonu . "','" . $adres . "','" . $email . "'),";

    if ($i % 1000 == 0) {
        $prep = $pdo->prepare(substr($query, 0, -1))->execute();
        $query = "insert into `Miasta` (NazwaMiasta) values ";
        $added = true;

        if (!$prep) {
            break;
        }
    }
}
if (!$added) {
    $prep = $pdo->prepare(substr($query, 0, -1))->execute();
}

if ($prep) {
    echo "\033[32m \n  Dodano " . $i . " rekordow do tabeli Windykatorzy \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Windykatorzy \e[0m \n";

}
