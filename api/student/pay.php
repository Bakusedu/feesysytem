<?php
require("../header_files_post.php");
require("../class/autoload/init.php");

// get Posted data
$data = json_decode(file_get_contents('php://input'));
$half = $_SESSION['fees']/2;
$full = $_SESSION['fees'];

if(isset($_SESSION['id'])){
  $student->id = $_SESSION['id'];
  if($data->payment_type === 'half'){
    $student->status = 2;
    $_SESSION['status'] = $student->status;
    $student->payment_type = 'HALF';
    $student->amount = $half;
  }else{
    $student->status = 1;
    $_SESSION['status'] = $student->status;
    $student->payment_type = 'full';
    $student->amount = $full;
  }
  $student->pay();
  http_response_code(201);
  echo json_encode(array("message" => "Student fees paid successfully"));
}else{
  http_response_code(503);
  echo json_encode(array("message" => "Student must be logged in"));
}




 ?>
