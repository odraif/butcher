<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$port = 3306;
$DBname = 'butcher';

$conx = mysqli_connect($host, $user, $password);

if ($conx->connect_error) {
    http_response_code(500);
    echo 'connnection failed: ' . mysqli_connect_error() . "<br>";
}

if (!mysqli_query($conx, "CREATE DATABASE IF NOT EXISTS " . $DBname)) {
    http_response_code(500);
    echo "Error creating the database:" . mysqli_error($conx) . "<br>";
    mysqli_close($conx);
}

if (!mysqli_query($conx, "use " . $DBname)) {
    http_response_code(500);
    echo "Error selecting the database:" . mysqli_error($conx) . "<br>";
    mysqli_close($conx);
}

$table = "CREATE TABLE IF NOT EXISTS user(
    id INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(90) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    N_Telephone VARCHAR(15) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    DocName VARCHAR(100),
    isAdmin TINYINT  NOT NULL,
    reg_date VARCHAR(100))";

if (!mysqli_query($conx, $table)) {
    echo "Error creating the table:" . mysqli_error($conx) . "<br>";
    mysqli_close($conx);
}