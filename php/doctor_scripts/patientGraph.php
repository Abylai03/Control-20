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

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
      });

    });
    $(function() {
      $("#datepicker_1").datepicker({
        dateFormat: 'yy-mm-dd'
      });
    });
  </script>
  <style>
    body {
      height: 500px;
      margin: 0 auto;
    }

    h2 {
      font-family: Arial;
      font-size: 30px;
      text-align: center;
    }

    .form {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      margin: auto;
    }
  </style>
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
            <a href="tables.html">
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
          <h4 class="page-title">Графики</h4>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">

                  <?php
                  require "../connect.php";
                  if (isset($_POST['submit'])) {

                    $date = $_POST['datepicker'];
                    $date_1 = $_POST['datepicker_1'];

                    $apiKey = $_GET['apiKey'];

                    //$sql = "SELECT `id`, `value1`, `value2`, `value3`, `reading_time` FROM $apiKey order by `reading_time` desc limit 40";
                    $sql = "SELECT `id`, `value1`, `value2`, `value3`, `reading_time` FROM $apiKey WHERE reading_time BETWEEN '$date%' AND '$date_1%'";

                    $result = $connect->query($sql) or die($connect->error);
                    while ($data = $result->fetch_assoc()) {
                      $sensor_data[] = $data;
                    }

                    $readings_time = array_column($sensor_data, 'reading_time');

                    $value1 = json_encode(array_column($sensor_data, 'value1'), JSON_NUMERIC_CHECK);
                    $value2 = json_encode(array_column($sensor_data, 'value2'), JSON_NUMERIC_CHECK);
                    $value3 = json_encode(array_column($sensor_data, 'value3'), JSON_NUMERIC_CHECK);
                    $reading_time = json_encode($readings_time, JSON_NUMERIC_CHECK);
                    $result->free();
                    $connect->close();
                  }

                  ?>



                  <a href="tables.php"><button type="button" class="btn btn-primary" style="margin: 2% 0 0 2%">Назад</button></a>
                  <h2>Центр мониторинга ESP-32</h2>
                  <form class="form" method="POST">
                    <p>Начальная дата: <input type="text" id="datepicker" name="datepicker" placeholder="YYYY-MM-DD" required></p>
                    <p>Конечная дата: <input type="text" id="datepicker_1" name="datepicker_1" placeholder="YYYY-MM-DD" required></p>
                    <button type="submit" class="btn btn-black" name="submit" style="margin-bottom: 1.5%">Поставить диапазон</button>
                  </form>
                  <a style="display: flex; justify-content: center; margin: auto;" href="downloadTable.php?apiKey=<?php echo $apiKey; ?>&date=<?php echo $date; ?>&date1=<?php echo $date_1; ?>">
                    <button class="btn btn-black" name="table">Скачать таблицу</button></a>
                  <div id="chart-temperature" class="container"></div>
                  <div id="chart-heart-rate" class="container"></div>
                  <div id="chart-saturation" class="container"></div>
                  <script>
                    var value1 = <?php echo $value1; ?>;
                    var value2 = <?php echo $value2; ?>;
                    var value3 = <?php echo $value3; ?>;
                    var reading_time = <?php echo $reading_time; ?>;

                    var chartT = new Highcharts.Chart({
                      chart: {
                        renderTo: 'chart-temperature'
                      },
                      title: {
                        text: 'GY-906 Temperature'
                      },
                      series: [{
                        showInLegend: false,
                        data: value1
                      }],
                      plotOptions: {
                        line: {
                          animation: false,
                          dataLabels: {
                            enabled: true
                          }
                        },
                        /* 10205130 */
                        series: {
                          color: '#059e8a'
                        }
                      },
                      xAxis: {
                        type: 'datetime',
                        categories: reading_time
                      },
                      yAxis: {
                        title: {
                          text: 'Temperature (Celsius)'
                        }
                        //title: { text: 'Temperature (Fahrenheit)' }
                      },
                      credits: {
                        enabled: false
                      }
                    });

                    var chartH = new Highcharts.Chart({
                      chart: {
                        renderTo: 'chart-heart-rate'
                      },
                      title: {
                        text: 'MAX30100 Heart Rate'
                      },
                      series: [{
                        showInLegend: false,
                        data: value2
                      }],
                      plotOptions: {
                        line: {
                          animation: false,
                          dataLabels: {
                            enabled: true
                          }
                        }
                      },
                      xAxis: {
                        type: 'datetime',
                        //dateTimeLabelFormats: { second: '%H:%M:%S' },
                        categories: reading_time
                      },
                      yAxis: {
                        title: {
                          text: 'Heart Rate (bpm)'
                        }
                      },
                      credits: {
                        enabled: false
                      }
                    });


                    var chartS = new Highcharts.Chart({
                      chart: {
                        renderTo: 'chart-saturation'
                      },
                      title: {
                        text: 'MAX30100 Saturation'
                      },
                      series: [{
                        showInLegend: false,
                        data: value3
                      }],
                      plotOptions: {
                        line: {
                          animation: false,
                          dataLabels: {
                            enabled: true
                          }
                        },
                        series: {
                          color: '#18009c'
                        }
                      },
                      xAxis: {
                        type: 'datetime',
                        categories: reading_time
                      },
                      yAxis: {
                        title: {
                          text: 'Saturation (Sp0%)'
                        }
                      },
                      credits: {
                        enabled: false
                      }
                    });
                  </script>
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