<?php


// Database credentials
$host = "https://server212.web-hosting.com:2083";
$username = "visiappv";  
$password = "kDv2tqk2TtTY";      
$dbname = "visiappv_vision_africa_group";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
