<?php
 class Student {
   private $conn;
   private $table_name = "students";
   private $eligible = 1;

   // table columns
   public $id;
   public $firstname;
   public $lastname;
   public $gender;
   public $regnum;
   public $email;
   public $department;
   public $password;
   public $status;
   public $payment_type;
   public $amount;

   // class constructor connects with database
   public function __construct($db){
     $this->conn = $db;
   }

   // student methhods

   public function register(){

     // query to create students record in database
     try{
         $query = "INSERT INTO $this->table_name(firstname,lastname,gender,regnum,email,department,password) VALUES(?,?,?,?,?,?,?)";

         // prepare query
         $stmt = $this->conn->prepare($query);
         // bind values
         $stmt->bindParam(1,$this->firstname);
         $stmt->bindParam(2,$this->lastname);
         $stmt->bindParam(3,$this->gender);
         $stmt->bindParam(4,$this->regnum);
         $stmt->bindParam(5,$this->email);
         $stmt->bindParam(6,$this->department);
         $stmt->bindParam(7,$this->password);

         $stmt->execute();
       }
       catch(PDOException $e) {
         // error
         echo $e->getMessage();
       }
     }

  public function login(){
    try{
      $query = "SELECT id,status FROM $this->table_name WHERE email = :email AND password = :password";

      // prepare query
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute(array("email" => $this->email, "password" => $this->password));

      $user = $stmt->fetch();

      return $user ? $user : false;
    }
    catch(PDOException $e) {
      // error
      echo $e->getMessage();
    }
  }

  public function priviledge(){
    if($this->eligible === intval($this->status)){
      return true;
    }
    return false;
  }

  public function update(){
    try{
      $query = "UPDATE $this->table_name SET firstname = ?, lastname = ?, email = ? WHERE id = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1,$this->firstname);
      $stmt->bindParam(2,$this->lastname);
      $stmt->bindParam(3,$this->email);
      $stmt->bindParam(4,$this->id);

      $result = $stmt->execute();
      return $result ? true : false;
    }
    catch(PDOException $e) {
      // error
      echo $e->getMessage();
    }
  }

  public function logout(){
    session_unset();
    session_destroy();
  }

  public function profile(){
    try {
      $query = "SELECT * from $this->table_name WHERE id = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1,$this->id);
      $result = $stmt->execute();
      $result = $stmt->fetch();
      return $result ? $result : false;
    }
    catch(PDOException $e) {
      // error
      echo $e->getMessage();
    }
  }

  public function pay(){
    try{
      $query = "UPDATE $this->table_name SET status = ?, payment_type = ?, amount = ? WHERE id = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1,$this->status);
      $stmt->bindParam(2,$this->payment_type);
      $stmt->bindParam(3,$this->amount);
      $stmt->bindParam(4,$this->id);

      $result = $stmt->execute();
      return $result ? true : false;
    }
    catch(PDOException $e) {
      // error
      echo $e->getMessage();
    }
  }
}
 ?>
