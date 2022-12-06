<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/ProductService.php";
    $productService = new ProductService();

    // Api: get all products
    try{
        echo json_encode($productService->getProducts());
    } catch (Exception $e) {
        echo $e->getMessage();
    }


?>

