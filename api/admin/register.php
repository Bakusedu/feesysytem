<?php
// require init.php
// require headers
require("../header_files_post.php");
require("../class/autoload/init.php");

 // get Posted data
 $data = json_decode(file_get_contents('php://input'));

 // perform neccessary form validations

 if(!empty($data->name)
  && !empty($data->gender)
  && !empty($data->email)
  && !empty($data->password)
){
  $name = strip_tags(trim(htmlspecialchars($data->name)));
  $email = strip_tags(trim(htmlspecialchars($data->email)));
  $password = strip_tags(trim(htmlspecialchars($data->password)));
  $gender = $data->gender;
  if(strlen($name) < 8){
    $error[] = "Please enter your full name";
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $error[] = "Email is invalid";
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
    $admin->name = $name;
    $admin->gender = $gender;
    $admin->email = $email;
    $admin->password = md5($password);

    if($admin->register()){
      // set response_code - 201 created
      http_response_code(201);
      $message = "Admin registered successfully";
      echo json_encode(array("data" => $message));
    }
  }
}
