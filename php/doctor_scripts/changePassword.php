<?php
session_start();
if (!$_SESSION['doctor']) {
    header('Location: ../../route.html');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Control-20 Patients</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">
    <style>
        input[type='number'] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="doctorProfile.php" class="logo">
                    Control-20
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="assets/img/doctor.jpg">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $_SESSION['doctor']['doctorName'] ?> <?= $_SESSION['doctor']['doctorSurname'] ?>
                                <span class="user-level">Доктор</span>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="doctorProfile.php">
                            <i class="la la-connectdevelop"></i>
                            <p>Главная</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="tables.php">
                            <i class="la la-th"></i>
                            <p>Пациенты</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="doctorFeedback.php">
                            <i class="la la-question-circle"></i>
                            <p>Помощь</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="changePassword.php">
                            <i class="la la-key"></i>
                            <p>Сменить пароль</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="doctorLogout.php">
                            <i class="la la-sign-out"></i>
                            <p>Выход</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Настройки</h4>
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Сменить пароль</div>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="oldPass">Предыдущий пароль</label>
                                            <input type="password" class="form-control form-control" id="oldPass" name="oldPass" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPass">Новый пароль</label>
                                            <input type="password" class="form-control form-control" id="newPass" name="newPass" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPass2">Введите новый пароль заново</label>
                                            <input type="password" class="form-control form-control" id="newPass2" name="newPass2" required>
                                        </div>
                                        <div class="card-action">
                                            <input type="submit" name="submit" class="btn btn-success" value="Изменить"></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>

</html>

<?php
require "../connect.php";
if (isset($_POST['submit'])) {
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $newPass2 = $_POST['newPass2'];
    $doctorId = $_SESSION['doctor']['id'];

    if ($newPass == $newPass2) {
        $strSQL = "SELECT * FROM doctors WHERE id='$doctorId' AND doctorPassword='$oldPass'";
        $result = mysqli_query($connect, $strSQL);
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt > 0) {
            $sql = "UPDATE `doctors` SET `doctorPassword`='$newPass' WHERE `id`='$doctorId'";
            $query = mysqli_query($connect, $sql);
            if ($query) {
                echo "<script>
                alert('Пароль изменён!');
                window.location.href='doctorLogout.php';
                </script>";
            } else {
                echo "<script>
                alert('Ошибка!');
                window.location.href='changePassword.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Старый пароль неверен!');
            </script>";
        }
    } else {
        echo "<script>
        alert('Пароли не совпадают!');
        </script>";
    }
}
?>