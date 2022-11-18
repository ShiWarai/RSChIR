<?php
$uploaddir = '/var/www/html/manage/pdf/files/';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

echo '<pre>';
setlocale(LC_ALL,'en_US.UTF-8');
$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
if ($ext != "pdf" || !str_contains(file_get_contents($_FILES['userfile']['tmp_name']), "%PDF-")) {
    echo "Вы попытались загрузить не pdf файл";
} else {
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Файл загружен\n";
    } else {
        echo "Ошибка загрузки файла!\n";
    }
}
echo "</pre>";
?>
<a href="files.php">К списку</a>
