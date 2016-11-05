CREATE TABLE `Miasta` (
    `IdMiasta` INT NOT NULL AUTO_INCREMENT,
    `NazwaMiasta` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`IdMiasta`)
);

CREATE TABLE `Podmioty` (
    `IdPodmiotu` INT NOT NULL AUTO_INCREMENT,
    `IdMiasta` INT NOT NULL,
    `Imie` VARCHAR(40),
    `Nazwisko` VARCHAR(40),
    `NazwaFirmy` VARCHAR(40),
    `PESEL` VARCHAR(40) UNIQUE,
    `NIP` VARCHAR(40) UNIQUE,
    `REGON` VARCHAR(40) UNIQUE,
    `NrTelefonu` VARCHAR(255) NOT NULL,
    `Adres` VARCHAR(255) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `NrKonta` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`IdPodmiotu`)
);

CREATE TABLE `Dlugi` (
    `IdDlugu` INT NOT NULL AUTO_INCREMENT,
    `IdDluznika` INT NOT NULL,
    `IdWierzyciela` INT NOT NULL,
    `KwotaZobowiazania` FLOAT(15,2) NOT NULL,
    `DataPowstania` DATE NOT NULL,
    `DataPlanowanejSplaty` DATE NOT NULL,
    `KosztObslugi` FLOAT NOT NULL,
    `Waluta` VARCHAR(3) NOT NULL,
    `Odsetki` FLOAT NOT NULL,
    PRIMARY KEY (`IdDlugu`)
);

CREATE TABLE `Upowaznienia` (
    `IdUpowaznienia` INT NOT NULL AUTO_INCREMENT,
    `IdDlugu` INT NOT NULL,
    `DataWydania` DATE NOT NULL,
    `DataObowiazywania` DATE NOT NULL,
    PRIMARY KEY (`IdUpowaznienia`)
);

CREATE TABLE `Postepowania` (
    `IdPostepowania` INT NOT NULL AUTO_INCREMENT,
    `IdUpowaznienia` INT NOT NULL,
    `IdRodzaju` INT NOT NULL,
    PRIMARY KEY (`IdPostepowania`)
);

CREATE TABLE `Rodzaje` (
    `IdRodzaju` INT NOT NULL AUTO_INCREMENT,
    `NazwaRodzaju` VARCHAR(40) NOT NULL UNIQUE,
    PRIMARY KEY (`IdRodzaju`)
);

CREATE TABLE `Faktury` (
    `IdFaktury` INT NOT NULL AUTO_INCREMENT,
    `DataWystawienia` DATE NOT NULL,
    `IdPostepowania` INT NOT NULL,
    `NumerFaktury` VARCHAR(15) NOT NULL,
    `TerminPlatnosci` DATE NOT NULL,
    PRIMARY KEY (`IdFaktury`)
);

CREATE TABLE `BierzeUdzial` (
    `IdBierze` INT NOT NULL AUTO_INCREMENT,
    `IdPostepowania` INT NOT NULL,
    `IdWindykatora` INT NOT NULL,
    PRIMARY KEY (`IdBierze`)
);

CREATE TABLE `Windykatorzy` (
    `IdWindykatora` INT NOT NULL AUTO_INCREMENT,
    `Imie` VARCHAR(255) NOT NULL,
    `Nazwisko` VARCHAR(255) NOT NULL,
    `Plec` VARCHAR(1) NOT NULL,
    `DataZatrudnienia` DATE NOT NULL,
    `IdTypWindykatora` INT NOT NULL,
    `NrTelefonu` VARCHAR(255) NOT NULL,
    `Adres` VARCHAR(255) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`IdWindykatora`)
);

CREATE TABLE `TypyWindykatorow` (
    `IdTypuWindykatora` INT NOT NULL AUTO_INCREMENT,
    `NazwaTypuWindykatora` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`IdTypuWindykatora`)
);

CREATE TABLE `Pozwy` (
    `IdPozwu` INT NOT NULL AUTO_INCREMENT,
    `IdPostepowania` INT NOT NULL,
    `DataRozpoczecia` DATE NOT NULL,
    `NazwaSadu` VARCHAR(60) NOT NULL UNIQUE,
    `KosztObslugi` FLOAT NOT NULL,
    PRIMARY KEY (`IdPozwu`)
);

CREATE TABLE `ZmianyStanow` (
    `IdZmiany` INT NOT NULL AUTO_INCREMENT,
    `IdPostepowania` INT NOT NULL,
    `DataZmiany` DATE NOT NULL,
    `IdStanu` INT NOT NULL,
    PRIMARY KEY (`IdZmiany`)
);

CREATE TABLE `Stany` (
    `IdStanu` INT NOT NULL AUTO_INCREMENT,
    `NazwaStanu` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`IdStanu`)
);

CREATE TABLE `Ponaglenia` (
    `IdPonaglenia` INT NOT NULL AUTO_INCREMENT,
    `IdPostepowania` INT NOT NULL,
    `DataWyslania` DATE NOT NULL,
    `PotwierdzenieOdbioru` BOOLEAN NOT NULL,
    `KosztObslugi` FLOAT NOT NULL,
    PRIMARY KEY (`IdPonaglenia`)
);

CREATE TABLE `Ugody` (
    `IdUgody` INT NOT NULL AUTO_INCREMENT,
    `IdPostepowania` INT NOT NULL ,
    `DataZawarciaUgody` DATE NOT NULL,
    `Warunki` VARCHAR(2000) NOT NULL,
    `KosztObslugi` FLOAT NOT NULL,
    PRIMARY KEY (`IdUgody`)
);

ALTER TABLE `Podmioty` ADD CONSTRAINT `Podmioty_fk0` FOREIGN KEY (`IdMiasta`) REFERENCES `Miasta`(`IdMiasta`);

ALTER TABLE `Dlugi` ADD CONSTRAINT `Dlugi_fk0` FOREIGN KEY (`IdDluznika`) REFERENCES `Podmioty`(`IdPodmiotu`);

ALTER TABLE `Dlugi` ADD CONSTRAINT `Dlugi_fk1` FOREIGN KEY (`IdWierzyciela`) REFERENCES `Podmioty`(`IdPodmiotu`) ;

ALTER TABLE `Upowaznienia` ADD CONSTRAINT `Upowaznienia_fk0` FOREIGN KEY (`IdDlugu`) REFERENCES `Dlugi`(`IdDlugu`) ;

ALTER TABLE `Postepowania` ADD CONSTRAINT `Postepowania_fk0` FOREIGN KEY (`IdUpowaznienia`) REFERENCES `Upowaznienia`(`IdUpowaznienia`) ;

ALTER TABLE `Postepowania` ADD CONSTRAINT `Postepowania_fk1` FOREIGN KEY (`IdRodzaju`) REFERENCES `Rodzaje`(`IdRodzaju`) ;

ALTER TABLE `Faktury` ADD CONSTRAINT `Faktury_fk0` FOREIGN KEY (`IdPostepowania`) REFERENCES `Postepowania`(`IdPostepowania`) ;

ALTER TABLE `BierzeUdzial` ADD CONSTRAINT `BierzeUdzial_fk0` FOREIGN KEY (`IdPostepowania`) REFERENCES `Postepowania`(`IdPostepowania`) ;

ALTER TABLE `BierzeUdzial` ADD CONSTRAINT `BierzeUdzial_fk1` FOREIGN KEY (`IdWindykatora`) REFERENCES `Windykatorzy`(`IdWindykatora`) ;

ALTER TABLE `Windykatorzy` ADD CONSTRAINT `Windykatorzy_fk0` FOREIGN KEY (`IdTypWindykatora`) REFERENCES `TypyWindykatorow`(`IdTypuWindykatora`) ;

ALTER TABLE `Pozwy` ADD CONSTRAINT `Pozwy_fk0` FOREIGN KEY (`IdPostepowania`) REFERENCES `Postepowania`(`IdPostepowania`) ;

ALTER TABLE `ZmianyStanow` ADD CONSTRAINT `ZmianyStanow_fk0` FOREIGN KEY (`IdPostepowania`) REFERENCES `Postepowania`(`IdPostepowania`) ;

ALTER TABLE `ZmianyStanow` ADD CONSTRAINT `ZmianyStanow_fk1` FOREIGN KEY (`IdStanu`) REFERENCES `Stany`(`IdStanu`) ;

ALTER TABLE `Ponaglenia` ADD CONSTRAINT `Ponaglenia_fk0` FOREIGN KEY (`IdPostepowania`) REFERENCES `Postepowania`(`IdPostepowania`) ;

ALTER TABLE `Ugody` ADD CONSTRAINT `Ugody_fk0` FOREIGN KEY (`IdPostepowania`) REFERENCES `Postepowania`(`IdPostepowania`) ;

ALTER DATABASE `bazy` CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `Podmioty` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `BierzeUdzial` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Dlugi` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Faktury` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Miasta` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Ponaglenia` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Postepowania` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Pozwy` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Rodzaje` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Stany` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `TypyWindykatorow` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Ugody` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Upowaznienia` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `Windykatorzy` CONVERT TO CHARACTER SET utf8;
ALTER TABLE `ZmianyStanow` CONVERT TO CHARACTER SET utf8;














