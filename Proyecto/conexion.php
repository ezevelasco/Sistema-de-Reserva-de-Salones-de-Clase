<?php

$servername = "localhost";
$database = "proyecto";
$username = "root";
$password = "";


$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Falló la conexión: " . mysqli_connect_error());
}