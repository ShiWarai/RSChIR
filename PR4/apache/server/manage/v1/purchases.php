<?php

use objects\Purchase;

include_once("config/database.php");
include_once("repositories/purchaseRepository.php");

error_reporting(E_ERROR | E_PARSE);
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents("php://input"));

global $database;
$db = $database->get_connection();
$repository = new PurchaseRepository($db);

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

            $result = $repository->create($purchase);

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
            $result = $repository->read_all();

            http_response_code(200);
            echo json_encode($result);
        } else {
            $result = $repository->read($_GET["id"]);
            if ($result != null) {
                $purchase = new Purchase();
                $purchase->copy($result);

                http_response_code(200);
                echo json_encode((array) $purchase);
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

            $result = $repository->update($purchase);

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
            $result = $repository->delete($_GET["id"]);
            if ($result == 1)
                http_response_code(200);
            elseif ($result == 0)
                http_response_code(409);
            else
                http_response_code(404);
        }
        break;
}

