<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/UserService.php";
    $userService =  new UserService();

    // Api: get all users
    try{
        echo json_encode($userService->getUsers());
    } catch (Exception $e) {
        echo $e->getMessage();
    }


?>

