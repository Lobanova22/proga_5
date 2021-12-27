<html>
<head>
    <title> Редактирование Предметов </title>
</head>
<body>
<?php
include("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Невозможно подключиться к серверу";
}// установление соединения с сервером
$id_s = $_GET['id_s'];

$result = $mysqli->query("SELECT name_s, prep_s, fac_s, count_lec, count_lab
FROM subject WHERE id_s='$id_s'");
if ($result) {
    while ($gm = $result->fetch_array()) {
        $name_s = $gm['name_s'];
        $prep_s = $gm['prep_s'];
        $fac_s = $gm['fac_s'];
        $count_lec = $gm['count_lec'];
        $count_lab = $gm['count_lab'];
    }
}

print "<form action='save_edit_subject.php' method='get'>";
print "Предмет: <input name='name_s' size='30' type='text'
value='$name_s'>";
print "<br>Преподаватель: <input name='prep_s' size='30' type='text'
value='$prep_s'>";
print "<br>Факультет: <input name='fac_s' size='30' type='int'
value='$fac_s'>";
print "<br>Кол-во лекций: <input name='count_lec' size='30' type='text'
value='$count_lec'>";
print "<br>Кол-во лаб: <input name='count_lab' size='11' type='int'
value='$count_lab'>";
print "<input type='hidden' name='id_s' size='11' type='int'
value='$id_s'>";
print "<input type='submit' name='save' value='Сохранить'>";
print "</form>";
if ($_SESSION['type'] == 1)
    echo "<p><a href=subject.php> Вернуться назад </a>";
elseif ($_SESSION['type'] == 2)
    echo "<p><a href=subjectAdm.php> Вернуться назад </a>";
?>
</body>
</html>