<?php
    require_once '../../config/Database.php';
    require_once '../../model/Product.php';
    
    class ProductRepository {
        private $conn;
        
        public function __construct() {
            $db = new Database;
            $this->conn = $db->conn;
        }

        public function delProductById($id)
        {
            try{
                $sql = "delete from product where product_id = ?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('s', $id);
                $stmt->execute();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if($stmt->affected_rows == 0){
                throw new ProductNotFoundException("Product ID not found. Id is " . $id);
            }else{
                $product = new Product();
                $product -> product_id = $id;
                return $product;
            }

        }

        public function getProductByCid($cid)
        {
            try{
                $list = array();
                $sql = "select product_id, product_name, cid, description, views, price, pic_name  from product inner join category where cid = cate_id and cid = ?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('i', $cid);
                if($stmt->execute()){
                    $stmt->bind_result($pid, $pname, $cid, $desc, $views, $price, $pic);
    
                    while ($stmt->fetch()) {
                        $product = new Product();
                        $product->product_id = $pid;
                        $product->product_name = $pname;
                        $product->cid = $cid;
                        $product->description = $desc;
                        $product->views = $views;
                        $product->price = $price;
                        $product->pic_name = $pic;
                        array_push($list, $product);
                    }
                }
                return $list;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }
        
        public function getCartByUid($uid)
        {
            try{
                $list = array();
                $sql = "select product_id, product_name, cid, description, views, price, pic_name, quantity, cart_id, order_date from product inner join cart where product_id = pid and flag = 0 and uid = ?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('i', $uid);
                if($stmt->execute()){
                    $stmt->bind_result($pid, $pname, $cid, $desc, $views, $price, $pic, $quantity, $cart_id, $order_date);
    
                    while ($stmt->fetch()) {
                        $product = new Product();
                        $product->product_id = $pid;
                        $product->product_name = $pname;
                        $product->cid = $cid;
                        $product->description = $desc;
                        $product->views = $views;
                        $product->price = $price;
                        $product->pic_name = $pic;
                        $product->quantity = $quantity;
                        $product->cart_id = $cart_id;
                        $product->order_date = $order_date;
                        array_push($list, $product);
                    }
                }
                return $list;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

        public function getProductByUid($uid)
        {
            try{
                $list = array();
                $sql = "select product_id, product_name, cid, description, views, price, pic_name, quantity, cart_id from product inner join cart where product_id = pid and flag = 1 and uid = ?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('i', $uid);
                if($stmt->execute()){
                    $stmt->bind_result($pid, $pname, $cid, $desc, $views, $price, $pic, $quantity, $cart_id);
    
                    while ($stmt->fetch()) {
                        $product = new Product();
                        $product->product_id = $pid;
                        $product->product_name = $pname;
                        $product->cid = $cid;
                        $product->description = $desc;
                        $product->views = $views;
                        $product->price = $price;
                        $product->pic_name = $pic;
                        $product->quantity = $quantity;
                        $product->cart_id = $cart_id;
                        array_push($list, $product);
                    }
                }
                return $list;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

        public function getProductByPid($pid)
        {
            try{
                $sql = "select product_id, product_name, cid, description, views, price, pic_name from product where product_id = ?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('i', $pid);
                if($stmt->execute()){
                    $stmt->bind_result($pid, $pname, $cid, $desc, $views, $price, $pic);
    
                    if ($stmt->fetch()) {
                        $product = new Product();
                        $product->product_id = $pid;
                        $product->product_name = $pname;
                        $product->cid = $cid;
                        $product->description = $desc;
                        $product->views = $views;
                        $product->price = $price;
                        $product->pic_name = $pic;
                    }
                }
                return $product;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

        public function getProducts()
        {
            try{
                $list = array();
                $sql = "select * from product";
                $stmt = $this->conn->prepare($sql);
    
                if($stmt->execute()){
                    $stmt->bind_result($pid, $pname, $cid, $desc, $views, $price, $pic);
    
                    while ($stmt->fetch()) {
                        $product = new Product();
                        $product->product_id = $pid;
                        $product->product_name = $pname;
                        $product->cid = $cid;
                        $product->description = $desc;
                        $product->views = $views;
                        $product->price = $price;
                        $product->pic_name = $pic;

                        array_push($list, $product);
                    }
                }
                return $list;
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }
        
        public function createProduct($product)
        {
            try{
                $sql = "insert into product (product_name, cid, description, price, pic_name, views) values(?, ?, ?, ?, ?, 1)";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('sisss', $product->product_name, $product->cid, $product->description, $product->price, $product->pic_name);

                if($stmt->execute()) {
                    return $product;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

        public function updateProduct($product)
        {
            try{
                $sql = "update product set product_name=?, cid=?, description=?, price=?, pic_name=? where product_id=?";

                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('sisssi', $product->product_name, $product->cid, $product->description, $product->price, $product->pic_name, $product->product_id);


                if($stmt->execute()) {
                    return $product;
                }
            } catch (Exception $e) {
                echo $product;
                echo $e->getMessage();
            }

        }
        

        public function addViews($pid)
        {
            $sql = "update product set views=views+1 where product_id = ?";
            $stmt = $this->conn->prepare($sql);
            // Bind data i=integer d=double s=string b=a blob and will be sent in packets
            $stmt->bind_Param('i', $pid);
            if($stmt->execute()) {
                return true;
            }else{
                throw new Exception("Function addViews() is wrong.");
            }

        }


    }

?>