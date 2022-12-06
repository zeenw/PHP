<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/UserService.php";
    $userService =  new UserService();

    // Api: create user
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user'])){
        try{
            $user = json_decode($_POST['user'], false);
            echo json_encode($userService->addUser($user));
        }catch(Exception $e){
            $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }
?>

