<?php
require("../header_files_get.php");
require("../class/autoload/init.php");

// check for priviledges

  if(!isset($_SESSION['priviledge']) || !isset($_SESSION['id'])){
    // set response code(503);
    http_response_code(503);
    echo json_encode(array("message" => "Not Authenticated"));
  }
  else{
    $priviledge = Admin::priviledge(intval($_SESSION['priviledge']));


if(isset($_SESSION['id'])){
  $admin->id = $_SESSION['id'];
  // set response code to 200
  $students = json_decode(json_encode($admin->students()));

  echo json_encode(array("data" => $students));

 }
}


 ?>
