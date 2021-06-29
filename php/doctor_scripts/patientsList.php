<?php
session_start();
require "../connect.php";

$doctorId = $_SESSION['doctor']['id'];

$sql = "SELECT * FROM `patients` WHERE `doctorId`='$doctorId'";
$query = mysqli_query($connect, $sql);
$count = mysqli_num_rows($query);
if ($count != 0) {
?>
    <table style="width: 100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Status</th>
            <th>Api Key</th>
            <th></th>
        </tr>
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
    </table>