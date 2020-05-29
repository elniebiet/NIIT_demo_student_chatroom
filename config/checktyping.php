<?php 
  include('connection.php');
  
  try {
    $query = "SELECT * FROM `typing` WHERE id = 1";
    $res = $mysqli->query($query) or die($mysqli->error.__LINE__);
    $row = $res->fetch_assoc();
    
    if($row['typing'] == ''){
      echo 1;
    } else {
      echo $row['typing'];
    }

  } catch(Exception $e){
      echo 1;
  }
