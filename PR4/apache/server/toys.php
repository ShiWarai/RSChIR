<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Игрушки</title>
    <link rel="stylesheet" href="/style.css" type="text/css"/>
</head>
<body>
<h1>Список игрушек</h1>
<table>
    <tr><th>Id</th><th>Имя</th><th>Цена</th></tr>
<?php
$mysqli = new mysqli("db", "user", "password", "appDB");
$result = $mysqli->query("SELECT * FROM toy");
foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['price']} р.</td></tr>";
}
?>
</table>
</body>
</html>