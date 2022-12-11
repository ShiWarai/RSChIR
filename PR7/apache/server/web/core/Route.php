<?php
class Route
{

    private static string $controllers_path = "web/controller/";
    private static string $models_path = "web/model/";

    static function start(): void
    {
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) )
        {

            $controller_name = ucfirst($routes[1]);
        }

        if ( !empty($routes[2]) )
        {
            $routes[2] = explode('?', $routes[2])[0];
            $action_name =  explode('.php', $routes[2])[0];
        }

        $model_name = $controller_name.'Model';
        $controller_name = $controller_name.'Controller';

        $model_file = $model_name.'.php';
        $model_path = self::$models_path.$model_file;
        if(file_exists($model_path))
        {
            include $model_path;
        }

        $controller_file = $controller_name.'.php';
        $controller_path = self::$controllers_path.$controller_file;
        if(file_exists($controller_path))
        {
            include $controller_path;
        }
        else
        {
            self::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
        {
            self::ErrorPage404();
        }
    }

    static function ErrorPage404(): void
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");

        include self::$controllers_path."ErrorController.php";

        $error_controller = new ErrorController();
        $error_controller->index();
    }
}