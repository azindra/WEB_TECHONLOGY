<?php
$host     = "sql100.infinityfree.com";   // your actual host
$user     = "if0_41603738";              // your actual username
$password = "123ash123ash123";              // your actual password
$database = "if0_41603738_shopeasedb"; // your actual db name

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>