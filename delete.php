<?php
header('Access-Control-Allow-origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include "db.php";
// print_r ($data);

if($data->id){
    $query = "DELETE FROM products WHERE id=$data->id";
    
        $run = mysqli_query($con, $query);
    
        if($run){
            echo json_encode(['status'=>'success','Message'=>'Product Deleted']);
        }else{
            echo json_encode(['status'=>'failed','Message'=>'Product not Deleted']);
        }
    
}else{
    echo json_encode(['status'=>'failed','Message'=>'Product ID is not given']);
}


?>