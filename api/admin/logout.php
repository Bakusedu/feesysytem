<?php
  require("../header_files_post.php");
  require("../class/autoload/init.php");
  // check for priviledges
  // $priviledge = Admin::priviledge();

  // if(!$priviledge){
  //   // set response code(503);
  //   http_response_code(503);
  //   echo json_encode(array("message" => "Not an admin"));
  // }

  if($student->logout()){
    // set response_code - 200 success
    http_response_code(200);
    echo json_encode(array("message" => "logged out successfully"));
  }

 ?>
