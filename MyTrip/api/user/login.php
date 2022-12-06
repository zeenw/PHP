<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/UserService.php";
    $userService =  new UserService();

    // Api: create user
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
        try{
            $login = json_decode($_POST['login'], false);
            echo json_encode($userService->login($login));

        }catch(Exception $e){
            $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong. login = " . isset($_POST['login']);
    }
?>