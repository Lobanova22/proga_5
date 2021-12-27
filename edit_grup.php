<html>
<head>
    <title> Редактирование Группы </title>
</head>
<body>
<?php
include("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Невозможно подключиться к серверу";
}// установление соединения с сервером
$id_g = $_GET['id_g'];

$result = $mysqli->query("SELECT name_g, fac_g FROM grup WHERE id_g='$id_g'");
if ($result) {
    while ($gm = $result->fetch_array()) {
        $name_g = $gm['name_g'];
        $fac_g = $gm['fac_g'];
    }
}

print "<form action='save_edit_grup.php' method='get'>";
print "Название: <input name='name_g' size='30' type='varchar'
value='$name_g'>";
print "<br>url: <input name='fac_g' size='30' type='varchar'
value='$fac_g'>";
print "<input type='hidden' name='id_g' size='11' type='int'
value='$id_g'>";
print "<input type='submit' name='save' value='Сохранить'>";
print "</form>";
if ($_SESSION['type'] == 1)
    echo "<p><a href=grup.php> Вернуться назад </a>";
elseif ($_SESSION['type'] == 2)
    echo "<p><a href=grupAdm.php> Вернуться назад </a>";
?>
</body>
</html>