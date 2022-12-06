<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once "../../service/ProductService.php";
    require_once "../../model/Product.php";
    require_once "../../utility/Upload.php";
    require_once '../../config/Config.php';
    $productService = new ProductService();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try{
            $product = new Product();
            $product -> product_name = trim($_POST["product_name"]);
            $product -> cid = trim($_POST["cid_num"]);
            $product -> description = trim($_POST["description"]);
            $product -> price = trim($_POST["price"]);
            $path = Config::PATH . "/static/product/images/";
            $product -> pic_name = $_FILES["product_pic"]["name"];
            $upload = new Upload($path, $_FILES["product_pic"]);

 
            $rs = $upload->uploadImg();

            if($rs == 1){
                echo json_encode($productService->addProduct($product));
            }

            header("Location:../../static/manage_product/createproduct.html?".$rs);


        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "not submit POST.";
    }

?>

