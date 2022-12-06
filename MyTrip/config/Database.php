<?php  
class Database {
    private $host = 'localhost:3306';  
    private $user = 'root';  
    private $pass = 'root2022'; 
    private $dbname = 'project_php';
    public $conn;

    public function __construct() {

        $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);

        if ($conn){
            $this->conn = $conn;
        }else{
            echo "database error";
            die("Connection failed: " . mysqli_connect_error());
        }
         
    }

}
?> 