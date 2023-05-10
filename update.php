<?php
header('Access-Control-Allow-origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include "db.php";
// print_r ($data);

if($data->id){
    $querysec = "SELECT * FROM products WHERE id=".$data->id;
    $runsec = mysqli_query($con, $querysec);
    $product = mysqli_fetch_assoc($runsec);

    $product_name = $product['product_name'];
    $product_price = $product['product_price'];
    $stock = $product['stock'];
    $discount = $product['discount'];
    if($data->discount!=''){
        $discount = $data->discount;
    }
    if($data->product_name!=''){
        $product_name = $data->product_name;
    }
    if($data->product_price!=''){
        $product_price = $data->product_price;
    }
    if($data->stock!=''){
        $stock = $data->stock;
    }

        $query = "UPDATE `products` SET `product_name`='$product_name',`product_price`='$product_price',`stock`='$stock',`discount`='$discount' WHERE id=$data->id";
        // $query = "UPDATE `products` SET";
        // $query.= "product_name='$product_name',";
        // $query.="product_price`=$product_price,";
        // $query.="stock=$stock,";
        // $query.="discount=$discount WHERE id".$data->id;
    
        $run = mysqli_query($con, $query);
    
        if($run){
            echo json_encode(['status'=>'success','Message'=>'Product Updated']);
        }else{
            echo json_encode(['status'=>'failed','Message'=>'Product not Updated']);
        }
    
}else{
    echo json_encode(['status'=>'failed','Message'=>'Product ID is not given']);
}


?>