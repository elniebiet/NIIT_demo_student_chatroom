<?php
session_start();
include('connection.php');
try {
    $user = '';

    $query = "UPDATE `typing` SET typing='$user' WHERE id=1";
    //run query
    $insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
    echo 0;
}
catch(Exception $e){
    echo 1;
}

//insert message
try {
    $us = $_GET['user'];
    $me = $_GET['message'];
    if($me != ""){
        $query = "INSERT INTO `posts` (username, post) VALUES ('$us', '$me')";
        //run query
        $insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
    }
    
}
catch(Exception $e){
    echo 1;
}
