<?php
require "../connect.php";

$apiKey = $_GET['apiKey'];

$sql = "DELETE FROM `patients` WHERE `apiKey`='$apiKey'";
$query = mysqli_query($connect, $sql);

header('Location: tables.php');
?>