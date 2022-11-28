<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка PDF</title>
    <link rel="stylesheet" href="/style.css" type="text/css"/>
</head>
<body>
<form enctype="multipart/form-data" action="loader.php" method="POST">
    <h2 for="file_field">Отправить этот файл</h2>
    <input id="file_field" name="userfile" type="file"/>
    <input type="submit" value="Отправить файл"/>
</form>
<br>

<?php
$files = scandir('./files');

if (count($files) <= 2) { # Default "." and ".."
    echo "<h2>Нет загруженных файлов</h2>";
} else {
    echo "<h2>Загруженные файлы</h2>";
    foreach ($files as $file) {
        if ($file != "." and $file != "..") {
            echo "<div><a href='./files/".$file."'>".$file."</a></div>";
        }
    }
}
?>
</body>
</html>
