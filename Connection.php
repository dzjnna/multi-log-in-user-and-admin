<?php

$host = "localhost:3307";
$username = "root";
$password = "";
$database = "logindb";
  

if($_SERVER['REQUEST_METHOD']=='POST'){
  $Email = $_POST['Email'];
  $Password = $_POST['Password'];

  $con = new mysqli('localhost:3307', 'root', '', 'logindb');
  if($con) {
    $stmt = $con->prepare("INSERT INTO `login_tbl`(Email, Password) VALUES(?, ?)");
    $stmt->bind_param("ss", $Email, $Password);
    $stmt->execute();
    if($stmt) {
      echo "Submitted";
    } else {
      die(mysqli_error($con));
    }
  } else {
    die(mysqli_error($con));
  }
  }

