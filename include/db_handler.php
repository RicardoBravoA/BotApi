<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/db_connect.php';
        $db = new DbConnect();
        $this->conn = $db->connect();
    }


    // All Brand
    public function getAllBrand() {

        $response = array();
        $stmt = $this->conn->prepare("SELECT brand_id, description, image FROM brand");

        if($stmt->execute()){
            $stmt->bind_result($brand_id, $description, $image);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["brand_id"] = $brand_id;
                    $tmp["description"] = $description;
                    $tmp["image"] = $image;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }


    // Brand
    public function getBrand() {

        $stmt = $this->conn->prepare("SELECT brand_id, description FROM brand");

        $noData = array();

        if($stmt->execute()){
            $stmt->bind_result($brand_id, $description);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["brand_id"] = $brand_id;
                    $tmp["description"] = $description;
                    array_push($data, $tmp);
                }
                $stmt->close();
                return $data;
            }else{
                return $noData;
            }
        }else{
            return $noData;
        }

        return $response;
    }


    // Brand of Product
    public function getBrandOfProduct() {

        $stmt = $this->conn->prepare("SELECT DISTINCT p.brand_id, b.description FROM product p 
            INNER JOIN brand b on p.brand_id = b.brand_id ORDER BY b.description");

        $noData = array();

        if($stmt->execute()){
            $stmt->bind_result($brand_id, $description);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["brand_id"] = $brand_id;
                    $tmp["description"] = $description;
                    array_push($data, $tmp);
                }
                $stmt->close();
                return $data;
            }else{
                return $noData;
            }
        }else{
            return $noData;
        }

        return $response;
    }


    // All Brand with products number
    public function getBrandProduct() {
        $response = array();
        $stmt = $this->conn->prepare("SELECT DISTINCT b.brand_id, b.description, b.image, COUNT(p.brand_id) as total 
            FROM brand b INNER JOIN product p ON b.brand_id = p.brand_id GROUP BY b.brand_id");
        if($stmt->execute()){
            $stmt->bind_result($brand_id, $description, $image, $total);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["brand_id"] = $brand_id;
                    $tmp["description"] = $description;
                    $tmp["image"] = $image;
                    $tmp["total"] = $total;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }
        return $response;
    }


    // add Brand
    public function addBrand($description, $image) {
        $response = array();

        $stmt = $this->conn->prepare("INSERT INTO brand(description, image) VALUES(?,?)");
        $stmt->bind_param("ss", $description, $image);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $meta = array();
            $meta["status"] = "success";
            $meta["code"] = "200";
            $response["_meta"] = $meta;
        } else {
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }


    // Get Brand by Id
    public function getBrandById($id) {

        $response = array();
        $stmt = $this->conn->prepare("SELECT brand_id, description, image FROM brand WHERE brand_id = ?");
        $stmt->bind_param("s", $id);

        if($stmt->execute()){
            $stmt->bind_result($brand_id, $description, $image);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["brand_id"] = $brand_id;
                    $tmp["description"] = $description;
                    $tmp["image"] = $image;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }


        return $response;
    }


    // All Category
    public function getAllCategory() {

        $response = array();
        $stmt = $this->conn->prepare("SELECT category_id, description, image FROM category");

        if($stmt->execute()){
            $stmt->bind_result($category_id, $description, $image);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["category_id"] = $category_id;
                    $tmp["description"] = $description;
                    $tmp["image"] = $image;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }

    // Category
    public function getCategory() {

        $noData = array();

        $stmt = $this->conn->prepare("SELECT category_id, description FROM category");

        if($stmt->execute()){
            $stmt->bind_result($category_id, $description);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["category_id"] = $category_id;
                    $tmp["description"] = $description;
                    array_push($data, $tmp);
                }
                $stmt->close();
                return $data;
            }else{
                return $noData;
            }
        }else{
            return $noData;
        }

        return $response;
    }


    // Category of Product
    public function getCategoryOfProduct() {

        $stmt = $this->conn->prepare("SELECT DISTINCT p.category_id, c.description FROM product p 
            INNER JOIN category c on p.category_id = c.category_id ORDER BY c.description");

        $noData = array();

        if($stmt->execute()){
            $stmt->bind_result($category_id, $description);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["category_id"] = $category_id;
                    $tmp["description"] = $description;
                    array_push($data, $tmp);
                }
                $stmt->close();
                return $data;
            }else{
                return $noData;
            }
        }else{
            return $noData;
        }

        return $response;
    }


    //Category By Id
    public function getCategoryByBrandId($id) {

        $noData = array();

        $stmt = $this->conn->prepare("SELECT DISTINCT p.category_id, c.description FROM product p 
              INNER JOIN category c on p.category_id = c.category_id WHERE p.brand_id = $id ORDER BY c.description");

        if($stmt->execute()){
            $stmt->bind_result($category_id, $description);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["category_id"] = $category_id;
                    $tmp["description"] = $description;
                    array_push($data, $tmp);
                }
                $stmt->close();
                return $data;
            }else{
                return $noData;
            }
        }else{
            return $noData;
        }

        return $response;
    }


    // All Category with number products
    public function getCategoryProduct() {

        $response = array();
        $stmt = $this->conn->prepare("SELECT DISTINCT c.category_id, c.description, c.image, COUNT(c.category_id) as total 
            FROM category c INNER JOIN product p ON c.category_id = p.category_id GROUP BY c.category_id");

        if($stmt->execute()){
            $stmt->bind_result($category_id, $description, $image, $total);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["category_id"] = $category_id;
                    $tmp["description"] = $description;
                    $tmp["image"] = $image;
                    $tmp["total"] = $total;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }


    // add Category
    public function addCategory($description, $image) {
        $response = array();

        $stmt = $this->conn->prepare("INSERT INTO category(description, image) VALUES(?,?)");
        $stmt->bind_param("ss", $description, $image);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $meta = array();
            $meta["status"] = "success";
            $meta["code"] = "200";
            $response["_meta"] = $meta;
        } else {
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }


    // Get Category by Id
    public function getCategoryById($id) {

        $response = array();
        $stmt = $this->conn->prepare("SELECT category_id, description, image FROM category WHERE category_id = ?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->bind_result($category_id, $description, $image);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["category_id"] = $category_id;
                    $tmp["description"] = $description;
                    $tmp["image"] = $image;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }
        return $response;
    }


    // All Products
    public function getAllProduct() {

        $response = array();
        $stmt = $this->conn->prepare("SELECT product_id, description, price, brand_id, category_id, latitude, 
longitude, image, outstanding from product");

        if($stmt->execute()){
            $stmt->bind_result($product_id, $description, $price, $brand_id, $category_id, $latitude, $longitude,
                $image, $outstanding);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["product_id"] = $product_id;
                    $tmp["description"] = $description;
                    $tmp["price"] = $price;
                    $tmp["brand_id"] = $brand_id;
                    $tmp["category_id"] = $category_id;
                    $tmp["latitude"] = $latitude;
                    $tmp["longitude"] = $longitude;
                    $tmp["image"] = $image;
                    $tmp["outstanding"] = $outstanding;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }
        return $response;
    }


    // Get Product by Id
    public function getProductById($id) {

        $response = array();
        $stmt = $this->conn->prepare("SELECT product_id, description, price, brand_id, category_id, latitude, 
longitude, image, outstanding from product WHERE product_id = ?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->bind_result($product_id, $description, $price, $brand_id, $category_id, $latitude, $longitude,
                $image, $outstanding);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["product_id"] = $product_id;
                    $tmp["description"] = $description;
                    $tmp["price"] = $price;
                    $tmp["brand_id"] = $brand_id;
                    $tmp["category_id"] = $category_id;
                    $tmp["latitude"] = $latitude;
                    $tmp["longitude"] = $longitude;
                    $tmp["image"] = $image;
                    $tmp["outstanding"] = $outstanding;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }
        return $response;
    }

    // Get Product by category_id
    public function getProductByCategoryId($id) {

        $response = array();
        $stmt = $this->conn->prepare("SELECT product_id, description, price, brand_id, category_id, latitude, 
longitude, image, outstanding from product WHERE category_id = ?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->bind_result($product_id, $description, $price, $brand_id, $category_id, $latitude, $longitude,
                $image, $outstanding);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["product_id"] = $product_id;
                    $tmp["description"] = $description;
                    $tmp["price"] = $price;
                    $tmp["brand_id"] = $brand_id;
                    $tmp["category_id"] = $category_id;
                    $tmp["latitude"] = $latitude;
                    $tmp["longitude"] = $longitude;
                    $tmp["image"] = $image;
                    $tmp["outstanding"] = $outstanding;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }
        return $response;
    }


    // Get Product by brand_id
    public function getProductByBrandId($id) {

        $response = array();
        $stmt = $this->conn->prepare("SELECT product_id, description, price, brand_id, category_id, latitude, 
longitude, image, outstanding from product WHERE brand_id = ?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->bind_result($product_id, $description, $price, $brand_id, $category_id, $latitude, $longitude,
                $image, $outstanding);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["product_id"] = $product_id;
                    $tmp["description"] = $description;
                    $tmp["price"] = $price;
                    $tmp["brand_id"] = $brand_id;
                    $tmp["category_id"] = $category_id;
                    $tmp["latitude"] = $latitude;
                    $tmp["longitude"] = $longitude;
                    $tmp["image"] = $image;
                    $tmp["outstanding"] = $outstanding;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }
        return $response;
    }


    // add Product
    public function addProduct($description, $price, $brand_id, $category_id, $latitude, $longitude,
                               $image, $outstanding) {
        $response = array();

        $stmt = $this->conn->prepare("INSERT INTO product(description, price, brand_id, category_id, 
latitude, longitude, image, outstanding) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $description, $price, $brand_id, $category_id, $latitude, $longitude,
            $image, $outstanding);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $meta = array();
            $meta["status"] = "success";
            $meta["code"] = "200";
            $response["_meta"] = $meta;
        } else {
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $meta["message"] = "Error al registar Product";
            $response["_meta"] = $meta;
        }

        return $response;
    }


    // add User
    public function addUser($name, $lastname, $surename, $email, $password) {
        $response = array();

        $stmt = $this->conn->prepare("INSERT INTO user(name, lastname, surename, email, password) VALUES(?, ?, ?, ?, md5(?))");
        $stmt->bind_param("sssss", $name, $lastname, $surename, $email, $password);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $meta = array();
            $meta["status"] = "success";
            $meta["code"] = "200";
            $response["_meta"] = $meta;
        } else {
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }


    // All User
    public function getAllUser() {

        $response = array();
        $stmt = $this->conn->prepare("SELECT user_id, name, lastname, surename, email FROM user");

        if($stmt->execute()){
            $stmt->bind_result($user_id, $name, $lastname, $surename, $email);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["user_id"] = $user_id;
                    $tmp["name"] = $name;
                    $tmp["lastname"] = $lastname;
                    $tmp["surename"] = $surename;
                    $tmp["email"] = $email;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }


    // Login
    public function login($email, $password) {

        $response = array();
        $stmt = $this->conn->prepare("SELECT user_id, name, lastname, surename, email FROM user WHERE email = ? AND 
              password = MD5(?)");

        $stmt->bind_param("ss", $email, $password);
        if($stmt->execute()){
            $stmt->bind_result($user_id, $name, $lastname, $surename, $email);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["user_id"] = $user_id;
                    $tmp["name"] = $name;
                    $tmp["lastname"] = $lastname;
                    $tmp["surename"] = $surename;
                    $tmp["email"] = $email;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }
        return $response;

    }


    // All Filter
    public function getAllFilterv1() {

        $response = array();
        $data = array();

        $meta = array();
        $meta["status"] = "error";
        $meta["code"] = "101";
        $response["_meta"] = $meta;

        $brand = $this->getBrand();

        $category = $this->getCategory();

        $_meta = array();
        $_meta["status"]="success";
        $_meta["code"]="200";
        $response["_meta"] = $_meta;
        $data["brand"] = $brand;
        $data["category"] = $category;
        $response["data"] = $data;

        return $response;
    }



    // All Filter
    public function getAllFilter() {

        $response = array();
        $stmt = $this->conn->prepare("SELECT DISTINCT p.brand_id, b.description FROM product p 
            INNER JOIN brand b on p.brand_id = b.brand_id ORDER BY b.description");

        if($stmt->execute()){
            $stmt->bind_result($brand_id, $description);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["brand_id"] = $brand_id;
                    $tmp["description"] = $description;
                    $category = $this->getCategoryByBrandId($brand_id);
                    $tmp["category"] = $category;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $response["brand"] = $this->getBrandOfProduct();
                $response["category"] = $this->getCategoryOfProduct();
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }

    // add User
    public function addCoupon($description, $image) {
        $response = array();

        $stmt = $this->conn->prepare("INSERT INTO coupon(description, image, state) VALUES(?, ?, true)");
        $stmt->bind_param("ss", $description, $image);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $meta = array();
            $meta["status"] = "success";
            $meta["code"] = "200";
            $response["_meta"] = $meta;
        } else {
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }


    // All Coupon
    public function getAllCoupon() {

        $response = array();
        $stmt = $this->conn->prepare("SELECT coupon_id, description, image, state FROM coupon");

        if($stmt->execute()){
            $stmt->bind_result($coupon_id, $description, $image, $state);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $data = array();
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["coupon_id"] = $coupon_id;
                    $tmp["description"] = $description;
                    $tmp["image"] = $image;
                    $tmp["state"] = $state;
                    array_push($data, $tmp);
                }
                $_meta = array();
                $_meta["status"]="success";
                $_meta["code"]="200";
                $response["_meta"] = $_meta;
                $response["data"] = $data;
                $stmt->close();
                return $response;
            }else{
                $meta = array();
                $meta["status"] = "error";
                $meta["code"] = "101";
                $response["_meta"] = $meta;
            }
        }else{
            $meta = array();
            $meta["status"] = "error";
            $meta["code"] = "100";
            $response["_meta"] = $meta;
        }

        return $response;
    }


}

?>