<?php

session_start();
$connect = mysqli_connect("localhost", "root", "", "storedb");


$email = $_POST['email'];
$password = $_POST['password'];


if (isset($_POST["email"])) {
    $query = "SELECT * FROM user WHERE email = '" . $_POST["email"] . "' AND password = '" . $_POST["password"] . "'
    ";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["email"] = $_POST["email"];
        echo 'Yes';
    } else {

        echo 'No';
    }
}
