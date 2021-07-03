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
				<a href="doctorProfile.php" class="logo">
					Control-20
				</a>
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
		<?php
		session_start();
		require "../connect.php";

		$doctorId = $_SESSION['doctor']['id'];

		$sql = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId'";
		$query = mysqli_query($connect, $sql);
		$count = mysqli_num_rows($query);
		if ($count != 0) {
		?>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Пациенты</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Список пациентов</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>ID</th>
														<th>Имя</th>
														<th>Фамилия</th>
														<th>Email</th>
														<th>Номер телефона</th>
														<th>Адрес</th>
														<th>Статус</th>
														<th>Api Key</th>
													</tr>
												</thead>
												<tbody>
													<?php
													while ($result = mysqli_fetch_assoc($query)) {
													?>
														<tr>
															<td align="center"><?php echo $result["id"]; ?></td>
															<td align="center"><?php echo $result["patientName"]; ?></td>
															<td align="center"><?php echo $result["patientSurname"]; ?></td>
															<td align="center"><?php echo $result["patientEmail"]; ?></td>
															<td align="center"><?php echo $result["patientPhoneNumber"]; ?></td>
															<td align="center"><?php echo $result["patientAddress"]; ?></td>
															<td align="center"><?php echo $result["patientStatus"]; ?></td>
															<td align="center"><a href="patientGraph.php?apiKey=<?php echo $result["apiKey"]; ?>"><?php echo $result["apiKey"]; ?></a></td>
														</tr>
												<?php
													}
												} else {
													echo "База пуста";
												}

												?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- <a style="display: flex; justify-content: center; margin: auto;" href="addPatient.php">
									<button class="btn btn-black" name="table">Добавить пациента в базу</button>
								</a> -->
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
<script>
	$('#displayNotif').on('click', function() {
		var placementFrom = $('#notify_placement_from option:selected').val();
		var placementAlign = $('#notify_placement_align option:selected').val();
		var state = $('#notify_state option:selected').val();
		var style = $('#notify_style option:selected').val();
		var content = {};

		content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
		content.title = 'Bootstrap notify';
		if (style == "withicon") {
			content.icon = 'la la-bell';
		} else {
			content.icon = 'none';
		}
		content.url = 'index.html';
		content.target = '_blank';

		$.notify(content, {
			type: state,
			placement: {
				from: placementFrom,
				align: placementAlign
			},
			time: 1000,
		});
	});
</script>

</html>