<?php
include("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database) or die ("Невозможно
подключиться к серверу");
$id_s = $_GET['id_s'];
if ($_SESSION['type'] == 2)
    $result = $mysqli->query("DELETE FROM subject WHERE id_s ='$id_s'");
else
    echo "Недостаточно прав";
header("Location: subjectAdm.php");
exit;
?>
