<?php
require("../header_files_get.php");
require("../class/autoload/init.php");
$student->status = $_SESSION['status'];
if($student->priviledge()){
  // set response code 201
  http_response_code(201);
  echo json_encode(array("message" => "Eligible for the Online Course Registration  service"));
}
else{
  // set response code to 500
  http_response_code(500);
  echo json_encode(array("message" => "Not Eligible for the Course Registration service"));
}


 ?>
