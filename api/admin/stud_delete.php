<?php
// require init.php
// require headers
require("../header_files_get.php");
require("../class/autoload/init.php");

if(!isset($_SESSION['priviledge']) || !isset($_SESSION['id'])){
  // set response code(503);
  http_response_code(503);
  echo json_encode(array("message" => "Not Authenticated"));
}
else {


if(isset($_GET['id'])){
  $id = $_GET['id'];

  // delete student record in database
  $admin->id = $id;

  if($admin->stud_delete()){
    // set response code to 201
    http_response_code(201);
    echo json_encode(array("message" => "Student record deleted successfully"));
  }
  else {
    // set response code to 500
    http_response_code(500);
    echo json_encode(array("message" => "No record found"));
  }
 }
}
