<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../database.php";
require "../models/Impfwilliger.php";

$queryString = strstr($_SERVER['REQUEST_URI'], '?');
$query_array = explode("&", $queryString);

$config = json_decode(file_get_contents("../config.json"));
$db = new Database($config);
$connection = $db->connect();
$impfwilliger = new Impfwilliger($connection);

// HTTP Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

// Rückgabe
$json = json_encode($impfwilliger->getAll());
print_r($json);
// echo $json;





