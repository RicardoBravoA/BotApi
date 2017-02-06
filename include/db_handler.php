<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/db_connect.php';
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    // Message
    public function postMessage($message, $id){

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