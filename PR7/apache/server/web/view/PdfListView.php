<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка PDF</title>
    <link rel="stylesheet" href="/style.css" type="text/css"/>
</head>
<body>
<form enctype="multipart/form-data" action="upload.php" method="POST">
    <h2 for="file_field">Отправить этот файл</h2>
    <input id="file_field" name="userfile" type="file"/>
    <input type="submit" value="Отправить файл"/>
</form>
<br>

<?php
foreach ($data['files'] as $file) {
    echo "<div><a href='/download/pdf/$file'>".$file."</a></div>";
}
?>
</body>
</html>