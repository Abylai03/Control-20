<?php
$con = mysqli_connect("localhost", "root", "", "ESP32");
if(isset($_POST['register'])){
$name= $_POST['name'];
$surname=$_POST['surname'];
$email=$_POST['email'];
$password=$_POST['password'];
$phoneNumber=$_POST['phoneNumber'];
$address=$_POST['address'];
     $select='SELECT * FROM `patients` WHERE `email`= "'.$email.'" ';
     $result = mysqli_query($con,$select);
     if($result){
         if(mysqli_num_rows($result)>0){
            echo "Пользователь с таким адресом электронной почты уже существует!";
         }else{
    $insert="INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`,`phoneNumber`, `address`) VALUES (NULL, '".$name."', '".$surname."', '".$email."', '".$password."','".$phoneNumber."', '".$address."')";
$r=mysqli_query($con, $insert);
             }
}}
?>
