<?php
include ("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к БД";
}

$id_s = $_GET['id_s'];
$id_g = $_GET['id_g'];
$date_con = $_GET['date_con'];
$date_ex = $_GET['date_ex'];
$audit = $_GET['audit'];

// Выполнение запроса
$result = $mysqli->query("INSERT INTO rasp
        SET id_s='$id_s', id_g='$id_g', 
        date_con='$date_con', date_ex='$date_ex',
        audit='$audit'"
);

if ($result) {
    print "<p>Внесение данных прошло успешно!";
    if ($_SESSION['type'] == 1)
        echo "<p><a href=rasp.php> Вернуться к списку </a>";
    elseif ($_SESSION['type'] == 2)
        echo ".<p><a href=raspAdm.php> Вернуться к списку </a>";
} else {
    if ($_SESSION['type'] == 1)
        echo "Ошибка сохранения . <p><a href=rasp.php> Вернуться к списку </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Ошибка сохранения . <p><a href=raspAdm.php> Вернуться к списку </a>";
}
mysqli_close($mysqli);
?>