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
    public function postMessage($message, $id, $operation_id, $property_id){
        $response = array();
        $stmt = $this->conn->prepare("SELECT message_default_id, message, id, response_1, response_2, response_type_id FROM message_default WHERE message LIKE ? AND id = ?");
        $stmt->bind_param("ss", $message, $id);
        if($stmt->execute()){
            $stmt->bind_result($message_default_id, $message, $id, $response_1, $response_2, $response_type_id);
            $stmt->store_result();
            if($stmt->num_rows>0){
                $stmt->fetch();

                if($response_type_id == 2){
                    $response = array();
                    $data1 = array();
                    $data1["response_1"] = $response_1;
                    $data1["response_2"] = $response_2;
                    $data1["response_type_id"] = $response_type_id;

                    $stmt2 = $this->conn->prepare("SELECT operation_type_id, operation_id, operation_description FROM operation_type");
                    if($stmt2->execute()){
                        $stmt2->bind_result($operation_type_id, $operation_id, $operation_description);
                        $stmt2->store_result();
                        if($stmt2->num_rows>0){
                            $data2 = array();
                            while ($stmt2->fetch()) {
                                $tmp2 = array();
                                $tmp2["operation_type_id"] = $operation_type_id;
                                $tmp2["operation_id"] = $operation_id;
                                $tmp2["operation_description"] = $operation_description;
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


                } else if($response_type_id == 3){
                    $response = array();
                    $data1 = array();
                    $data1["response_1"] = $response_1;
                    $data1["response_2"] = $response_2;
                    $data1["response_type_id"] = $response_type_id;

                    $stmt2 = $this->conn->prepare("SELECT property_type_id, property_id, property_description FROM property_type");
                    if($stmt2->execute()){
                        $stmt2->bind_result($operation_type_id, $operation_id, $operation_description);
                        $stmt2->store_result();
                        if($stmt2->num_rows>0){
                            $data2 = array();
                            while ($stmt2->fetch()) {
                                $tmp2 = array();
                                $tmp2["property_type_id"] = $operation_type_id;
                                $tmp2["property_id"] = $operation_id;
                                $tmp2["property_description"] = $operation_description;
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
                } else if($response_type_id == 4){
                    $response = array();
                    $data1 = array();
                    $data1["response_1"] = $response_1;
                    $data1["response_2"] = $response_2;
                    $data1["response_type_id"] = $response_type_id;

                    $stmt2 = $this->conn->prepare("SELECT property_id, image, title, price, money_type, url, operation_type_id, property_type_id FROM property WHERE operation_type_id = ? AND property_type_id = ?");
                    $stmt2->bind_param("ss", $operation_id, $property_id);
                    if($stmt2->execute()){
                        $stmt2->bind_result($property_id, $image, $title, $price, $money_type, $url, $operation_type_id, $property_type_id);
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
                                $tmp2["operation_type_id"] = $operation_type_id;
                                $tmp2["property_type_id"] = $property_type_id;
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

        return $response;
    }

    // Synchronize
    public function getSynchronize() {

        $response = array();
        $my_response = array();
        $operation_type = array();
        $property_type = array();
        $stmt = $this->conn->prepare("SELECT operation_type_id, operation_id, operation_description FROM operation_type");

        if($stmt->execute()){
            $stmt->bind_result($operation_type_id, $operation_id, $operation_description);
            $stmt->store_result();
            if($stmt->num_rows>0){
                while ($stmt->fetch()) {
                    $tmp = array();
                    $tmp["operation_type_id"] = $operation_type_id;
                    $tmp["operation_id"] = $operation_id;
                    $tmp["operation_description"] = $operation_description;
                    array_push($operation_type, $tmp);
                    $my_response["operation_type"] = $operation_type;
                }
                $stmt->close();
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


        $stmt2 = $this->conn->prepare("SELECT property_type_id, property_id, property_description FROM property_type");
        if($stmt2->execute()){
            $stmt2->bind_result($property_type_id, $property_id, $property_description);
            $stmt2->store_result();
            if($stmt2->num_rows>0){
                while ($stmt2->fetch()) {
                    $tmp = array();
                    $tmp["property_type_id"] = $property_type_id;
                    $tmp["property_id"] = $property_id;
                    $tmp["property_description"] = $property_description;
                    array_push($property_type, $tmp);
                    $my_response["property_type"] = $property_type;
                }
                $stmt2->close();
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

        $response["data"] = $my_response;


        return $response;
    }

}

?>