<html>
<head><title> Сведения о Расписании </title></head>
<body>
<h2>Сведения о Расписании:</h2>
<table border="1">
    <tr>
        <th>ID Расписания</th>
        <th>Группа</th>
        <th> Предмет</th>
        <th> Дата Консультации</th>
        <th> Дата Экзамена</th>
        <th> Аудитория</th>
        <th> Редактировать</th>
    </tr>
    </tr>
    <?php
    include("checks.php");
    require_once 'connect1.php';
    $mysqli = new mysqli($host, $user, $password, $database);
    if ($mysqli->connect_errno) {
        echo "Невозможно подключиться к серверу";
    }
    $result = $mysqli->query("SELECT rasp.id, subject.name_s as subject, grup.name_g as grup, rasp.date_con, rasp.date_ex, rasp.audit
FROM rasp 
LEFT JOIN subject ON rasp.id_s=subject.id_s
LEFT JOIN grup ON rasp.id_g=grup.id_g"); // запрос на выборку сведений о пользователях

    $counter = 0;
    if ($result) {
        while ($row = $result->fetch_array()) {// для каждой строки из запроса
            $id = $row['id'];
            $subject = $row['subject'];
            $grup = $row['grup'];
            $date_con = $row['date_con'];
            $date_ex = $row['date_ex'];
            $audit = $row['audit'];

            $date_con = date('d-m-Y', strtotime($date_con));
            $date_ex = date('d-m-Y', strtotime($date_ex));

            echo "<tr>";
            echo "<td>$id</td><td>$subject</td><td>$grup</td><td>$date_con</td><td>$date_ex</td><td>$audit</td>";

            echo "<td><a href='edit_rasp.php?id=" . $row['id']
                . "'>Редактировать</a></td>"; //Запуск редактирования
            echo "</tr>";
            $counter++;
        }
    }
    print "</table>";
    print("<p>Всего Предметов: $counter </p>");
    echo "<p><a href=new_rasp.php> Добавить Расписание </a>";
    if ($_SESSION['type'] == 1)
        echo "<p><a href=subject.php> Вернуться назад </a>";
    elseif ($_SESSION['type'] == 2)
        echo "<p><a href=subjectAdm.php> Вернуться назад </a>";
    include("checkSession.php");
    ?>
</body>
</html>
