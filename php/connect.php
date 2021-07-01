<?php
$servername = "localhost";
// REPLACE with your Database name
$dbname = "esp32";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = ""; 

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "ESP32";

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);

mysqli_set_charset($connect,"utf8");
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 
