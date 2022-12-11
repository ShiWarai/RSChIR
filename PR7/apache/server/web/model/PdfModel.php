<?php
class PdfModel extends Model {

    public function getFiles(): array
    {
        $files = scandir($_SERVER['DOCUMENT_ROOT'].'/download/pdf');

        $real_files = [];
        if (count($files) > 2) {
            foreach ($files as $file) {
                if ($file != "." and $file != "..") {
                    $real_files[] = $file;
                }
            }
        }

        return $real_files;
    }

    public function uploadFile(): string
    {
        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/download/pdf/';
        $uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

        setlocale(LC_ALL,'en_US.UTF-8');
        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
        if ($ext != "pdf" || ! str_contains(file_get_contents($_FILES['userfile']['tmp_name']), "%PDF-")) {
            return "Вы попытались загрузить не pdf файл";
        } else {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                return "Файл загружен\n";
            } else {
                return "Ошибка загрузки файла!\n";
            }
        }
    }
}