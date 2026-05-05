<?php
$host     = "";   // your actual host
$user     = "";              // your actual username
$password = "password";              // your actual password
$database = ""; // your actual db name

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>