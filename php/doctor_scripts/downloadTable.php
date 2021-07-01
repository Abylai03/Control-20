<?php
session_start();
if (!$_SESSION['doctor']) {
    header('Location: ../../route.html');
}

require "../connect.php";

$output = '';

$apiKey = $_GET['apiKey'];
$date = $_GET['date'];
$date_1 = $_GET['date1'];

/* $fn = "SELECT concat(patientName, ' ', patientSurname) as name FROM patients WHERE `apiKey` = '$apiKey'"; */
$name = mysqli_query($connect, "SELECT concat(patientName, ' ', patientSurname) as name FROM patients WHERE `apiKey` = '$apiKey'")->fetch_assoc()['name'];
echo $name;

 $query = "SELECT `value1`, `value2`, `value3`, `reading_time` FROM $apiKey WHERE reading_time BETWEEN '$date%' AND '$date_1%'
 ";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Reading time</th>  
                         <th>Temperature</th>  
                         <th>Heart rate</th>  
                         <th>Saturation</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td align="center">'.$row["reading_time"].'</td>  
                         <td align="center">'.$row["value1"].'</td>  
                         <td align="center">'.$row["value2"].'</td>  
                         <td align="center">'.$row["value3"].'</td>  
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename="'.$name.'.xls"');
  echo $output;
 }
 ?>