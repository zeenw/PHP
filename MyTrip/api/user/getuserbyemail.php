<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/UserService.php";
    $userService =  new UserService();

    // Api: get user by email
    if(isset($_GET["email"])){
        try{
            echo json_encode($userService->getUserByEmail($_GET["email"]));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong. email";
    }


?>

