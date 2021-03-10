<?php
session_start();
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