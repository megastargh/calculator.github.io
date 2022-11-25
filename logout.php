<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "mygrading";

// Connecting to database
$connection = new mysqli($hostname, $username, $password, $database);

session_start();
session_destroy();
header("location: index.php");
?>