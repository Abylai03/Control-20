<?php
session_start();
if (!$_SESSION['patient']) {
    header('Location: ../../route.html');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Control-20 Main Panel</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="../doctor_scripts/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../doctor_scripts/assets/css/ready.css">
    <link rel="stylesheet" href="../doctor_scripts/assets/css/demo.css">
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
                <a href="patientProfile.php" class="logo">
                    Control-20
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                </div>
            </nav>
        </div>
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="../doctor_scripts/assets/img/patient.png">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                <?= $_SESSION['patient']['patientName'] ?> <?= $_SESSION['patient']['patientSurname'] ?>
                                <span class="user-level">Пациент</span>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="patientProfile.php">
                            <i class="la la-connectdevelop"></i>
                            <p>Главная</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="patientGraph.php">
                            <i class="la la-line-chart"></i>
                            <p>Показатели</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="patientFeedback.php">
                            <i class="la la-question-circle"></i>
                            <p>Помощь</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="patientSettings.php">
                            <i class="la la-cog"></i>
                            <p>Настройки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="changePassword.php">
                            <i class="la la-key"></i>
                            <p>Сменить пароль</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="patientLogout.php">
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
                                    <div class="card-title">Изменить данные</div>
                                </div>
                                <?php
                                require "../connect.php";

                                $id = $_SESSION['patient']['id'];

                                $sql = "SELECT * FROM `patients` WHERE `id`='$id'";
                                $query = mysqli_query($connect, $sql);

                                if (mysqli_num_rows($query) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $id = $row["id"];
                                        $patientName = $row["patientName"];
                                        $patientSurname = $row["patientSurname"];
                                        $patientEmail = $row["patientEmail"];
                                        $patientPhoneNumber = $row["patientPhoneNumber"];
                                        $patientAddress = $row["patientAddress"];
                                        $patientStatus = $row["patientStatus"];
                                        $doctorId = $row["doctorId"];
                                    }
                                }
                                ?>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="name">Имя пациента</label>
                                            <input type="text" class="form-control form-control" id="name" name="name" value="<?php echo $patientName; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Фамилия пациента</label>
                                            <input type="text" class="form-control form-control" id="surname" name="surname" value="<?php echo $patientSurname; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Почта пациента</label>
                                            <input type="email" class="form-control form-control" id="email" name="email" value="<?php echo $patientEmail; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Номер телефона пациента</label>
                                            <input type="number" class="form-control form-control" id="phone" name="phone" value="<?php echo $patientPhoneNumber; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Адрес/палата пациента</label>
                                            <input type="text" class="form-control form-control" id="address" name="address" value="<?php echo $patientAddress; ?>">
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
<script src="../doctor_scripts/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../doctor_scripts/assets/js/core/popper.min.js"></script>
<script src="../doctor_scripts/assets/js/core/bootstrap.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../doctor_scripts/assets/js/ready.min.js"></script>

</html>


<?php
require "../connect.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE `patients` SET `patientName`='$name', `patientSurname`='$surname', `patientEmail`='$email', 
    `patientPhoneNumber`='$phone', `patientAddress`='$address' WHERE `id`='$id'";
    $query = mysqli_query($connect, $sql);
    if ($query) {
        $strSQL = "SELECT * FROM `patients` WHERE `id`='$id'";
        $result = mysqli_query($connect, $strSQL);
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt > 0) {
            $patient = mysqli_fetch_assoc($result);

            $_SESSION['patient'] = [
                "id" => $patient['id'],
                "patientEmail" => $patient['patientEmail'],
                "patientName" => $patient['patientName'],
                "patientSurname" => $patient['patientSurname'],
                "patientPassword" => $patient['patientPassword'],
                "patientPhoneNumber" => $patient['patientPhoneNumber'],
                "patientAddress" => $patient['patientAddress'],
                "patientStatus" => $patient['patientStatus'],
                "apiKey" => $patient['apiKey']
            ];
        }
        echo "<script>
        alert('Информация изменена!');
        window.location.href='patientProfile.php';
        </script>";
    } else {
        echo "<script>
        alert('Ошибка!');
        window.location.href='patientSettings.php';
        </script>";
    }
}
?>