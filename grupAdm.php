<html>
<head><title> Сведения о Группе </title></head>
<body>
<h2>Сведения о Группе:</h2>
<table border="1">
    <tr>
        <th>id Группы</th>
        <th>название</th>
        <th>Факультет</th>
        <th>Редактировать</th>
        <th>Уничтожить</th>
    </tr>
    </tr>
    <?php
    include("checks.php");
    require_once 'connect1.php';
    $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно
подключиться к серверу" . mysqli_error($link));
    $result = mysqli_query($link, "SELECT id_g, name_g, fac_g FROM grup"); // запрос на выборку сведений о пользователях
    mysqli_select_db($link, "grup");

    while ($row = mysqli_fetch_array($result)) {// для каждой строки из запроса
        echo "<tr>";
        echo "<td>" . $row['id_g'] . "</td>";
        echo "<td>" . $row['name_g'] . "</td>";
        echo "<td>" . $row['fac_g'] . "</td>";
        echo "<td><a href='edit_grup.php?id_g=" . $row['id_g']
            . "'>Редактировать</a></td>"; // запуск скрипта для редактирования
        echo "<td><a href='delete_grup.php?id_g=" . $row['id_g']
            . "'>Удалить</a></td>"; // запуск скрипта для удаления записи
        echo "</tr>";
    }
    print "</table>";
    $num_rows = mysqli_num_rows($result); // число записей в таблице БД
    print("<P>Всего Групп: $num_rows </p>");
    echo "<p><a href=new_grup.php> Добавить Группу </a>";
    if ($_SESSION['type'] == 1)
        echo "<p><a href=subject.php> Вернуться назад </a>";
    elseif ($_SESSION['type'] == 2)
        echo "<p><a href=subjectAdm.php> Вернуться назад </a>";
    include("checkSession.php");
    ?>
</body>
</html>