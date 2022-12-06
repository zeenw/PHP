<?php
    require_once '../../config/Database.php';
    
    class CartRepository {
        private $conn;
        
        public function __construct() {
            $db = new Database;
            $this->conn = $db->conn;
        }
        
        public function deleteCartById($id)
        {
            try{
                $sql = "delete from cart where cart_id = ?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('s', $id);
                $stmt->execute();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

        }

        public function addCart($cart)
        {
            try{
                $sql = "insert into cart (uid, pid, flag, quantity) values(?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('iiii', $cart->uid, $cart->pid, $cart->flag, $cart->quantity);

                if($stmt->execute()) {
                    return $cart;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function updateCart($cart)
        {
            try{
                $sql = "update cart set quantity=?, flag=? where cart_id=?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('iii', $cart->quantity, $cart->flag, $cart->cart_id);
                if($stmt->execute()) {
                    return $cart;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }


        public function updateQuantity($cart_id, $quantity)
        {
            try{
                $sql = "update cart set quantity=? where cart_id=?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('ii', $quantity, $cart_id);
                if($stmt->execute()) {
                    return true;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function emptyCart($uid)
        {
            try{
                $sql = "update cart set flag=0 where uid=?";
                $stmt = $this->conn->prepare($sql);
                // Bind data i=integer d=double s=string b=a blob and will be sent in packets
                $stmt->bind_Param('i', $uid);
                if($stmt->execute()) {
                    return true;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }




    }

?>