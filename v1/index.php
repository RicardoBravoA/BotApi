<?php

    error_reporting(-1);
    ini_set('display_errors', 'On');

    require_once '../include/db_handler.php';
    require '.././libs/Slim/Slim.php';

    \Slim\Slim::registerAutoloader();

    $app = new \Slim\Slim();


    // Synchronize
    $app->get('/synchronize/', function() use ($app) {

        $db = new DbHandler();
        $response = $db->getSynchronize();
        echoResponse(200, $response);
    });

    // Synchronize
    $app->post('/message/', function() use ($app) {

        verifyRequiredParams(array('message', 'id', 'operation_id', 'property_id'));
        $message = $app->request->post('message');
        $id = $app->request->post('id');
        $operation_id = $app->request->post('operation_id');
        $property_id = $app->request->post('property_id');
        $db = new DbHandler();
        $response = $db->postMessage($message, $id, $operation_id, $property_id);
        echoResponse(200, $response);
    });

    function echoResponse($status_code, $response) {
        $app = \Slim\Slim::getInstance();

        $app->status($status_code);
        $app->contentType('application/json');

        echo json_encode($response);
    }

    function verifyRequiredParams($required_fields) {
        $error = false;
        $error_fields = "";
        $request_params = $_REQUEST;

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $app = \Slim\Slim::getInstance();
            parse_str($app->request()->getBody(), $request_params);
        }
        foreach ($required_fields as $field) {
            if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
                $error = true;
                $error_fields .= $field . ', ';
            }
        }

        if ($error) {
            $response = array();
            $app = \Slim\Slim::getInstance();

            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "1000";
            $meta["message"] = 'Campo requerido ' . substr($error_fields, 0, -2) . ', se encuentra vacio o nulo';
            $response["_meta"] = $meta;
            echoResponse(400, $response);
            $app->stop();
        }
    }

    $app->run();

?>