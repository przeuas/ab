<?php

require_once 'vendor/autoload.php';

$miasta = [];
$faker = Faker\Factory::create($config['language']);

$sql = "INSERT INTO `Miasta` (NazwaMiasta) values ";
$query = $sql;


for ($i = 0; $i < $config['city']; $i++) {
    $added = false;
    $query .= "('" . $faker->city() . "'),";
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

check($prep,$i,"Miasta");
