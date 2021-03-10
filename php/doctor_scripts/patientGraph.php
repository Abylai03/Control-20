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

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.highcharts.com/highcharts.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
    min-width: 310px;
    max-width: 1280px;
    height: 500px;
    margin: 0 auto;
  }

  h2 {
    font-family: Arial;
    font-size: 2.5rem;
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

<body>
  <a href="patients.php"><button type="button" class="btn btn-primary" style="margin: 2% 0 0 2%">Назад</button></a>
  <h2>ESP COVID-19 Monitoring Center (Control-20)</h2>
  <form class="form" method="POST">
    <p>Начальная дата: <input type="text" id="datepicker" name="datepicker" required></p>
    <p>Конечная дата: <input type="text" id="datepicker_1" name="datepicker_1" required></p>
    <button type="submit" class="btn btn-black" name="submit">Поставить диапазон</button>
  </form>
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
</body>

</html>