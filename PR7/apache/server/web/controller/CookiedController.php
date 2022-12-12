<?php
include_once "vendor/autoload.php";
include_once "web/model/FakerDataModel.php";
include_once "web/model/PlotModel.php";

class CookiedController extends Controller {

    function index() {
        $data = array();

        $data['theme'] = '/light_theme.css';
        if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
            $data['theme'] = '/dark_theme.css';
        }

        $data['lang'] = "web/view/CookiedViews/CookiedViewRu.php";
        if (!empty($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
            $data['lang'] = "web/view/CookiedViews/CookiedViewEn.php";
        }

        $this->view->generate("CookiedView.php", $data);
    }
}