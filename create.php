<?php
header('Access-Control-Allow-origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include "db.php";
// print_r ($data);
if($data->discount==''){
    echo json_encode(['status'=>'failed','Message'=>'Discount not Provided']);
}elseif($data->product_name==''){
    echo json_encode(['status'=>'failed','Message'=>'Name field Empty']);
}elseif($data->product_price==''){
    echo json_encode(['status'=>'failed','Message'=>'Price not given']);
}elseif($data->stock==''){
    echo json_encode(['status'=>'failed','Message'=>'Stock Empty']);
}else{
    $query = "INSERT INTO products(product_name, product_price, stock, discount)VALUES('$data->product_name','$data->product_price','$data->stock','$data->discount')";

    $run = mysqli_query($con, $query);

    if($run){
        echo json_encode(['status'=>'success','Message'=>'Product Added']);
    }else{
        echo json_encode(['status'=>'failed','Message'=>'Product not Added']);
    }
}
?>