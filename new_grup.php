<html>
<head><title> Добавление новой Группы </title></head>
<body>
<H2>Добавление новой Группы:</H2>
<?php include("checks.php"); ?>
<form action="save_new_grup.php" method="get">
    Название: <input name="name_g" size="50" type="text">
    <br>Факультет: <input name="fac_g" size="50" type="text">
    <p><input name="add" type="submit" value="Добавить">
        <input name="b2" type="reset" value="Очистить"></p>
</form>
<?php
if ($_SESSION['type'] == 1)
    echo "<p><a href=grup.php> Вернуться к списку Групп </a>";
elseif ($_SESSION['type'] == 2)
    echo "<p><a href=grupAdm.php> Вернуться к списку Групп </a>";
?>
</body>
</html>
