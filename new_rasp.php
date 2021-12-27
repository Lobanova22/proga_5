<html>
<head><title> Добавление нового Расписания </title></head>
<body>
<H2>Добавление нового Расписания:</H2>
<form action="save_new_rasp.php" method="get">
    <?php
    include ("checks.php");
    require_once 'connect1.php';
    $mysqli = new mysqli($host, $user, $password, $database);
    if ($mysqli->connect_errno) {
        echo "Невозможно подключиться к серверу";
    }

    $result = $mysqli->query("SELECT id_s, name_s FROM subject");
    echo "<br>Предмет: <select name='id_s'>";

    if ($result) {
        while ($row = $result->fetch_array()) {
            $id_s = $row['id_s'];
            $name_s = $row['name_s'];
            echo "<option value='$id_s'>$name_s</option>";
        }
    }
    echo "</select>";

    $result = $mysqli->query("SELECT id_g, name_g FROM grup");
    echo "<br>Группа: <select name='id_g'>";

    if ($result) {
        while ($row = $result->fetch_array()) {
            $id_g = $row['id_g'];
            $name_g = $row['name_g'];
            echo "<option value='$id_g'>$name_g</option>";
        }
    }
    echo "</select>";

    print "<br> дата Консультации: <input name='date_con' placeholder='dd-mm-yyyy' type='date' value=$date_con>";
    print "<br> дата Экзамена: <input name='date_ex' placeholder='dd-mm-yyyy' type='date' value=$date_ex>";
    print "<br> Аудитория: <input name='audit' size='11' type='text' value=$audit>";
    echo "<p><input name='add' type='submit' value='Добавить'></p>";
    echo "<p><input name='b2' type='reset' value='Очистить'></p>";
    if ($_SESSION['type'] == 1)
        echo "<p><a href=rasp.php> Вернуться к списку ключей </a></p>";
    elseif ($_SESSION['type'] == 2)
        echo "<p><a href=raspAdm.php> Вернуться к списку ключей </a></p>";
    ?>
</form>
</body>
</html>
