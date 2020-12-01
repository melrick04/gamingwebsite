<?php

session_start();
require 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$password = $_POST['password'];

$s = "select * from user where email = '$email'";

$result = mysqli_query($conn, $s);

$num = mysqli_num_rows($result);


if ($num == 1) {
    echo "User with this email exists";
} else {
    $reg = " insert into user(user_name,email,address,password) values ('$name','$email','$address','$password')";
    mysqli_query($conn, $reg);
    echo "Registration Successful";
}
