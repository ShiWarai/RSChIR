<?php

class ErrorController extends Controller {

    public function index() {
        $this->view->generate('NotFoundView.php');
    }
}