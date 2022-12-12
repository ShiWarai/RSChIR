<?php

class V1Controller extends Controller {

    function purchases() {
        if($this->auth()) {
            error_reporting(E_ERROR | E_PARSE);
            header("Content-Type: application/json; charset=UTF-8");
            $data = json_decode(file_get_contents("php://input"));

            $this->db->createConnection();

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    if (
                        !empty($data->name) &&
                        !empty($data->toy_id) &&
                        !empty($data->wholesale_price) &&
                        !(empty($data->count) && $data->count <> 0)
                    ) {
                        $purchase = new Purchase();
                        $purchase->copy_data(-1, $data);

                        $result = $this->db->purchase_create($purchase);

                        if ($result) {
                            http_response_code(201);
                        } else {
                            http_response_code(409);
                        }
                    } else {
                        http_response_code(400);
                    }
                    break;
                case 'GET':
                    if (!isset($_GET["id"])) {
                        $result = $this->db->purchase_read_all();

                        http_response_code(200);
                        echo json_encode($result);
                    } else {
                        $result = $this->db->purchase_read($_GET["id"]);
                        if ($result != null) {
                            $purchase = new Purchase();
                            $purchase->copy($result);

                            http_response_code(200);
                            echo json_encode((array)$purchase);
                        } else {
                            http_response_code(404);
                        }
                    }
                    break;
                case 'PUT':
                    if (
                        isset($_GET["id"]) &&
                        !empty($data->name) &&
                        !empty($data->toy_id) &&
                        !empty($data->wholesale_price) &&
                        !(empty($data->count) && $data->count <> 0)
                    ) {
                        $purchase = new Purchase();
                        $purchase->copy_data($_GET["id"], $data);

                        $result = $this->db->purchase_update($purchase);

                        if ($result == 1)
                            http_response_code(200);
                        elseif ($result == 0)
                            http_response_code(208);
                        else
                            http_response_code(404);
                    } else {
                        http_response_code(400);
                    }
                    break;
                case 'DELETE':
                    if (!isset($_GET["id"])) {
                        http_response_code(400);
                    } else {
                        $result = $this->db->purchase_delete($_GET["id"]);
                        if ($result == 1)
                            http_response_code(200);
                        elseif ($result == 0)
                            http_response_code(409);
                        else
                            http_response_code(404);
                    }
                    break;
            }
        }
    }

    function toys() {
        if($this->auth()) {
            error_reporting(E_ERROR | E_PARSE);
            header("Content-Type: application/json; charset=UTF-8");
            $data = json_decode(file_get_contents("php://input"));

            $this->db->createConnection();

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    if (
                        !empty($data->name) &&
                        !empty($data->description) &&
                        !empty($data->price) &&
                        !(empty($data->count) && $data->count <> 0)
                    ) {
                        $toy = new Toy();
                        $toy->copy_data(-1, $data);

                        $result = $this->db->toy_create($toy);

                        if ($result) {
                            http_response_code(201);
                        } else {
                            http_response_code(409);
                        }
                    } else {
                        http_response_code(400);
                    }
                    break;
                case 'GET':
                    if (!isset($_GET["id"])) {
                        $result = $this->db->toy_read_all();

                        http_response_code(200);
                        echo json_encode($result);
                    } else {
                        $result = $this->db->toy_read($_GET["id"]);
                        if ($result != null) {
                            $toy = new Toy();
                            $toy->copy($result);

                            http_response_code(200);
                            echo json_encode((array)$toy);
                        } else {
                            http_response_code(404);
                        }
                    }
                    break;
                case 'PUT':
                    if (
                        isset($_GET
                            ["id"]) &&
                        !empty($data->name) &&
                        !empty($data->description) &&
                        !empty($data->price) &&
                        !(empty($data->count) && $data->count <> 0)
                    ) {
                        $toy = new Toy();
                        $toy->copy_data($_GET["id"], $data);

                        $result = $this->db->toy_update($toy);

                        if ($result == 1)
                            http_response_code(200);
                        elseif ($result == 0)
                            http_response_code(208);
                        else
                            http_response_code(404);
                    } else {
                        http_response_code(400);
                    }
                    break;
                case 'DELETE':
                    if (!isset($_GET["id"])) {
                        http_response_code(400);
                    } else {
                        $result = $this->db->toy_delete($_GET["id"]);
                        if ($result == 1)
                            http_response_code(200);
                        elseif ($result == 0)
                            http_response_code(409);
                        else
                            http_response_code(404);
                    }
                    break;
            }
        }
    }
}