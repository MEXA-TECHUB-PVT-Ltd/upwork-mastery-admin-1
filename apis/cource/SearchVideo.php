<?php
session_start();
// debuger
ini_set("display_errors",1);
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type:application/json; charst= UTF-8");

// file include
include_once("../../include/db.php");
include_once("../function/Function.php");
$data = new stdClass();
$data->conn=connect();
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (!empty($_GET["search"])) {
    $data->search=$_GET["search"];
    if (!empty($row = searchVideo($data))) {
        http_response_code(200);
        echo json_encode(array(
            'status'=>true,
            'videos'=>$row
        ));
    }else{
        http_response_code(200);
        echo json_encode(array(
            "status"=>false,
            "message"=>"Failed To Get Data"
        ));
     }
     }
}else{
    http_response_code(503);
echo json_encode(array(
    "status"=>false,
    "message"=>"Server Error"
));
}
?>