<?php
require_once "../session.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Графики и таблицы с данными</title>
    <link rel="stylesheet" href="/style.css" type="text/css"/>
</head>
<body>
<?php
require_once "faker.php";

generate_data();
?>
<?php
require_once "plot_bar.php";
require_once "plot_pie.php";
require_once "plot_scatter.php";

draw_plot_pie();
draw_plot_bar();
draw_plot_scatter();
?>
<h1>Данные фикстур:</h1>
<table class="table" style="font-size: 30%">
    <tr>
        <th>Name</th>
        <th>Color</th>
        <th>Month</th>
        <th>Emoji</th>
        <th>Blood Type</th>
        <th>Weekday</th>
    </tr>
    <?php
    $data = get_raw_data();

    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->color."</td>";
        echo "<td>".$data_row->month."</td>";
        echo "<td>".$data_row->emoji."</td>";
        echo "<td>".$data_row->bloodType."</td>";
        echo "<td>".$data_row->weekday."</td>";
        echo "</tr>";
    }
    ?>
</table>

<br>
<?php
require_once "watermark.php";

$images = array("images/plot_pie.png", "images/plot_bar.png", "images/plot_scatter.png");

foreach ($images as $image) {
    add_watermark($image);
    echo "<img src=\"$image\">";
}
?>
</table>
</body>
</html>