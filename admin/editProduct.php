<?php
session_start();



// Redirect to login if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: adminLogin.php");
    exit();
}

include '../includes/config.php';


$pageTitle = "Products";
include '../partials/sidebar.php';
$id = $_GET['id'];
if (!isset($id)) header('Location: ./products.php');
$query = "SELECT * FROM products WHERE id = $id";
$product = mysqli_fetch_assoc(mysqli_query($conn, $query));
// $product;
// while ($p = $products) {
//     $product = $p;
// }
// print_r($product);
// return;
?>

<main class="mt-16 lg:mt-0 lg:ml-64 bg-[#2b2929] p-6 overflow-y-auto h-screen">

    <div id="editModal" class=" fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-4 w-full max-w-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Edit Product</h2>

            <!-- Edit Product Form -->
            <form action="../actions/edit_product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="productId" value="<?= $product['id']; ?>">

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="editName" class="block text-gray-700">Product Name</label>
                    <input type="text" id="editName" name="name" class="w-full border text-black border-gray-300 rounded-lg p-2" value="<?= htmlspecialchars($product['name']); ?>" required>
                </div>

                <!-- Product Description -->
                <div class="mb-4">
                    <label for="editDescription" class="block text-gray-700">Description</label>
                    <textarea id="editDescription" name="description" class="w-full border text-black border-gray-300 rounded-lg p-2"><?= htmlspecialchars($product['description']); ?></textarea>
                </div>

                <!-- Product Price -->
                <div class="mb-4">
                    <label for="editPrice" class="block text-gray-700">Price</label>
                    <input type="number" id="editPrice" name="price" class="w-full border text-black border-gray-300 rounded-lg p-2" value="<?= htmlspecialchars($product['price']); ?>" required>
                </div>

                <!-- Product Category -->
                <div class="mb-4">
                    <label for="editCategory" class="block text-gray-700">Category</label>
                    <select id="editCategory" name="category" class="w-full border text-black border-gray-300 rounded-lg p-2">
                        <option value="General Electronics" <?= ($product['category'] == 'General Electronics') ? 'selected' : ''; ?>>General Electronics</option>
                        <option value="Solar Power" <?= ($product['category'] == 'Solar Power') ? 'selected' : ''; ?>>Solar Power</option>
                        <option value="Home Entertainment" <?= ($product['category'] == 'Home Entertainment') ? 'selected' : ''; ?>>Home Entertainment</option>
                        <option value="Audio Devices" <?= ($product['category'] == 'Audio Devices') ? 'selected' : ''; ?>>Audio Devices</option>
                        <option value="Cameras and Photography" <?= ($product['category'] == 'Cameras and Photography') ? 'selected' : ''; ?>>Cameras and Photography</option>
                        <option value="Mobile Device" <?= ($product['category'] == 'Mobile Device') ? 'selected' : ''; ?>>Mobile Device</option>
                        <option value="Kitchen Appliances" <?= ($product['category'] == 'Kitchen Appliances') ? 'selected' : ''; ?>>Kitchen Appliances</option>
                        <option value="Surveillance Cameras" <?= ($product['category'] == 'Surveillance Cameras') ? 'selected' : ''; ?>>Surveillance Cameras</option>
                    </select>
                </div>
<?php
$product['brand'] = strtolower($product['brand']);
?>
                <!-- Product Brand -->
                <div class="mb-4">
                    <label for="editBrand" class="block text-gray-700">Brand  </label>
                    <select id="editBrand" name="brand" class="w-full border text-black border-gray-300 rounded-lg p-2">
                        <option value="Shile" <?= ($product['brand'] == 'shile') ? 'selected' : ''; ?>>Shile</option>
                        <option value="Omni" <?= ($product['brand'] == 'omni') ? 'selected' : ''; ?>>Omni</option>
                        <option value="Togo" <?= ($product['brand'] == 'togo') ? 'selected' : ''; ?>>Togo</option>
                        <option value="Juka" <?= ($product['brand'] == 'juka') ? 'selected' : ''; ?>>Juka</option>
                    </select>
                </div>

                <!-- Product Image -->
                <div class="mb-4">
                    <label for="editImage" class="block text-gray-700">Image</label>
                    <input type="hidden" name="current_image" value="<?= $product['image']; ?>" class="w-full border text-black border-gray-300 rounded-lg p-2">
                    <input type="file" id="editImage" name="image" class="w-full border text-black border-gray-300 rounded-lg p-2">
                    <!-- Display Current Image if No New Image is Provided -->
                    <div id="currentImageWrapper">
                        <img class="mt-2 w-16 h-16 rounded-md" src="../uploads/<?= htmlspecialchars($product['image']); ?>" alt="Current Product Image">
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="mb-4 flex justify-end">
                    <button type="button" id="closeEditModal" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Update</button>
                </div>
            </form>
        </div>
    </div>

</main>