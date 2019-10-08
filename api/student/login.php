<?php
// require init.php
// require headers
require("../header_files_post.php");
require("../class/autoload/init.php");

// get Posted data
$data = json_decode(file_get_contents('php://input'));

if(!empty($data->email) && !empty($data->password)){
  $email = strip_tags(trim(htmlspecialchars($data->email)));
  $password = strip_tags(trim(htmlspecialchars($data->password)));
  // hash the password
  $password = md5($password);

  // check if the students details is in the database
  $student->email = $email;
  $student->password = $password;
  if($user = $student->login()){
    $user = json_decode(json_encode($user));

    $_SESSION['id'] = $user->id;
    $_SESSION['status'] = $user->status;
    // set response code to 201
    http_response_code(201);
    echo json_encode(array("message" => "Student logged in successfully"));
  }
  else{
    // set response code(503);
    http_response_code(503);
    echo json_encode(array("message" => "Authentication failed"));
  }
}
