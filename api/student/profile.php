<?php

  require("../header_files_get.php");
  require("../class/autoload/init.php");

  if(isset($_SESSION['id'])){
    $student->id = $_SESSION['id'];
    // set response code to 200
    $profile = json_decode(json_encode($student->profile()));

    echo json_encode(array("data" => $profile));

  }
  else{

    // set response code to 500
    echo json_encode(array("data" => "Student needs to login"));

  }





 ?>
