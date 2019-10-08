<?php
// bootstrap all APP neccessary files
session_start();
require($_SERVER['DOCUMENT_ROOT']."/fee_system/api/class/db/connection.php");
require($_SERVER['DOCUMENT_ROOT']."/fee_system/api/class/student.class.php");
require($_SERVER['DOCUMENT_ROOT']."/fee_system/api/class/admin.class.php");




// initialize the classes
$database = new Database();
$db = $database->getConnection();
$student = new Student($db);
$admin = new Admin($db);

$_SESSION['fees'] = 80000;
 ?>
