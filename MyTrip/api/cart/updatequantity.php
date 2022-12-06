<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/CartService.php";
    $cartService = new CartService();

    if(isset($_GET['cart_id'])&&isset($_GET['quantity'])){
        try{
            $cartService->updateQuantity($_GET['cart_id'], $_GET['quantity']);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }
?>

