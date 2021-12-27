<html>
<body>
<?php
include("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Невозможно подключиться к серверу";
} // установление соединения с сервером

$id = $_GET['id'];
$id_s = $_GET['id_s'];
$id_g = $_GET['id_g'];
$date_con = $_GET['date_con'];
$date_ex = $_GET['date_ex'];
$audit = $_GET['audit'];

$result = $mysqli->query("UPDATE rasp SET id_s='$id_s', id_g='$id_g',  
date_con='$date_con', date_ex='$date_ex' ,audit='$audit'
WHERE id='$id'");

if ($result) {
    if ($_SESSION['type'] == 1)
        echo "Все сохранено.<p><a href=rasp.php> Вернуться к Расписанию </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Все сохранено.<p><a href=raspAdm.php> Вернуться к Расписанию </a>";
} else {
    if ($_SESSION['type'] == 1)
        echo "Ошибка сохранения. <p></p><a href=rasp.php> Вернуться к Расписанию </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Ошибка сохранения. <p><a href=raspAdm.php> Вернуться к Расписанию </a>";
}
?>
</body>
</html>