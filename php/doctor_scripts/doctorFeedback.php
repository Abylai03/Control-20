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
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="index.html" class="logo">
					Control-20
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
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
							<img src="assets/img/doctor.jpg">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
								<?= $_SESSION['doctor']['doctorName'] ?> <?= $_SESSION['doctor']['doctorSurname'] ?>
									<span class="user-level">Doctor</span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item">
							<a href="doctorProfile.php">
								<i class="la la-connectdevelop"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="tables.php">
								<i class="la la-th"></i>
								<p>Tables</p>
							</a>
						</li>
						<li class="nav-item active">
							<a href="doctorFeedback.php">
								<i class="la la-question-circle"></i>
								<p>Support</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="doctorLogout.php">
								<i class="la la-sign-out"></i>
								<p>Logout</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Графики</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
                                    <?php
                                    require "../connect.php";

                                    $doctorId = $_SESSION['doctor']['id'];


                                    if (isset($_POST['submit'])) {
                                        $feedback = $_POST['feedback'];
                                        $sql = "INSERT INTO `doctorFeedbacks` (`doctorId`, `feedback`, `feedback_time`) VALUES ('$doctorId', '$feedback', current_timestamp());";
                                        $query = mysqli_query($connect, $sql);

                                        if ($query) {
                                            echo "<h3 style='margin: 2%; color: red;'>Мы получили сообщение, в скором времени вам ответим!</h3>";
                                        } else {
                                            echo "Error!";
                                        }
                                    }
                                    ?>
                                    <form method="POST" style="margin: 2%">
                                        <div class="form-group">
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
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>

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
