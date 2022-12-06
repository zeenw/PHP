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
            $product -> product_id = trim($_POST["product_id"]);
            $product -> product_name = trim($_POST["product_name"]);
            $product -> cid = trim($_POST["cid_num"]);
            $product -> description = trim($_POST["description"]);
            $product -> price = trim($_POST["price"]);
            $path = Config::PATH . "/static/product/images/";
            if(isset($_FILES["product_pic"]["name"])){
                $product -> pic_name = $_FILES["product_pic"]["name"];
                $upload = new Upload($path, $_FILES["product_pic"]);
                $rs = $upload->uploadImg();
                if($rs == 1){
                    echo json_encode($productService->updateProduct($product));
                }
            }else{
                $product -> pic_name ="sample.jpg";
                echo json_encode($productService->updateProduct($product));
            }
            
            
            header("Location:../../static/manage_product/updateproduct.html?".$rs);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }else{
        echo "not submit POST.";
    }

?>

