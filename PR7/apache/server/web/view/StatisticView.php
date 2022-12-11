<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Графики и таблицы с данными</title>
    <link rel="stylesheet" href="/style.css" type="text/css"/>
</head>
<body>
<h1>Данные о покупателях:</h1>
<table class="table" style="font-size: 30%">
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Дата покупки</th>
        <th>Пол</th>
        <th>Тип крови</th>
    </tr>
    <?php
    foreach ($data['table'] as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->surname."</td>";
        echo "<td>".$data_row->date."</td>";
        echo "<td>".$data_row->gender."</td>";
        echo "<td>".$data_row->bloodType."</td>";
        echo "</tr>";
    }
    ?>
</table>

<br>
<?php
foreach ($data['images'] as $image) {
    echo "<img src=\"$image\">";
}
?>
</body>
</html>