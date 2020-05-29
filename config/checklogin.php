<?php 
  include('connection.php');
  session_start();
  $user = $_GET['user'];
  $pass = $_GET['pass'];

  
  try {
    $query = "SELECT * FROM `users` WHERE username = '".$user."' AND password = '".$pass."'";
    $res = $mysqli->query($query) or die($mysqli->error.__LINE__);
    $row = $res->fetch_assoc();
    
    if($row['username'] == null){
      echo 1;
    } else {
      echo 0;
      $_SESSION['niituser'] = $user;
    }

  } catch(Exception $e){
      echo 1;
  }

  
  