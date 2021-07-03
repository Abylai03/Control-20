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
                    <li class="nav-item active">
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
                    <h4 class="page-title">Пациенты</h4>
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Добавить пациента</div>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="name">Имя пациента</label>
                                            <input type="text" class="form-control form-control" id="name" name="name" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Фамилия пациента</label>
                                            <input type="text" class="form-control form-control" id="surname" name="surname" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Почта пациента</label>
                                            <input type="email" class="form-control form-control" id="email" name="email" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Номер телефона пациента</label>
                                            <input type="number" class="form-control form-control" id="phone" name="phone" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="adress">Адрес/палата пациента</label>
                                            <input type="text" class="form-control form-control" id="adress" name="adress" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Состояние пациента</label>
                                            <select class="form-control input-square" id="status" name="status">
                                                <option>Хорошее</option>
                                                <option>Средней тяжести</option>
                                                <option>Тяжёлое</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="number">Номер устройства</label>
                                            <input type="text" class="form-control form-control" id="number" name="number" placeholder="Default Input">
                                        </div>
                                        <div class="card-action">
                                            <input type="submit" name="submit" class="btn btn-success" value="Добавить"></input>
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
<?php
require "../connect.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    echo $name;
}
?>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>

</html>