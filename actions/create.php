<?php
  include '../includes/config.php';



  // SQL to create the products table
$sql = "CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {  
    echo "Table 'categories' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}
?>