<?php
include ("checks.php");
require_once 'connect1.php';
$link = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysql_connect_error());
    exit();
} // установление соединения с сервером и подключение к базе данных:
// Строка запроса на добавление записи в таблицу:
mysqli_query($link, "INSERT INTO grup SET name_g='" . $_GET['name_g']
    . "', fac_g='" . $_GET['fac_g'] . "'");
if (mysqli_affected_rows($link) > 0) // если нет ошибок при выполнении запроса
{
    print "<p>Спасибо, Ваш магазин добавлен в базу данных.";
    if ($_SESSION['type'] == 1)
        echo "<p><a href=grup.php> Вернуться к списку Групп </a>";
    elseif ($_SESSION['type'] == 2)
        echo "<p><a href=grupAdm.php> Вернуться к списку Групп </a>";
} else {
    if ($_SESSION['type'] == 1)
        echo "Ошибка сохранения . <p><a href=grup.php> Вернуться к списку Групп </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Ошибка сохранения . <p><a href=grupAdm.php> Вернуться к списку Групп </a>";
}
mysqli_close($link);
?>
