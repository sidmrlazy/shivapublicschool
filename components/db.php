<?php
// Production
$servername = "localhost";
$username = "u976956619_sps";
$database = "u976956619_sps";
$password = "Darthvader@order66";

// Development
// $servername = "localhost";
// $username = "root";
// $database = "sps_db";
// $password = "";

// Validate Connection
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Error 404: " . $connection->connect_error);
}