<?php
session_start();
include('connection.php');
try {
    $user = $_GET['user'];

    $query = "UPDATE `typing` SET typing='$user' WHERE id=1";
    //run query
    $insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
}
catch(Exception $e){
    echo 1;
}
