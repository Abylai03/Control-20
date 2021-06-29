<?php
require "../connect.php";

session_start();

if(isset($_POST['login'])){
$email = $_POST['email'];
$password = $_POST['password'];
$strSQL = "SELECT * FROM doctors WHERE doctorEmail='$email' AND doctorPassword='$password'";
$result= mysqli_query($connect,$strSQL);
$row_cnt = mysqli_num_rows($result);
if ($row_cnt>0){
    $doctor = mysqli_fetch_assoc($result);

    $_SESSION['doctor'] = [
        "id" => $doctor['id'],
        "patientEmail" => $doctor['doctorEmail'],
        "doctorName" => $doctor['doctorName'],
        "doctorSurname" => $doctor['doctorSurname']
    ];
    header('Location: doctorProfile.php');
}else {
	echo "Email or password is incorrect";
}
}
?>