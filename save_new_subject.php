<?php
include("checks.php");
require_once 'connect1.php';
$link = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysql_connect_error());
    exit();
} // установление соединения с сервером и подключение к базе данных:
// Строка запроса на добавление записи в таблицу:
mysqli_query($link, "INSERT INTO subject SET name_s='" . $_GET['name_s']
    . "', prep_s='" . $_GET['prep_s'] . "', fac_s='"
    . $_GET['fac_s'] . "', count_lec='" . $_GET['count_lec'] .
    "', count_lab='" . $_GET['count_lab'] . "'");
if (mysqli_affected_rows($link) > 0) {
    print "<p>Спасибо, Ваш предмет добавлена в базу данных.";
    if ($_SESSION['type'] == 1)
        echo "<p><a href=subject.php> Вернуться к списку предметов </a>";
    elseif ($_SESSION['type'] == 2)
        echo "<p><a href=subjectAdm.php> Вернуться к списку предметов </a>";
} else {
    if ($_SESSION['type'] == 1)
        echo "Ошибка сохранения . <p><a href=subject.php> Вернуться к списку предметов </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Ошибка сохранения . <p><a href=subjectAdm.php> Вернуться к списку предметов </a>";
}
mysqli_close($link);
?>
