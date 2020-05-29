<?php
session_start();
//check if user exists and add to db if he doesnt exist
    $user = $_GET['user'];
    $pass = $_GET['pass'];


    function checkExist($us){
        include("connection.php");
        $query = "SELECT * FROM `users` WHERE username = '".$us."'";
        $res = $mysqli->query($query) or die($mysqli->error.__LINE__);
        $row = $res->fetch_assoc();
        try {
            $status = ($row == '') ? 0:1;
            return $status;
        } catch(Exception $e) {
            return 1;
        }
    
    }

    function addUser($u, $p){
        include("connection.php");
        if(checkExist($u) == 1){
            echo 1; //user exist
            return;
        } else {
            try {
                    $query = "INSERT INTO `users` (username, password) VALUES ('$u', '$p')";
                    //run query
                    $insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
                    echo 0; //added
                    $_SESSION['niituser'] = $u;
                    return;
                } catch(Exception $e){
                    echo 2; return; //error adding
            }
        }
    }
    addUser($user, $pass);
    //     //set correct choice
    //     $correct_choice = $row['id'];

    
