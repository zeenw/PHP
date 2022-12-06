<?php
    require_once "../../repository/UserRepository.php";
    require_once '../../model/User.php';
    require_once '../../exception/EmailNotFoundException.php';
    require_once '../../exception/EmailExistException.php';
    require_once "../../config/OutputApi.php";

    class UserService {
        private $userRepository;

        public function __construct() {
            $this->userRepository = new UserRepository;
        }
        
        public function getUserByEmail($uemail){
            $output = new OutputApi();
            try {
                $output->obj = $this->userRepository->getUserByEmail($uemail);
                $output->flag = 1;
            } catch (EmailNotFoundException $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }

        public function getUsers(){
            try {
                return $this->userRepository->getUsers();
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }

        public function addUser($user){
            $output = new OutputApi();
            $output = $this->getUserByEmail($user->uemail);
            try {
                if(($output->flag) == 0){
                    $output->flag = 1;
                    $output->obj = $this->userRepository->addUser($user);
                }else{
                    $output->flag = 0;
                    $output->obj = $user;
                    $output->message = "Email already exists. Email = " . $user->uemail;
                }
                
            } catch (EmailExistException $e) {
                $output->flag = 0;
                $output->message = $e->getMessage();
            }
            return $output;
        }

        public function login($login){
            try{
                $output = new OutputApi();
                $user = new User();
                $user = $this->userRepository->getUserByEmail($login->uemail);
                if($user->pword == md5($login->pword)){
                    $_SESSION['username'] = $login->uemail;
                    $output->flag = $user->member_type;
                    $output->obj = $user;
                }else{
                    $output->message = "Check your password.";
                    $output->flag = 0;
                    $output->obj = $login;
                }

            }catch(EmailNotFoundException $e){
                $output->message = $e->getMessage();
                $output->flag = 0;
                $output->obj = $login;
            }

            return $output;
        }

        public function updateUser($user){
            $output = new OutputApi();
            $output = $this->userRepository->updateUser($user);
            //$output = $this->getUserByEmail($user->uemail);
            // try {
            //     if(($output->flag) == 0){
            //         $output->obj = $user;
            //     }else{
            //         $output->flag = 1;
            //         $output->obj = $this->userRepository->updateUser($user);
            //     }

            // } catch (Exception $e) {
            //     $output->flag = 0;
            //     $output->obj = $user;
            //     $output->message = $e->getMessage();
            // }
            return $output;
        }

    
        public function delUserByEmail($uemail){
            $output = new OutputApi();
            try {
                $output->obj = $this->userRepository->delUserByEmail($uemail);
                $output->flag = 1;
                
            } catch (EmailNotFoundException $e) {
                $output->message = $e->getMessage();
                $output->flag = 0;
            }
            return $output;
        }






    }
?>