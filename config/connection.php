<?php
    //create connection credentials
    $db_host = 'localhost';
    $db_name = 'niit';
    $db_user = 'root';
    $db_pass = '';

    //create mysqli object
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    //Error Handler
    if($mysqli->connect_error){
        printf("Connect Failed: %s\n", $mysqli->connect_error);
        exit();
    }