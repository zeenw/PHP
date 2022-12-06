<?php
    require_once '../../config/Database.php';
    require_once '../../model/Category.php';
    
    class CategoryRepository {
        private $conn;
        
        public function __construct() {
            $db = new Database;
            $this->conn = $db->conn;
        }


        public function getCategories()
        {
            try{
                $list = array();
                $sql = "select cate_id, category, flag from category where flag = 1 order by category";
                $stmt = $this->conn->prepare($sql);
    
                if($stmt->execute()){
                    $stmt->bind_result($cate_id, $cate_name, $flag);
    
                    while ($stmt->fetch()) {
                        $category = new Category();
                        $category->cate_id = $cate_id;
                        $category->category = $cate_name;
                        $category->flag = $flag;
                        array_push($list, $category);
                    }
                }
                return $list;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

        public function getAllCategories()
        {
            try{
                $list = array();
                $sql = "select cate_id, category, flag from category order by flag desc";
                $stmt = $this->conn->prepare($sql);
    
                if($stmt->execute()){
                    $stmt->bind_result($cate_id, $cate_name, $flag);
    
                    while ($stmt->fetch()) {
                        $category = new Category();
                        $category->cate_id = $cate_id;
                        $category->category = $cate_name;
                        $category->flag = $flag;
                        array_push($list, $category);
                    }
                }
                return $list;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }
        
        public function addCategory($cateObj)
        {
            try{
                $sql = "insert into category (category, flag) values(?, ?)";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('si', $cateObj->category, $cateObj->flag);

                if($stmt->execute()) {
                    return $cateObj;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function updateCategory($category)
        {
            try{
                $sql = "update category set category=?, flag=? where cate_id=?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('sii', $category->category, $category->flag, $category->cate_id);
                if($stmt->execute()) {
                    return $category;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }



    }

?>