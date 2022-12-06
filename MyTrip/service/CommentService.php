<?php
    require_once "../../repository/CommentRepository.php";
    require_once '../../model/Comment.php';
    require_once "../../config/OutputApi.php";

    class CommentService {
        private $commentRepository;

        public function __construct() {
            $this->commentRepository = new CommentRepository;
        }
        

        public function getCommentByPId($pid){
            try {
                return $this->commentRepository->getCommentByPId($pid);
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function addComment($comment){
            $output = new OutputApi();
            try {
                $output->obj = $this->commentRepository->addComment($comment);
                $output->flag = 1;
                
            } catch (Exception $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }





    }
?>