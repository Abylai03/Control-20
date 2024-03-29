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
    <title>Control-20 Patients</title>
    <meta name="viewport" content='width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../doctor_scripts/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../doctor_scripts/assets/css/ready.css">
    <link rel="stylesheet" href="../doctor_scripts/assets/css/demo.css">

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
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
                    <li class="nav-item active">
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

                                        $apiKey = $_SESSION['patient']['apiKey'];

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

                                    <h2>Центр мониторинга ESP-32</h2>
                                    <form class="form" method="POST">
                                        <p>Начальная дата: <input type="text" id="datepicker" name="datepicker" placeholder="YYYY-MM-DD" required></p>
                                        <p>Конечная дата: <input type="text" id="datepicker_1" name="datepicker_1" placeholder="YYYY-MM-DD" required></p>
                                        <button type="submit" class="btn btn-black" name="submit" style="margin-bottom: 1.5%">Поставить диапазон</button>
                                    </form>
                                    <a style="display: flex; justify-content: center; margin: auto; max-width: 200px" href="../doctor_scripts/downloadTable.php?apiKey=<?php echo $apiKey; ?>&date=<?php echo $date; ?>&date1=<?php echo $date_1; ?>">
                                        <button class="btn btn-black" name="table">Скачать таблицу</button>
                                    </a>
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
<script src="../doctor_scripts/assets/js/core/bootstrap.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../doctor_scripts/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../doctor_scripts/assets/js/ready.min.js"></script>

</html>