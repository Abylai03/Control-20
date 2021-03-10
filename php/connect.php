<?php
$servername = "localhost:3306";

// REPLACE with your Database name
$dbname = "ESP32";
// REPLACE with Database user
$username = "Abylay03";
// REPLACE with Database user password
$password = "jn8Xh8?4"; 

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