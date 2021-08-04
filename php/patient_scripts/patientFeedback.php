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
                    <li class="nav-item active">
                        <a href="patientFeedback.php">
                            <i class="la la-question-circle"></i>
                            <p>Помощь</p>
                        </a>
                    </li>
                    <li class="nav-item">
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
                    <h4 class="page-title">Помощь</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    require "../connect.php";

                                    $patientId = $_SESSION['patient']['id'];


                                    if (isset($_POST['submit'])) {
                                        $feedback = $_POST['feedback'];
                                        $sql = "INSERT INTO `patientFeedbacks` (`patientId`, `feedback`, `feedback_time`) VALUES ('$patientId', '$feedback', current_timestamp());";
                                        $query = mysqli_query($connect, $sql);

                                        if ($query) {
                                            echo "<h3 style='margin: 2%; color: red;'>Мы получили сообщение, в скором времени вам ответим!</h3>";
                                        } else {
                                            echo "Error!";
                                        }
                                    }
                                    ?>
                                    <form method="POST" style="margin: 2%">
                                        <div class="form-group" style="padding-left: 0;">
                                            <label for="message">Введите ваше сообщение</label>
                                            <textarea class="form-control" rows="3" name="feedback" required></textarea>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-info">Отправить сообщение</button>
                                    </form>
                                </div>
                            </div>
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
<script src="../doctor_scripts/assets/js/plugin/chartist/chartist.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../doctor_scripts/assets/js/ready.min.js"></script>

</html>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedback</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <form method="POST" style="margin: 2%">
        <div class="form-group">
            <label for="message">Введите ваше сообщение</label>
            <textarea class="form-control" rows="3" name="feedback" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-info">Отправить сообщение</button>
    </form>
</body>

</html>



<!-- CREATE TABLE `patientFeedbacks` (
  `patient` int(11) NOT NULL,
  `feedback` varchar(5000) NOT NULL,
  `feedback_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) -->