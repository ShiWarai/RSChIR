<html lang="ru">
<head>
    <title>Консоль администратора</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div style="padding: 16px 16px">
    <div>
        <form class="row g-3" method="GET">
            <div class="col-auto">
                <button type="submit" name="ls"  class="btn btn-primary mb-3">ls</button>
            </div>
            <div class="col-auto">
                <button type="submit" name="ps"  class="btn btn-primary mb-3">ps</button>
            </div>
            <div class="col-auto">
                <button type="submit" name="whoami"  class="btn btn-primary mb-3">whoami</button>
            </div>
            <div class="col-auto">
                <button type="submit" name="id"  class="btn btn-primary mb-3">id</button>
            </div>
            <div class="col-auto">
                <button type="submit" name="pwd"  class="btn btn-primary mb-3">pwd</button>
            </div>
        </form>
    </div>
    <?php
    require_once 'commandExecution.php';

    if (array_key_exists('ls', $_GET )):
        getAnswerCommand('ls');
    elseif (array_key_exists('ps', $_GET)):
        getAnswerCommand('ps');
    elseif (array_key_exists('whoami', $_GET)):
        getAnswerCommand('whoami');
    elseif (array_key_exists('id', $_GET)):
        getAnswerCommand('id');
    elseif (array_key_exists('pwd', $_GET)):
        getAnswerCommand('pwd');
    endif;
    ?>
</div>
</body>
</html>