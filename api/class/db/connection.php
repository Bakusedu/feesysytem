<?php
 class Database {
   // database parameters
   private $host = "localhost";
   private $db_name = "fees";
   private $username = "root";
   private $password = "";
   public $conn;

   // get database connection
   public function getConnection(){
     $this->conn = null;

     try {
       $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name",$this->username,$this->password);
       $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }catch(PDOException $exception){
       echo "Connection error: ".$exception->getMessage();
     }
     return $this->conn;
   }
 }



 ?>
