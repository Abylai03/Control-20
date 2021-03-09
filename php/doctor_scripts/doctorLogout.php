<?php
session_start();
unset($_SESSION['doctor']);
header('Location: ../../route.html');