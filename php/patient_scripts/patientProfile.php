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
					<li class="nav-item active">
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
					<h4 class="page-title">Главная</h4>
					<h6 class="page-title">Состояние пациента:</h6>
					<div class="row">
                        <?php
                        require "../connect.php";
                        
                        $id = $_SESSION['patient']['id'];

                        $select = "SELECT `patientStatus` FROM `patients` WHERE `id`= '$id'";
                        $result = mysqli_query($connect, $select);
                        $array = mysqli_fetch_array($result);
                        $status = $array[0];

                        if($status=="Good"){
                            $class = "card-success";
                        }
                        if($status=="Normal"){
                            $class = "card-warning";
                        }
                        if($status=="Bad"){
                            $class = "card-danger";
                        }
                        ?>
						<div class="col-md-3">
							<div class="card card-stats <?php echo $class;?>">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="la la-user"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers">
												<p class="card-category">Моё состояние:</p>
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
<!-- <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->
<script src="../doctor_scripts/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../doctor_scripts/assets/js/ready.min.js"></script>
<script src="../doctor_scripts/assets/js/demo.js"></script>

</html>