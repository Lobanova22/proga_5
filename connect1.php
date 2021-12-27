<?php
$host = 'localhost';
$database = 'a0613498_subject';
$user = 'a0613498_subject';
$password = 'root';
//require_once 'connect.php';
$link = mysqli_connect($host, $user, $password, $database)
or die("ошибка" . mysqli_error($link));
?>