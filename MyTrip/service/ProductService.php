<?php
    require_once "../../repository/ProductRepository.php";
    require_once '../../model/Product.php';
    require_once "../../config/OutputApi.php";

    class ProductService {
        private $productRepository;

        public function __construct() {
            $this->productRepository = new ProductRepository;
        }
        
        public function getProducts(){
            try {
                return $this->productRepository->getProducts();
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function getProductByCid($cid){
            try {
                return $this->productRepository->getProductByCid($cid);
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function getProductByPid($pid){
            try {
                $this->productRepository->addViews($pid);
                return $this->productRepository->getProductByPid($pid);
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function getProductByUid($uid){
            try {
                return $this->productRepository->getProductByUid($uid);
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function getCartByUid($uid){
            try {
                return $this->productRepository->getCartByUid($uid);
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function addProduct($product){
            $output = new OutputApi();
            try {
                $output->obj = $this->productRepository->createProduct($product);
                $output->flag = 1;
                
            } catch (Exception $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }


        public function updateProduct($product){
            $output = new OutputApi();
            try {
                $output->obj = $this->productRepository->updateProduct($product);
                $output->flag = 1;
                
            } catch (Exception $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }

        public function addViews($pid){
            try {
                ($this->productRepository->addViews($pid)) ? true : false;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function delProductById($id){
            $output = new OutputApi();
            try {
                $output->obj = $this->productRepository->delProductById($id);
                $output->flag = 1;
                
            } catch (EmailNotFoundException $e) {
                $output->message = $e->getMessage();
                $output->flag = 0;
            }
            return $output;
        }






    }
?>