<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/CommentService.php";
    require_once "../../repository/CommentRepository.php";

    $commentService = new CommentService();

    $data = json_decode(file_get_contents('php://input'));

    try{
        echo json_encode($commentService->addComment($data));

    }catch(Exception $e){
        echo $e->getMessage();
    }


    // if(isset($_POST["comment"])){
    //     try{
    //         $comment = $_POST["comment"];
    //         $commentRepository = new CommentRepository();
    //         //echo json_encode($commentService->addComment($_POST["comment"]));
    //         echo json_encode($commentRepository->addComment($comment));
    //     }catch(Exception $e){
    //         echo $e->getMessage();
    //     }
    // }else{
    //     echo "Params or REQUEST_METHOD is wrong.";
    // }


?>

