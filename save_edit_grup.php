<html>
<body>
<?php
include("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Невозможно подключиться к серверу";
} // установление соединения с сервером

$id_g = $_GET['id_g'];
$name_g = $_GET['name_g'];
$fac_g = $_GET['fac_g'];

$zapros = "UPDATE grup SET name_g='$name_g', fac_g='$fac_g' 
WHERE id_g='$id_g'";

$result = $mysqli->query($zapros);

if ($result) {
    if ($_SESSION['type'] == 1)
        echo "Все сохранено.<a href=grup.php> Вернуться к списку Групп </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Все сохранено.<a href=grupAdm.php> Вернуться к списку Групп </a>";
} else {
    if ($_SESSION['type'] == 1)
        echo "Ошибка сохранения.<a href=grup.php> Вернуться к списку Групп </a>";
    elseif ($_SESSION['type'] == 2)
        echo "Ошибка сохранения.<a href=grupAdm.php> Вернуться к списку Групп </a>";
}
?>
</body>
</html>