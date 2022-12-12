<?php
require_once "web/model/ShopDatabase.php";

class PurchasesController extends Controller
{

    function index()
    {
        if($this->auth()) {
            $mysqli = $this->db->createConnection();
            $data['purchases'] = $mysqli->query("SELECT * FROM purchase");
            $this->view->generate('PurchasesView.php', $data);
        }
    }
}
