<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/CategoryService.php";
    $categoryService = new CategoryService();

    // Api: create Category
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category'])){
        try{
            $category = json_decode($_POST['category'], false);
            echo json_encode($categoryService->updateCategory($category));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "Params or REQUEST_METHOD is wrong.";
    }
?>

