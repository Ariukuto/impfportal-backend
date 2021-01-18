<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "./database.php";
require "./models/Impfwilliger.php";

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new PDO('mysql:host=localhost;dbname=impfportal', 'root', 'root');
$sql = "SELECT * FROM impfwillige";
$data = [];
foreach ($database->query($sql) as $row) {
    $data[] = $row;
}
if(count($data) > 0) {
    echo json_encode($data);
} else {
    echo "Es konnten keine impfwilligen gefunden werden";
}


