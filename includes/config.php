<?php


// Database credentials
$host = "localhost";
$username = "root";  
$password = "";      
$dbname = "vision_africa_group";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
