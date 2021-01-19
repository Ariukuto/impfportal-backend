<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "./database.php";
require "./models/Impfwilliger.php";

$queryString = strstr($_SERVER['REQUEST_URI'], '?');
$query_array = explode("&", $queryString);


// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if($query_array[0] ===  "?impfwilliger") {
    if($query_array[1] === "getall") {
        $impfwilliger = new Impfwilliger($connection);
        $json = json_encode($impfwilliger->getAll());
        echo $json;
    }
}



