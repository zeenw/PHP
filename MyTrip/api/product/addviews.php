<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/ProductService.php";
    $productService = new ProductService();

    if(isset($_GET["pid"])){
        try{
            $productService->addViews($_GET["pid"]);
            
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }


?>

