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
    $_SESSION['patient'] = [
        "id" => $strSQL['id'],
        "patientEmail" => $strSQL['patientEmail'],
        "patientName" => $strSQL['patientName'],
        "patientSurname" => $strSQL['patientSurname'],
        "patientPassword" => $strSQL['patientPassword'],
        "patientPhoneNumber" => $strSQL['patientPhoneNumber'],
        "patientAddress" => $strSQL['patientAddress']
    ];
    header('Location: patientProfile.php');
}else {
	echo "Email or password is incorrect";
}
}
?>