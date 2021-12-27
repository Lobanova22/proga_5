<html>
<head><title> Добавление нового Предмета </title></head>
<body>
<H2>Добавление нового Предмета:</H2>
<?php include("checks.php"); ?>
<form action="save_new_subject.php" method="get">
    Название: <input name="name_s" size="50" type="text">
    <br>Преподаватель: <input name="prep_s" size="50" type="text">
    <br>Факультет: <input name="fac_s" size="50" type="text">
    <br>Кол-во лекций: <input name="count_lec" size="11" type="int">
    <br>Кол-во лаб: <input name="count_lab" size="11" type="int">
    <p><input name="add" type="submit" value="Добавить">
        <input name="b2" type="reset" value="Очистить"></p>
</form>
<?php
if ($_SESSION['type'] == 1)
    echo "<p><a href=subject.php> Вернуться к списку Предметов </a>";
elseif ($_SESSION['type'] == 2)
    echo "<p><a href=subjectAdm.php> Вернуться к списку Предметов </a>";
?>
</body>
</html>
