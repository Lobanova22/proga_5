<html>
<body>
<?php
include("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Невозможно подключиться к серверу";
} // установление соединения с сервером

$id_s = $_GET['id_s'];

$name_s = $_GET['name_s'];
$prep_s = $_GET['prep_s'];
$fac_s = $_GET['fac_s'];
$count_lec = $_GET['count_lec'];
$count_lab = $_GET['count_lab'];

$zapros = "UPDATE subject SET name_s='$name_s', prep_s='$prep_s',
fac_s='$fac_s', count_lec='$count_lec', count_lab='$count_lab' 
WHERE id_s='$id_s'";

$result = $mysqli->query($zapros);

if ($result) {
    if ($_SESSION['type'] == 1)
        echo "Все сохранено.<a href=subject.php> Вернуться к списку Предметов </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Все сохранено.<a href=subjectAdm.php> Вернуться к списку Предметов </a>";
} else {
    if ($_SESSION['type'] == 1)
        echo "Ошибка сохранения.<a href=subject.php> Вернуться к списку Предметов </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Ошибка сохранения.<a href=subjectAdm.php> Вернуться к списку Предметов </a>";
}
?>
</body>
</html>