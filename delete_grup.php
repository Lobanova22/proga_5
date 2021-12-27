<?php
include("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database)
or die ("Невозможно подключиться к серверу");
$id_g = $_GET['id_g'];
if ($_SESSION['type'] == 2)
    $result = $mysqli->query("DELETE FROM grup WHERE id_g='$id_g'");
else
    echo "Недостаточно прав";
header("Location: grupAdm.php");
exit;
?>
