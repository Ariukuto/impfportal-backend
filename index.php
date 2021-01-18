<?php

require "./functions/createPasswordHash.php";
require "./functions/getDataFromUrl.php";
require "./createApiKey.php";
require "./database.php";
require "./models/Impfwilliger.php";


$data = getDataFromUrl($_REQUEST);
$passwordhash = createPasswordHash($data["password"]);
$apikey = createApiKey();
$listennummer = getListenNummer($data);
$dbConnection = new Database();
$impfwilliger = new Impfwilliger($dbConnection);
$impfwilliger->create(
    $data["email"],
    $data["ausweisnummer"],
    $data["vorname"],
    $data["nachname"],
    $data["bday"],
    $passwordhash,
    $apikey,
    $listennummer
);
