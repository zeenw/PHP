<?php
    require_once '../../config/Database.php';
    require_once '../../model/User.php';
    
    class UserRepository {
        private $conn;
        
        public function __construct() {
            $db = new Database;
            $this->conn = $db->conn;
        }

        public function delUserByEmail($uemail)
        {
            try{
                $sql = "delete from user where uemail = ?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('s', $uemail);
                $stmt->execute();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if($stmt->affected_rows == 0){
                throw new EmailNotFoundException("Email not found. Email is " . $uemail);
            }else{
                $user = new User();
                $user -> uemail = $uemail;
                return $user;
            }

        }

        public function getUserByEmail($uemail)
        {
            try{
                $user = new User();
                $sql = "select user_id, pword, uemail, member_type, fname, lname, phone from user where uemail = ?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('s', $uemail);

                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_array(MYSQLI_NUM);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if($row){
                $user->user_id = $row[0];
                $user->pword = $row[1];
                $user->uemail = $row[2];
                $user->member_type = $row[3];
                $user->fname = $row[4];
                $user->lname = $row[5];
                $user->phone = $row[6];
                return $user;
            }else{
                throw new EmailNotFoundException("Email not found. Email is " . $uemail);
            }
                    
        }

        public function getUsers()
        {
            try{
                $list = array();
                $sql = "select user_id, member_type, uemail, phone, fname, lname, expire_date from user";
                $stmt = $this->conn->prepare($sql);
    
                if($stmt->execute()){
                    $stmt->bind_result($user_id, $member_type, $uemail, $phone, $fname, $lname, $expire_date);
    
                    while ($stmt->fetch()) {
                        $user = new User();
                        $user->user_id = $user_id;
                        $user->member_type = $member_type;
                        $user->uemail = $uemail;
                        $user->phone = $phone;
                        $user->fname = $fname;
                        $user->lname = $lname;
                        $user->expire_date = $expire_date;
                        array_push($list, $user);
                    }
                }
                return $list;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }
        
        public function addUser($user)
        {
            $sql = "insert into user (member_type, pword, phone, uemail) values(?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            // Bind data i=integer d=double s=string b=a blob and will be sent in packets
            $stmt->bind_Param('isss', $user->member_type, $user->pword, $user->phone, $user->uemail);

            if($stmt->execute()) {
                return $user;
            }else{
                throw new EmailExistException("Email already exists. Email = " . $user->uemail);
            }

        }

        public function updateUser($user)
        {
            $sql = "update user set fname=?, lname=?, phone=? where user_id=?";
            $stmt = $this->conn->prepare($sql);
            // Bind data i=integer d=double s=string b=a blob and will be sent in packets
            $stmt->bind_Param('sssi', $user->fname, $user->lname, $user->phone, $user->user_id);
            if($stmt->execute()) {
                return $user;
            }else{

                throw new Exception("Failed to update user. email = " . $user->uemail);
            }

        }



    }

?>