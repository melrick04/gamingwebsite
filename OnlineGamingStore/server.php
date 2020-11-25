<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "storedb";

    //create connection
    $con = mysqli_connect($servername, $username, $password, $db);

    //check connection
    if(!$con){
        die("Connection Failed:" .sqli_connect_error());
    }else{
        echo("Connected to storedb database");
    }
?>