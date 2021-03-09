<?php
require "connect.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    /* if (empty($name) or empty($surname) or empty($email) or empty($password) or empty($phoneNumber) or empty($address)) {
        echo '<script type="text/javascript">';
        echo 'alert("You missed some data")';  //not showing an alert box.
        echo '</script>';
        header('Location: ../route.html');
    } else { */
        $select = "SELECT * FROM `patients` WHERE `patientEmail`= '$email'";
        $result = mysqli_query($connect, $select);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "Пользователь с таким адресом электронной почты уже существует!";
            } else {
                $insert = "INSERT INTO `patients` (`id`, `patientName`, `patientSurname`, `patientEmail`, `patientPassword`,`patientPhoneNumber`, `patientAddress`) 
                VALUES (NULL, '$name', '$surname ', '$email', '$password','$phoneNumber', '$address')";

                echo $insert;

                $r = mysqli_query($connect, $insert);
                if ($r) {
                    $sql = "SELECT * FROM `patients` WHERE `patientEmail`='$email'";
                    $res = mysqli_query($connect, $sql);

                    $patient = mysqli_fetch_assoc($res);

                    $_SESSION['patient'] = [
                        "id" => $patient['id'],
                        "patientEmail" => $patient['patientEmail'],
                        "patientName" => $patient['patientName'],
                        "patientSurname" => $patient['patientSurname'],
                        "patientPassword" => $patient['patientPassword'],
                        "patientPhoneNumber" => $user['patientPhoneNumber'],
                        "patientAddress" => $patient['patientAddress']
                    ];
                    header('Location: patient_scripts/profileProfile.php');
                }else{
                    echo 'Registration Error!';
                }
            }
        }
    /* } */
}
