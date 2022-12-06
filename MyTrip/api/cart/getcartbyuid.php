<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/ProductService.php";
    $productService = new ProductService();

    // Api: get Product By Cid 
    if(isset($_GET["uid"])){
        try{
            echo json_encode($productService->getCartByUid($_GET["uid"]));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }


?>

