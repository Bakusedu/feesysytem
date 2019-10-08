<?php
class Admin {
  private $conn;
  private $table_name = "admin";
  private $stud_table = "students";

  // table columns
  public $id;
  public $name;
  public $gender;
  public $priviledge;
  public $email;
  public $password;

  // class constructor connects with database
  public function __construct($db){
    $this->conn = $db;
  }

  public static function priviledge($priviledge){
    if($priviledge !== 0){
      return false;
    }
  }
  public function register(){

    // query to create students record in database
    try{
        $query = "INSERT INTO $this->table_name(name,password,gender,email) VALUES(?,?,?,?)";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindParam(1,$this->name);
        $stmt->bindParam(2,$this->password);
        $stmt->bindParam(3,$this->gender);
        $stmt->bindParam(4,$this->email);

        $stmt->execute();
      }
      catch(PDOException $e) {
        // error
        echo $e->getMessage();
      }
    }

    public function stud_delete(){
      try {

      $query = "DELETE FROM $this->stud_table WHERE id = ?";

      // prepare query
      $stmt =  $this->conn->prepare($query);

      $stmt->bindParam(1,$this->id);

      $stmt->execute();
    }
    catch(PDOException $e) {
      // error
      echo $e->getMessage();
    }
  }

    public function login(){
      try{
        $query = "SELECT id,priviledge FROM $this->table_name WHERE email = :email AND password = :password";

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

    public function update(){
      try{
        $query = "UPDATE $this->table_name SET name = ? ,email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->name);
        $stmt->bindParam(2,$this->email);
        $stmt->bindParam(3,$this->id);

        $result = $stmt->execute();
        return $result ? true : false;
      }
      catch(PDOException $e) {
        // error
        echo $e->getMessage();
      }
    }

    public function students(){
      try {
        $query = "SELECT * FROM $this->stud_table";
        $stmt = $this->conn->prepare($query);

        $result = $stmt->execute();

        $result = $stmt->fetch();
        return $result ? $result : false;
      }
      catch(PDOException $e) {
        // error
        echo $e->getMessage();
      }
    }
}


 ?>
