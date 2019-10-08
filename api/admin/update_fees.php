<?php
// require init.php
// require headers
require("../header_files_post.php");
require("../class/autoload/init.php");

// get Posted data
$data = json_decode(file_get_contents('php://input'));

if(!isset($_SESSION['priviledge']) || !isset($_SESSION['id'])){
  // set response code(503);
  http_response_code(503);
  echo json_encode(array("message" => "Not Authenticated"));
}
else{
    // set response code(201)
    $_SESSION['fees'] = intval($data->fees);
    http_response_code(201);
    echo json_encode(array("message" => "School fee updated successfully"));
}






 ?>
