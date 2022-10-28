<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Закупки</title>
    <link rel="stylesheet" href="/style.css" type="text/css"/>
</head>
<body>
<h1>Список закупок</h1>
<table>
    <tr><th>Имя</th><th>ID товара</th><th>Оптовая цена</th><th>Кол-во</th></tr>
    <?php
    $mysqli = new mysqli("db", "user", "password", "appDB");
    $result = $mysqli->query("SELECT * FROM purchase");
    foreach ($result as $row){
        echo "<tr><td>{$row['name']}</td><td>{$row['toy_id']}</td><td>{$row['wholesale_price']} р.</td><td>{$row['count']}</td></tr>";
    }
    ?>
</table>
</body>
</html>