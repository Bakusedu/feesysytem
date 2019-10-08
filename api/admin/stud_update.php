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
 && !empty($data->email)
){
  $firstname = strip_tags(trim(htmlspecialchars($data->firstname)));
  $lastname = strip_tags(trim(htmlspecialchars($data->lastname)));
  $email = strip_tags(trim(htmlspecialchars($data->email)));
  if(strlen($firstname) < 3){
    $error[] = "First name too short";
  }
  if(strlen($lastname) < 3){
    $error[] = "Last name too short";
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $error[] = "Email is invalid";
  }
  if(!isset($_SESSION['id'])){
    $error = "User not logged in";
  }

  if(!empty($error)){
    // set response code(503);
    http_response_code(503);
    echo json_encode(array("message" => $error));
  }
  else {

    // initialize class variables
    $student->firstname = $firstname;
    $student->lastname = $lastname;
    $student->email = $email;
    $student->id = $_SESSION['id'];

    if($student->update()){
      // set response code - 200 ok
      http_response_code(200);

      // tell the user
      echo json_encode(array("message" => "Student record updated."));
      }
    }
  }
 ?>
