<?php

$query = "
SET FOREIGN_KEY_CHECKS = 0; -- Disable foreign key checking.
TRUNCATE TABLE BierzeUdzial;
TRUNCATE TABLE Dlugi;
TRUNCATE TABLE Faktury;
TRUNCATE TABLE Miasta;
TRUNCATE TABLE Podmioty;
TRUNCATE TABLE Ponaglenia;
TRUNCATE TABLE Postepowania;
TRUNCATE TABLE Pozwy;
TRUNCATE TABLE Rodzaje;
TRUNCATE TABLE Stany;
TRUNCATE TABLE TypyWindykatorow;
TRUNCATE TABLE Ugody;
TRUNCATE TABLE Upowaznienia;
TRUNCATE TABLE Windykatorzy;
TRUNCATE TABLE ZmianyStanow;
SET FOREIGN_KEY_CHECKS = 1; -- Enable foreign key checking.";
$delete = $pdo->prepare($query)->execute();

if ($delete) {
    echo " usunieto stare rekordy";
}