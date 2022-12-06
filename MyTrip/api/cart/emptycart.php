<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/CartService.php";
    $cartService = new CartService();

    if(isset($_GET['uid'])){
        try{
            $cartService->emptyCart($_GET['uid']);
            header("Location: ../../static/user/userprofile.html");
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong. uid=".$_GET['uid'];
    }
?>

