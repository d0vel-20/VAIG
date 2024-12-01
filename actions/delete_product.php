<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: adminLogin.php");
    exit();
}

include '../includes/config.php';

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $productId = (int)$_GET['id']; // Cast to integer for security

    // Prepare the delete query
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind the product ID to the query and execute it
        $stmt->bind_param("i", $productId);
        if ($stmt->execute()) {
            // Redirect to the product list page after deletion
            header("Location: ../admin/products.php");
            exit();
        } else {
            // If there was an error
            echo "Error: Could not delete product.";
        }
    } else {
        echo "Error: Could not prepare the statement.";
    }


} else {
    echo "Error: No product ID provided.";
}
?>
