<?php
require "../connect.php";
session_start();
if(isset($_POST['login'])){
$email=$_POST['email'];
$password=$_POST['password'];
$strSQL ="SELECT * FROM patients WHERE patientEmail='$email' AND patientPassword='$password'";
$result=mysqli_query($connect,$strSQL);
$row_cnt = mysqli_num_rows($result);
if ($row_cnt>0){
    $patient = mysqli_fetch_assoc($res);

    $_SESSION['patient'] = [
        "id" => $patient['id'],
        "patientEmail" => $patient['patientEmail'],
        "patientName" => $patient['patientName'],
        "patientSurname" => $patient['patientSurname'],
        "patientPassword" => $patient['patientPassword'],
        "patientPhoneNumber" => $patient['patientPhoneNumber'],
        "patientAddress" => $patient['patientAddress']
    ];
    header('Location: patientProfile.php');
}else {
	echo "Email or password is incorrect";
}
}
?>