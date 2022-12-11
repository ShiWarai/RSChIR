<?php
require_once "web/model/ShopDatabase.php";

class ToysController extends Controller
{
    private ShopDatabase $db;

    function __construct()
    {
        parent::__construct();
        $this->db = new ShopDatabase();
    }

    function index()
    {
        $mysqli = $this->db->createConnection();
        $data['toys'] =  $mysqli->query("SELECT * FROM toy");
        $this->view->generate('ToysView.php', $data);
    }
}
