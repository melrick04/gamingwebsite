<?php

session_start();
require 'config.php';

$email = $_POST['email'];



if (isset($_POST["action"])) {

    unset($_SESSION["email"]);
}
