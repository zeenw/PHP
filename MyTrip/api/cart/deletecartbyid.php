<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/CartService.php";
    $cartService = new CartService();

    if(isset($_GET['cart_id'])){
        try{
            $cartService->deleteCartById($_GET['cart_id']);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }
?>

