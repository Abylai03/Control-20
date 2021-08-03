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
                    <a href="tables.php">
                        <button style="margin-bottom: 1%; font-size: 16px;" class="btn btn-danger">Назад</button>
                    </a>
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
                                            <input name="name" type="text" class="form-control form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Фамилия пациента</label>
                                            <input name="surname" type="text" class="form-control form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Почта пациента</label>
                                            <input name="email" type="email" class="form-control form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Номер телефона пациента</label>
                                            <input name="phone" type="number" class="form-control form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Адрес/палата пациента</label>
                                            <input name="address" type="text" class="form-control form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="doc">Лечащий врач</label>
                                            <select name="doc" class="form-control input-square">
                                                <?php
                                                require "../connect.php";

                                                $doctorId = $_SESSION['doctor']['id'];

                                                $sql = "SELECT * FROM `doctors`";
                                                $query = mysqli_query($connect, $sql);
                                                $count = mysqli_num_rows($query);
                                                if ($count != 0) {
                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                ?>
                                                        <option value="<?php echo $result["id"]; ?>"><?php echo $result["doctorName"]; ?> <?php echo $result["doctorSurname"]; ?></option>
                                                <?php
                                                    }
                                                } else {
                                                    echo "База пуста";
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Состояние пациента</label>
                                            <select name="status" class="form-control input-square">
                                                <option value="Good">Хорошее</option>
                                                <option value="Normal">Средней тяжести</option>
                                                <option value="Bad">Тяжёлое</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="number">Номер устройства</label>
                                            <input name="number" type="text" class="form-control form-control">
                                        </div>
                                        <div class="card-action">
                                            <!-- <input name="submit" type="submit" class="btn btn-success" value="Добавить" /> -->
                                            <button name="submit" type="submit" class="btn btn-success">Добавить</button>
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
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $doc = $_POST['doc'];
    $status = $_POST['status'];
    $number = $_POST['number'];

    $sql = "INSERT INTO `patients` (`id`, `patientName`, `patientSurname`, `patientEmail`, `patientPhoneNumber`, `patientAddress`, `patientStatus`, `apiKey`, `doctorId`) 
    VALUES (NULL, '$name', '$surname ', '$email', '$phone', '$address', '$status', '$number', '$doc')";
    $query = mysqli_query($connect, $sql);

    if ($query) {
        echo "<script>
        alert('Пациент добавлен');
        window.location.href='tables.php';
        </script>";
    } else {
        echo "<script>
        alert('Ошибка!');
        window.location.href='tables.php';
        </script>";
    }
}
?>