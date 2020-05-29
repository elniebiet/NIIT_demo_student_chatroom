<?php 
  include('connection.php');
  session_start();

  
  try {
    $query = "SELECT * FROM `posts`";
    $res = $mysqli->query($query) or die($mysqli->error.__LINE__);
    $data = array();

    while($row = $res->fetch_assoc()){
        array_push($data, $row);
    }    
    echo json_encode($data);
  } catch(Exception $e){
      echo 1;
  }

  