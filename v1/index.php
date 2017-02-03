<?php

    error_reporting(-1);
    ini_set('display_errors', 'On');

    require_once '../include/db_handler.php';
    require '.././libs/Slim/Slim.php';

    \Slim\Slim::registerAutoloader();

    $app = new \Slim\Slim();


    // All Brand
    $app->get('/brand/', function() use ($app) {

        $db = new DbHandler();
        $response = $db->getAllBrand();
        echoResponse(200, $response);
    });

    // Number product by Brand
    $app->get('/brand/product/', function() use ($app) {

        $db = new DbHandler();
        $response = $db->getBrandProduct();
        echoResponse(200, $response);
    });


    // Brand by Id
    $app->get('/brand/:id', function($id) use ($app) {

        $db = new DbHandler();
        $response = $db->getBrandById($id);
        echoResponse(200, $response);
    });


    //Insert Brand
    $app->post('/brand/add', function() use ($app) {

        verifyRequiredParams(array('description', 'image'));

        $description = $app->request->post('description');
        $image = $app->request->post('image');

        $db = new DbHandler();
        $response = $db->addBrand($description, $image);

        echoResponse(200, $response);
    });


    // All Category
    $app->get('/category/', function() use ($app) {

        $db = new DbHandler();
        $response = $db->getAllCategory();
        echoResponse(200, $response);
    });

    // Number product by category
    $app->get('/category/product/', function() use ($app) {

        $db = new DbHandler();
        $response = $db->getCategoryProduct();
        echoResponse(200, $response);
    });


    // Insert Category
    $app->post('/category/add', function() use ($app) {

        verifyRequiredParams(array('description', 'image'));

        $description = $app->request->post('description');
        $image = $app->request->post('image');

        $db = new DbHandler();
        $response = $db->addCategory($description, $image);
        echoResponse(200, $response);
    });


    // Category by Id
    $app->get('/category/:id', function($id) use ($app) {

        $db = new DbHandler();
        $response = $db->getCategoryById($id);
        echoResponse(200, $response);
    });



    // All Product
    $app->get('/product/', function() use ($app) {

        $db = new DbHandler();
        $response = $db->getAllProduct();
        echoResponse(200, $response);
    });


    // Product by Id
    $app->get('/product/:id', function($id) use ($app) {

        $db = new DbHandler();
        $response = $db->getProductById($id);
        echoResponse(200, $response);
    });


    // Product by category_id
    $app->get('/category/:id/product/', function($id) use ($app) {

        $db = new DbHandler();
        $response = $db->getProductByCategoryId($id);
        echoResponse(200, $response);
    });


    // Product by brand_id
    $app->get('/brand/:id/product/', function($id) use ($app) {

        $db = new DbHandler();
        $response = $db->getProductByBrandId($id);
        echoResponse(200, $response);
    });


    //Insert Product
    $app->post('/product/add', function() use ($app) {

        verifyRequiredParams(array('description', 'price', 'brand_id', 'category_id', 'latitude', 'longitude', 'image',
            'outstanding'));

        $description = $app->request->post('description');
        $price = $app->request->post('price');
        $brand_id = $app->request->post('brand_id');
        $category_id = $app->request->post('category_id');
        $latitude = $app->request->post('latitude');
        $longitude = $app->request->post('longitude');
        $image = $app->request->post('image');
        $outstanding = $app->request->post('outstanding');

        $db = new DbHandler();
        $response = $db->addProduct($description, $price, $brand_id, $category_id, $latitude, $longitude, $image,
            $outstanding);

        echoResponse(200, $response);
    });


    //Add User
    $app->post('/user/add', function() use ($app) {

        verifyRequiredParams(array('name', 'lastname', 'surename', 'email', 'password'));

        $name = $app->request->post('name');
        $lastname = $app->request->post('lastname');
        $surename = $app->request->post('surename');
        $email = $app->request->post('email');
        $password = $app->request->post('password');

        $db = new DbHandler();
        $response = $db->addUser($name, $lastname, $surename, $email, $password);

        echoResponse(200, $response);
    });


    // All User
    $app->get('/user/', function() use ($app) {
    
        $db = new DbHandler();
        $response = $db->getAllUser();
        echoResponse(200, $response);
    });


    //Login
    $app->post('/user/login', function() use ($app) {

        verifyRequiredParams(array('email', 'password'));

        $email = $app->request->post('email');
        $password = $app->request->post('password');

        $db = new DbHandler();
        $response = $db->login($email, $password);

        echoResponse(200, $response);
    });

    // All Filters v2
    $app->get('/filter/', function() use ($app) {
    
        $db = new DbHandler();
        $response = $db->getAllFilter();
        echoResponse(200, $response);
    });


    //Add Coupon
    $app->post('/coupon/add', function() use ($app) {

        verifyRequiredParams(array('description', 'image'));

        $description = $app->request->post('description');
        $image = $app->request->post('image');

        $db = new DbHandler();
        $response = $db->addCoupon($description, $image);

        echoResponse(200, $response);
    });


    // All Coupon
    $app->get('/coupon/', function() use ($app) {

        $db = new DbHandler();
        $response = $db->getAllCoupon();
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