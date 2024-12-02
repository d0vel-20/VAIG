<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];

    // Handle image upload (if new image is provided)
    if ($_FILES['image']['size'] > 0) {
        // New image uploaded
        $imageName = basename($_FILES['image']['name']);
        $imagePath = './uploads/' . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        // Keep the old image if no new image is uploaded
        $imageName = $_POST['current_image'];
    }


    // Debug: Print the received brand value
    echo "Received brand: " . $brand . "<br>";

    // Update product details
    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, category = ?, brand = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdsdsi", $name, $description, $price, $category, $brand, $imageName, $productId);
    $stmt->execute();

    // Redirect after update
    header('Location: ../admin/products.php');
}
?>




