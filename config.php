<?php
$hostName = "localhost";
$username = "amsgnid_cij";
$password = "apasajaboleh";
$databaseName = "amsgnid_canijailbreak";

$connection = new mysqli($hostName,$username,$password,$databaseName);
if (!$connection) {
    die("Error in database connection". $connection->connect_error);
}
?>
