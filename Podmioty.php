<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Podmioty` (IdMiasta, Imie, Nazwisko, NazwaFirmy, PESEL, NIP, REGON, NrTelefonu, Adres, Email, NrKonta) values ";
$query = $sql;


for ($i = 0; $i < $config['podmioty']; $i++) {
    $added = false;
    $idMiasta = rand(0, $config['city']);
    $imie = $faker->name;
    $nazwisko = $faker->lastName;
    $nazwaFirmy = $faker->company;
    $pesel = $faker->pesel();
    $nip = $faker->taxpayerIdentificationNumber();
    $regon = $faker->regon();
    $nrTelefonu = $faker->phoneNumber;
    $adres = $faker->postcode . " " . $faker->streetName . " " . $faker->buildingNumber;
    $email = $faker->email;
    $nrkonta = $faker->bankAccountNumber;
    $query .= "(" . $idMiasta . ",'" . $imie . "','" . $nazwisko . "','" . $nazwaFirmy . "','" . $pesel . "','" . $nip . "','" . $regon . "','" . $nrTelefonu . "','" . $adres . "','" . $email . "','" . $nrkonta . "'),";
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

if ($prep) {
    echo "\033[32m \n  Dodano " . $i . " rekordow do tabeli Miasta \e[0m \n";
} else {
    echo "\033[31m \n  Nie udalo sie dodac rekordow do tabeli Miasta \e[0m \n";

}
