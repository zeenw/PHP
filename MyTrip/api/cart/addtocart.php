<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/CartService.php";
    $cartService = new CartService();

    if(isset($_POST['cart'])){
        try{
            $cart = json_decode($_POST['cart'], false);
            echo json_encode($cartService->addCart($cart));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }
?>

