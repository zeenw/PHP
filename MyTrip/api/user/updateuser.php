<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/UserService.php";
    require_once "../../model/User.php";
    $userService =  new UserService();

    // Api: update user
    if($_SERVER['REQUEST_METHOD']="POST"){

        $user = new User();
        $user->user_id = $_POST["user_id"];
        $user->fname = $_POST["fname"];
        $user->lname = $_POST["lname"];
        $user->phone = $_POST["phone"];
        $user->uemail = $_POST["uemail"];

        try{
            //$user = json_decode($_POST['user'], false);
            echo json_encode($userService->updateUser($user));
            header("location:../../static/user/userprofile.html");
        }catch(Exception $e){
            echo $e->getMessage();
        }

    }else{
        echo "Params or REQUEST_METHOD is wrong." . $_SERVER["REQUEST_METHOD"] . $_POST['user'];
    }
?>

