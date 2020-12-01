<?php

session_start();
$connect = mysqli_connect("localhost", "root", "", "storedb");

$email = $_POST['email'];



if (isset($_POST["action"])) {

    unset($_SESSION["email"]);
}
