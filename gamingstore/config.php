<?php

$conn = new mysqli("localhost", "root", "", "storedb");

if ($conn->connect_error) {
    die("Connection Failed" . $conn->connect_error);
}
