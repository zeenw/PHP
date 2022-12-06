<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/CategoryService.php";
    $categoryService = new CategoryService();

    try{
        echo json_encode($categoryService->getCategories());
    } catch (Exception $e) {
        echo $e->getMessage();
    }


?>

