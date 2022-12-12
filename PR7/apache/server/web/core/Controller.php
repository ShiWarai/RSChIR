<?php
include_once "../view/UnauthorizedView.php";
include_once "web/model/ShopDatabase.php";

class Controller {

    public $model;
    public $view;
    protected ShopDatabase $db;

    function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
        $this->db = new ShopDatabase();
    }

    function index()
    {
    }

    function auth(): bool
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            $this->unauthorized();
            return false;
        }

        $mysqli = $this->db->createConnection();
        $hashed_password = $mysqli->query("SELECT password FROM user WHERE login = \"{$_SERVER['PHP_AUTH_USER']}\"")->fetch_array()[0];
        $user_supplied_password = $_SERVER['PHP_AUTH_PW'];
        if ($hashed_password == crypt($user_supplied_password, $hashed_password)) {
            return true;
        }
        else
        {
            $this->unauthorized();
            return false;
        }
    }

    function unauthorized()
    {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        $this->view->generate('UnauthorizedView.php');
    }
}