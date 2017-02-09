<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/db_connect.php';
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /*
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
    */

    // Message
    public function postMessage($message, $operation, $property_type){
        $response = array();
        $error = true;
        $stmt = $this->conn->prepare("SELECT message_default_id, message, operation, property_type, response_1, response_2, response_type_id FROM message_default WHERE message LIKE ? AND operation = ? AND property_type = ?");
        $stmt->bind_param("sss", $message, $operation, $property_type);
        if($stmt->execute()){
            $stmt->bind_result($message_default_id, $message, $operation, $property_type, $response_1, $response_2, $response_type_id);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $stmt->fetch();

                if($response_type_id == 2){
                    $response = array();
                    $data1 = array();
                    $data1["response_1"] = $response_1;
                    $data1["response_2"] = $response_2;
                    $data1["response_type_id"] = $response_type_id;

                    $stmt2 = $this->conn->prepare("SELECT DISTINCT operation FROM message_default WHERE operation != '' ORDER BY operation");
                    if($stmt2->execute()){
                        $stmt2->bind_result($operation);
                        $stmt2->store_result();
                        if($stmt2->num_rows>0){
                            $data2 = array();
                            while ($stmt2->fetch()) {
                                $tmp2 = array();
                                $tmp2["operation"] = $operation;
                                array_push($data2, $tmp2);
                            }

                            $_meta = array();
                            $_meta["status"]="success";
                            $_meta["code"]="200";
                            $response["_meta"] = $_meta;
                            $response["type"] = "operation";
                            $response["operation"] = $data2;
                            $response["message"] = $data1;
                            $stmt->close();
                            $error = false;
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


                } else if($response_type_id == 3){
                    $response = array();
                    $data1 = array();
                    $data1["response_1"] = $response_1;
                    $data1["response_2"] = $response_2;
                    $data1["response_type_id"] = $response_type_id;

                    $stmt2 = $this->conn->prepare("SELECT DISTINCT property_type FROM message_default WHERE property_type != '' ORDER BY property_type");
                    if($stmt2->execute()){
                        $stmt2->bind_result($property_type);
                        $stmt2->store_result();
                        if($stmt2->num_rows>0){
                            $data2 = array();
                            while ($stmt2->fetch()) {
                                $tmp2 = array();
                                $tmp2["property_type"] = $property_type;
                                array_push($data2, $tmp2);
                            }

                            $_meta = array();
                            $_meta["status"]="success";
                            $_meta["code"]="200";
                            $response["_meta"] = $_meta;
                            $response["type"] = "property_type";
                            $response["property_type"] = $data2;
                            $response["message"] = $data1;
                            $stmt->close();
                            $error = false;
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
                } else if($response_type_id == 4){
                    $response = array();
                    $data1 = array();
                    $data1["response_1"] = $response_1;
                    $data1["response_2"] = $response_2;
                    $data1["response_type_id"] = $response_type_id;

                    $stmt2 = $this->conn->prepare("SELECT property_id, image, title, price, money_type, url, operation, property_type FROM property WHERE operation = ? AND property_type = ?");
                    $stmt2->bind_param("ss", $operation, $property_type);
                    if($stmt2->execute()){
                        $stmt2->bind_result($property_id, $image, $title, $price, $money_type, $url, $operation, $property_type);
                        $stmt2->store_result();
                        if($stmt2->num_rows>0){
                            $data2 = array();
                            while ($stmt2->fetch()) {
                                $tmp2 = array();
                                $tmp2["property_id"] = $property_id;
                                $tmp2["image"] = $image;
                                $tmp2["title"] = $title;
                                $tmp2["price"] = $price;
                                $tmp2["money_type"] = $money_type;
                                $tmp2["url"] = $url;
                                $tmp2["operationType"] = $operation;
                                $tmp2["propertyType"] = $property_type;
                                array_push($data2, $tmp2);
                            }

                            $_meta = array();
                            $_meta["status"]="success";
                            $_meta["code"]="200";
                            $response["_meta"] = $_meta;
                            $response["type"] = "property";
                            $response["property"] = $data2;
                            $response["message"] = $data1;
                            $stmt->close();
                            $error = false;
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
                }
                
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

        echoResponse($error, $response);
    }

    


}

?>