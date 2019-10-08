<?php
  require("../header_files_post.php");
  require("../class/autoload/init.php");

  if($student->logout()){
    // set response_code - 200 success
    http_response_code(200);
    echo json_encode(array("message" => "logged out successfully"));
  }

 ?>
