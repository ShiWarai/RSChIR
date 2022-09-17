<html lang="ru">
<head>
    <title>Сервис рисования SVG</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div style="padding: 16px 16px">
    <div>
        <form class="row g-3" method="GET">
            <div class="col-auto">
                <input type="number" name="generate_data"  min="1" class="form-control" id="inputNumber" placeholder="Целое число">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Сгенерировать</button>
            </div>
        </form>
    </div>
    <?php
    require_once 'Drawer.php';
    require_once 'Decoder.php';

    if (array_key_exists('generate_data', $_GET ))
        draw(Decoder::getParameters($_GET['generate_data']));
    ?>
</div>
</body>
</html>