<?php
$host = "localhost";
$user = "Ndayiragije";
$pass = "222015155";
$database = "winformatiomsystem";

$connection = new mysqli($host, $user, $pass, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}