<html>
<head><title> Сведения о Предметах </title></head>
<body>
<h2>Сведения о Предметах:</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Наимование</th>
        <th> Преподаватель</th>
        <th> Факультет</th>
        <th> Кол-во лекций</th>
        <th> Кол-во лаб</th>
        <th> Редактировать</th>
        <th> Уничтожить</th>
    </tr>
    </tr>
    <?php
    include("checks.php");
    require_once 'connect1.php';
    $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно
подключиться к серверу" . mysqli_error($link));
    $result = mysqli_query($link, "SELECT id_s, name_s, prep_s, fac_s, count_lec, count_lab
FROM subject"); // запрос на выборку сведений о пользователях
    mysqli_select_db($link, "subejct");

    while ($row = mysqli_fetch_array($result)) {// для каждой строки из запроса
        echo "<tr>";
        echo "<td>" . $row['id_s'] . "</td>";
        echo "<td>" . $row['name_s'] . "</td>";
        echo "<td>" . $row['prep_s'] . "</td>";
        echo "<td>" . $row['fac_s'] . "</td>";
        echo "<td>" . $row['count_lec'] . "</td>";
        echo "<td>" . $row['count_lab'] . "</td>";
        echo "<td><a href='edit_subject.php?id_s=" . $row['id_s']
            . "'>Редактировать</a></td>"; // запуск скрипта для редактирования
        echo "<td><a href='delete_subject.php?id_s=" . $row['id_s']
            . "'>Удалить</a></td>"; // запуск скрипта для удаления записи
        echo "</tr>";
    }
    print "</table>";
    $num_rows = mysqli_num_rows($result); // число записей в таблице БД
    print("<P>Всего Предметов: $num_rows </p>");
    if ($_SESSION['type'] == 1) {
        echo "<p><a href=new_subject.php> Добавить Предмет</a>";
        echo "<p><a href=rasp.php>Расписание</a>";
        echo "<p><a href=grup.php>Группы</a>";
        echo "<p><a href=edit_users.php?id_u=" . $_SESSION['id_u'] . "> Изменить данные Оператора</a>";
    } elseif ($_SESSION['type'] == 2) {
        echo "<p><a href=new_subject.php> Добавить Предмет</a>";
        echo "<p><a href=raspAdm.php>Расписание</a>";
        echo "<p><a href=grupAdm.php>Группы</a>";
        echo "<p><a href=usersAdm.php>Изменить данные Пользователей</a>";
    }
    echo "<p><a href=gen_pdf.php>Скачать pdf-файл</a>";
    echo "<p><a href=gen_xls.php>Скачать xls-файл</a>";
    include("checkSession.php");
    ?>
</body>
</html>