<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "url-shortener";

//Create connection
$connection = mysqli_connect($hostname, $username, $password,$dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
echo "";

?>