<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/UserService.php";
    $userService =  new UserService();

    // Api: delete user
    if(isset($_GET["email"])){
        try{
            echo json_encode($userService->delUserByEmail($_GET["email"]));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }


?>

