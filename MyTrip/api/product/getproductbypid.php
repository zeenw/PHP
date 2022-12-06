<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/ProductService.php";
    $productService = new ProductService();

    // Api: get Product By Cid 
    if(isset($_GET["pid"])){
        try{
            echo json_encode($productService->getProductByPid($_GET["pid"]));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }


?>

