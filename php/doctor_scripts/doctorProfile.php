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
	<title>Control-20 Main Panel</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['corechart']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			<?php
			require "../connect.php";
			$doctorId = $_SESSION['doctor']['id'];
			$sql1 = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId' AND `patientStatus`='Good'";
			$query1 = mysqli_query($connect, $sql1);
			$good = mysqli_num_rows($query1);

			$sql2 = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId' AND `patientStatus`='Normal'";
			$query2 = mysqli_query($connect, $sql2);
			$normal = mysqli_num_rows($query2);

			$sql3 = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId' AND `patientStatus`='Bad'";
			$query3 = mysqli_query($connect, $sql3);
			$bad = mysqli_num_rows($query3);

			echo $good,
			$normal,
			$bad;
			?>

			var data = google.visualization.arrayToDataTable([
				['Статистика', 'пациентов'],
				['Хорошее', <?php echo $good; ?>],
				['Средней тяжести', <?php echo $normal; ?>],
				['Тяжёлое', <?php echo $bad; ?>]
			]);


			var options = {
				fontSize: 13,
				title: 'Статистика пациентов',
				colors: ['#59D05D', '#FBAD4C', '#FF646D']
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart'));

			chart.draw(data, options);
		}
	</script>
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
								<span class="user-level">Доктор</span>
							</span>
						</a>
						<div class="clearfix"></div>
					</div>
				</div>
				<ul class="nav">
					<li class="nav-item active">
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
					<h4 class="page-title">Главная</h4>
					<h6 class="page-title">Состояния пациентов:</h6>
					<div class="row">
						<div class="col-md-3">
							<div class="card card-stats card-primary">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="la la-users"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers">
												<p class="card-category">Пациенты</p>
												<h4 class="card-title">
													<?php
													require "../connect.php";

													$doctorId = $_SESSION['doctor']['id'];

													$sql = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId'";
													$query = mysqli_query($connect, $sql);
													$count = mysqli_num_rows($query);
													echo $count;
													?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats card-success">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="la la-check-circle"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center" style="padding-left: 0;">
											<div class="numbers">
												<p class="card-category" style = "display: inline-block !important;">"Хорошее"</p>
												<h4 class="card-title">
													<?php
													require "../connect.php";

													$doctorId = $_SESSION['doctor']['id'];

													$sql = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId' AND `patientStatus`='Good'";
													$query = mysqli_query($connect, $sql);
													$count = mysqli_num_rows($query);
													echo $count;
													?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats card-warning">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="la la-leaf"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers">
												<p class="card-category">"Средней тяжести"</p>
												<h4 class="card-title">
													<?php
													require "../connect.php";

													$doctorId = $_SESSION['doctor']['id'];

													$sql = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId' AND `patientStatus`='Normal'";
													$query = mysqli_query($connect, $sql);
													$count = mysqli_num_rows($query);
													echo $count;
													?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats card-danger">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="la la-exclamation-circle"></i>
											</div>
										</div>
										<div class="col-7 d-flex align-items-center">
											<div class="numbers">
												<p class="card-category">"Тяжёлое"</p>
												<h4 class="card-title">
													<?php
													require "../connect.php";

													$doctorId = $_SESSION['doctor']['id'];

													$sql = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId' AND `patientStatus`='Bad'";
													$query = mysqli_query($connect, $sql);
													$count = mysqli_num_rows($query);
													echo $count;
													?>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<!-- <div class="card">
								<!-- <div class="card-header">
									<h4 class="card-title">Users Statistics</h4>
									<p class="card-category">
										Users statistics this month</p>
								</div> -->
							<!-- <div class="card-body">
									
								</div>
							</div> -->
							<div id="piechart" style="width: 100%; height: 45%;"></div>
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
<script src="assets/js/demo.js"></script>

</html>