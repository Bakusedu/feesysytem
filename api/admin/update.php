<?php
// require init.php
// require headers
require("../header_files_post.php");
require("../class/autoload/init.php");


// get Posted data
$data = json_decode(file_get_contents('php://input'));

// check for priviledges
$priviledge = Admin::priviledge(intval($_SESSION['priviledge']));

if($priviledge === false){
  // set response code(503);
  http_response_code(503);
  echo json_encode(array("message" => "Not an admin"));
}
else {
// perform neccessary form validations

if(!empty($data->name)
 && !empty($data->email)
){
  $name = strip_tags(trim(htmlspecialchars($data->name)));
  $email = strip_tags(trim(htmlspecialchars($data->email)));
  if(strlen($name) < 8){
    $error[] = "Please enter you full name";
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $error[] = "Email is invalid";
  }
  if(!isset($_SESSION['id'])){
    $error = "Admin not logged in";
  }

  if(!empty($error)){
    // set response code(503);
    http_response_code(503);
    echo json_encode(array("message" => $error));
  }
  else {

    // initialize class variables
    $admin->name = $name;
    $admin->email = $email;
    $admin->id = $_SESSION['id'];

    if($admin->update()){
      // set response code - 200 ok
      http_response_code(200);
      // // tell the user
      echo json_encode(array("message" => "Admin record updated."));
      }
    }
  }
}
 ?>
