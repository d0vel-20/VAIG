<?php
include '../includes/config.php';

$message = "";
$toastClass = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];

     // Handle file upload
     if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/'; // Make sure this folder exists and is writable
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($fileExtension, $allowedExtensions)) {
            $message = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            $toastClass = "#007bff"; // Primary colo
            // header("Location: ../admin/products.php");
            // exit();
        }

        $newFileName = uniqid('product_', true) . '.' . $fileExtension; // Unique file name
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Insert into the database
            $sql = "INSERT INTO products (name, description, price, category, brand, image) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("ssdsss", $name, $description, $price, $category, $brand, $newFileName);

            // Execute the statement
            if ($stmt->execute()) {
                $message = "Product uploaded successfully.";
                $toastClass = "#28a745"; // Success color
            } else {
                $message = "Error: " . $stmt->error;
                $toastClass = "#dc3545"; // Danger color
            }
        } else {
            $message = "Failed to move the uploaded file.";
            $toastClass = "#dc3545"; // Danger color
        }
    } else {
        $message = "No file uploaded or there was an error during upload.";
        $toastClass = "#dc3545"; // Danger color

    }

    header("Location: ../admin/products.php");
    exit();

}

?>
