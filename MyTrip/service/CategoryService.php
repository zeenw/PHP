<?php
    require_once "../../repository/CategoryRepository.php";
    require_once '../../model/Category.php';
    require_once "../../config/OutputApi.php";

    class CategoryService {
        private $categoryRepository;

        public function __construct() {
            $this->categoryRepository = new CategoryRepository;
        }
        
        public function getCategories(){
            try {
                return $this->categoryRepository->getCategories();
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function getAllCategories(){
            try {
                return $this->categoryRepository->getAllCategories();
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function addCategory($category){
            $output = new OutputApi();
            try {
                $output->obj = $this->categoryRepository->addCategory($category);
                $output->flag = 1;
                
            } catch (Exception $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }

        public function updateCategory($category){
            $output = new OutputApi();
            try {
                $output->obj = $this->categoryRepository->updateCategory($category);
                $output->flag = 1;
                
            } catch (Exception $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }






    }
?>