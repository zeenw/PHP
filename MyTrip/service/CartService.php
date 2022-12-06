<?php
    require_once "../../repository/CartRepository.php";
    require_once "../../config/OutputApi.php";

    class CartService {
        private $cartRepository;

        public function __construct() {
            $this->cartRepository = new CartRepository;
        }
    
        

        public function deleteCartById($id){
            $output = new OutputApi();
            try {
                $output->obj = $this->cartRepository->deleteCartById($id);
                $output->flag = 1;
                
            } catch (EmailNotFoundException $e) {
                $output->message = $e->getMessage();
                $output->flag = 0;
            }
            return $output;
        }

        public function emptyCart($id){
            try {
                return ($this->cartRepository->emptyCart($id));
                
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function addCart($cart){
            $output = new OutputApi();
            try {
                $output->obj = $this->cartRepository->addCart($cart);
                $output->flag = 1;
                
            } catch (Exception $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }

        public function updateCart($cart){
            $output = new OutputApi();
            try {
                $output->obj = $this->cartRepository->updateCart($cart);
                $output->flag = 1;
                
            } catch (Exception $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }


        public function updateQuantity($cart_id, $quantity){
            $output = new OutputApi();
            try {
                if($this->cartRepository->updateQuantity($cart_id, $quantity)){
                    $output->flag = 1;
                }else{
                    $output->flag = 0;
                }
                
            } catch (Exception $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }







    }
?>