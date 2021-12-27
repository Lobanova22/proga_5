<html>
<head>
    <title> Редактирование Расписания </title>
</head>
<body>
<?php
include("checks.php");
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Невозможно подключиться к серверу";
}// установление соединения с сервером
$id = $_GET['id'];
$prod = mysqli_query($mysqli, "SELECT
			rasp.id,
			rasp.date_con,
			rasp.date_ex,
			rasp.audit,

			subject.id_s as id_s,
			subject.name_s as name_s,

			grup.id_g as id_g,
			grup.name_g as name_g

			FROM rasp
			LEFT JOIN subject ON rasp.id_s=subject.id_s
			LEFT JOIN grup ON rasp.id_g=grup.id_g
			WHERE rasp.id='$id'"
);

if ($prod) {
    $prod = $prod->fetch_array();

    $id = $prod['id'];
    $date_con = $prod['date_con'];
    $date_ex = $prod['date_ex'];
    $audit = $prod['audit'];

    $id_g = $prod['id_g'];
    $name_g = $prod['name_g'];

    $id_s = $prod['id_s'];
    $name_s = $prod['name_s'];

}


print "<form action='save_edit_rasp.php' method='get'>";


$result = $mysqli->query("SELECT id_s, name_s FROM subject WHERE id_s <> '$id_s' ");
echo "<br>Предмет:<select name='id_s'>";
echo "<option selected value='$id_s'>$name_s</option>";
if ($result) {
    while ($row = $result->fetch_array()) {
        $id_s = $row['id_s'];
        $name_s = $row['name_s'];
        echo "<option value='$id_s'>$name_s</option>";

    }
}
echo "</select>";

//работа с магазинами

$result = $mysqli->query("SELECT id_g, name_g FROM grup WHERE id_g <> '$id_g' ");
echo "<br>Группа: <select name='id_g'>";
echo "<option selected value='$id_g'>$name_g</option>";

if ($result) {
    while ($row = $result->fetch_array()) {
        $id_g = $row['id_g'];
        $name_g = $row['name_g'];
        echo "<option value='$id_g'>$name_g</option>";
    }
}
echo "</select>";


print "<br> Дата консультации: <input name='date_con' placeholder='dd-mm-yyyy' type='date' value=$date_con>";
print "<br> Дата экзамена: <input name='date_ex' placeholder='dd-mm-yyyy' type='date' value=$date_ex>";
print "<br> Аудитория: <input name='audit' size='11' type='int' value=$audit>";
print "<input type='hidden' name='id' size='11' value=$id>";
print "<input  name='save' type='submit' value='Сохранить'>";
print "</form>";
if ($_SESSION['type'] == 1)
    echo "<p><a href=rasp.php> Вернуться назад </a>";
elseif ($_SESSION['type'] == 2)
    echo "<p><a href=raspAdm.php> Вернуться назад </a>";
?>
</body>
</html>