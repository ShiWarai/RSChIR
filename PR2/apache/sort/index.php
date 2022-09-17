<html lang="ru">
<head>
    <title>Сервис для сортировки</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div style="padding: 16px 16px">
    <h2>Быстрая сортировка</h2>
    <div>
        <form class="row g-3" method="GET">
            <div class="col-auto">
                <input type="string" name="numbers" class="form-control" id="inputNumber" placeholder="Числа через запятую">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Отсортировать</button>
            </div>
        </form>
    </div>
    <h5>
        <?php
        require_once 'quickSort.php';
        require_once 'convert.php';

        if (array_key_exists('numbers', $_GET )){
            echo "Числа по возрастанию: ";
            echo implode(",", (quickSort(convert($_GET['numbers']))));
        }
        ?>
    </h5>
</div>
</body>
</html>
