<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../database.php";
require "../models/Impfwilliger.php";

$queryString = strstr($_SERVER['REQUEST_URI'], '?');
$query_array = explode("&", $queryString);

// Open DB Connection
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
if($json !== false) {
    header("HTTP/1.0 200 OK");
   echo $json;
} else {
    header("HTTP/1.0 404 Not Found");
    echo json_encode(" Es konnten keine Impfwilligen gefunden werden ");
}

// echo $json;





