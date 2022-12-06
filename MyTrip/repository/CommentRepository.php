<?php
    require_once '../../config/Database.php';
    require_once '../../model/Comment.php';
    
    class CommentRepository {
        private $conn;
        
        public function __construct() {
            $db = new Database;
            $this->conn = $db->conn;
        }

        public function getCommentByPId($pid)
        {
            try{
                $list = array();
                $sql = "select * from comment where pid = ? order by comment_id desc";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('i', $pid);

                if($stmt->execute()){
                    $stmt->bind_result($comment_id, $uid, $pid, $score, $comment);
    
                    while ($stmt->fetch()) {
                        $Comment = new Comment();
                        $Comment->comment_id = $comment_id;
                        $Comment->uid = $uid;
                        $Comment->pid = $pid;
                        $Comment->score = $score;
                        $Comment->comment = $comment;
                        array_push($list, $Comment);
                    }
                }
                return $list;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }
        
        public function addComment($comment)
        {
            try{
                $sql = "insert into comment (uid, pid, score, comment) values(?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('iiis', $comment->uid, $comment->pid, $comment->score, $comment->comment);

                if($stmt->execute()) {
                    return $comment;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }



    }

?>