<?php
// require init.php
// require headers
require("../header_files_post.php");
require("../class/autoload/init.php");

 // get Posted data
 $data = json_decode(file_get_contents('php://input'));

 // perform neccessary form validations

 if(!empty($data->firstname)
  && !empty($data->lastname)
  && !empty($data->gender)
  && !empty($data->regnum)
  && !empty($data->email)
  && !empty($data->password)
){
  $firstname = strip_tags(trim(htmlspecialchars($data->firstname)));
  $lastname = strip_tags(trim(htmlspecialchars($data->lastname)));
  $regnum = strip_tags(trim(htmlspecialchars($data->regnum)));
  $email = strip_tags(trim(htmlspecialchars($data->email)));
  $password = strip_tags(trim(htmlspecialchars($data->password)));
  $gender = $data->gender;
  $department = $data->department;
  if(strlen($firstname) < 3){
    $error[] = "First name too short";
  }
  if(strlen($lastname) < 3){
    $error[] = "Last name too short";
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $error[] = "Email is invalid";
  }
  if(strlen($regnum) < 10){
    $error[] = "Reg number not valid";
  }
  if(strlen($password) < 6){
    $error[] = "Password too short";
  }
  if(!empty($error)){
    // set response code(503);
    http_response_code(503);
    echo json_encode(array("message" => $error));
  }else{
    // initialize class variables
    $student->firstname = $firstname;
    $student->lastname = $lastname;
    $student->gender = $gender;
    $student->regnum = $regnum;
    $student->email = $email;
    $student->department = $department;
    $student->password = md5($password);

    if($student->register()){
      // set response_code - 201 created
      http_response_code(201);
      echo json_encode(array("data" => true));
    }
  }
}



 ?>
