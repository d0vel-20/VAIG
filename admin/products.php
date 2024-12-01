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



if (isset($_GET['message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_GET['message']) . '</div>';
}

// Get the current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page is at least 1

$perPage = 20; // Number of products per page
$offset = ($page - 1) * $perPage;

// Initialize search and filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Build the query
$query = "SELECT * FROM products WHERE 1";
$params = [];
$types = "";

// Add search condition
if (!empty($search)) {
    $query .= " AND (name LIKE ? OR brand LIKE ? OR category LIKE ?)";
    $params[] = "%" . $search . "%";
    $params[] = "%" . $search . "%";
    $params[] = "%" . $search . "%";
    $types .= "sss";
}

// Add category filter
if (!empty($categoryFilter)) {
    $query .= " AND category = ?";
    $params[] = $categoryFilter;
    $types .= "s";
}

// Add pagination
$query .= " LIMIT ? OFFSET ?";
$params[] = $perPage;
$params[] = $offset;
$types .= "ii";

// Prepare the query
$stmt = $conn->prepare($query);

// Bind parameters if any
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Get the total number of products for pagination
$totalQuery = "SELECT COUNT(*) as total FROM products WHERE 1";
$totalParams = [];
$totalTypes = "";

// Apply the same search and filter conditions
if (!empty($search)) {
    $totalQuery .= " AND (name LIKE ? OR brand LIKE ? OR category LIKE ?)";
    $totalParams[] = "%" . $search . "%";
    $totalParams[] = "%" . $search . "%";
    $totalParams[] = "%" . $search . "%";
    $totalTypes .= "sss";
}
if (!empty($categoryFilter)) {
    $totalQuery .= " AND category = ?";
    $totalParams[] = $categoryFilter;
    $totalTypes .= "s";
}

$totalStmt = $conn->prepare($totalQuery);
if (!empty($totalParams)) {
    $totalStmt->bind_param($totalTypes, ...$totalParams);
}
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalProducts = $totalResult->fetch_assoc()['total'];

$totalPages = ceil($totalProducts / $perPage);


// Query to get total products
$totalProductsQuery = "SELECT COUNT(*) as total FROM products";
$totalProductsResult = $conn->query($totalProductsQuery);

if ($totalProductsResult) {
    $totalProductsCount = $totalProductsResult->fetch_assoc()['total'];
} else {
    $totalProductsCount = 0;
}


// Fetch distinct categories from the products table
$categoryQuery = "SELECT DISTINCT category FROM products";
$categoryResult = $conn->query($categoryQuery);

$categories = [];
if ($categoryResult) {
    while ($category = $categoryResult->fetch_assoc()) {
        $categories[] = $category['category'];
    }
} else {
    $categories = [];
}
?>



<!-- Main Section -->
<main class="mt-16 lg:mt-0 lg:ml-64 bg-[#2b2929] p-6 overflow-y-auto h-screen">

<div class="bg-[#1a1818] text-white mt-6 p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold">Total Products</h3>
    <p class="text-3xl mt-2"><?php echo $totalProductsCount; ?></p>
</div>
    
    <!-- Search and Filter -->
    <div class="mb-6 flex mt-4 items-center justify-between">
    
        <form  class="flex items-center bg-[#1a1818] p-2 rounded-lg w-full max-w-md shadow-md">
            <input 
                type="text" 
                name="search"
                value="<?php echo htmlspecialchars($search); ?>"
                placeholder="Search for products, categories, brands..." 
                class="flex-grow bg-transparent text-sm text-white placeholder-gray-400 px-3 py-2 focus:outline-none"
            >
            <button 
                type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg font-semibold">
                Search
            </button>
        </form>

        <form method="GET">
        <!-- <select 
    id="categoryFilter" 
    name="category" 
    class="px-4 py-2 text-black w-[200px] border rounded-lg text-[10px] md:text-[15px] focus:outline-none focus:ring focus:ring-purple-300"
>
    <option value="">Category</option>
    <?php foreach ($categories as $category): ?>
        <option value="<?php echo htmlspecialchars($category); ?>">
            <?php echo htmlspecialchars($category); ?>
        </option>
    <?php endforeach; ?>    
</select> -->

        </form>

        <button id="uploadProductBtn" class=" sm:mt-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Upload Product
        </button>

    </div>

    <div class="flex items-center justify-left gap-2">
   

        

    </div>

    <!-- Products Table -->
    <div class="bg-[#1a1818] shadow-md mt-3 rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4 text-white">Product List</h3>
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-left text-red-700">
                    <th class="p-3 border border-gray-300">Image</th>
                    <th class="p-3 border border-gray-300">Product Name</th>
                    <th class="p-3 border border-gray-300">Price ($)</th>
                    <th class="p-3 border border-gray-300">Category</th>
                    <th class="p-3 border border-gray-300">Brand</th>
                    <th class="p-3 border border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="p-3 border border-gray-300">
                            <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-16 h-16 rounded-md">
                        </td>
                        <td class="p-3 border border-gray-300"><?php echo htmlspecialchars($product['name']); ?></td>
                        <td class="p-3 border border-gray-300"><?php echo number_format($product['price'], 2); ?></td>
                        <td class="p-3 border border-gray-300"><?php echo htmlspecialchars($product['category']); ?></td>
                        <td class="p-3 border border-gray-300"><?php echo htmlspecialchars($product['brand']); ?></td>
                        <td class="p-3 border border-gray-300">
                            <div class="flex items-center space-x-2">
                                <button onclick="openEditModal('<?php echo $product['id']; ?>')" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Edit</button>
                                 <!-- Delete Button -->
        <a href="../actions/delete_product.php?id=<?php echo urlencode($product['id']); ?>" 
             class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700" 
                                         onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center mt-8 space-x-2">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($categoryFilter); ?>" class="px-4 py-2 bg-gray-200 text-gray-600 font-semibold rounded hover:bg-gray-300">Previous</a>
        <?php else: ?>
            <button disabled class="px-4 py-2 bg-gray-200 text-gray-600 font-semibold rounded opacity-50">Previous</button>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($categoryFilter); ?>" class="px-4 py-2 <?php echo $i == $page ? 'bg-black text-white' : 'bg-gray-200 text-gray-600'; ?> font-semibold rounded hover:bg-blue-700"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($categoryFilter); ?>" class="px-4 py-2 bg-gray-200 text-gray-600 font-semibold rounded hover:bg-gray-300">Next</a>
        <?php else: ?>
            <button disabled class="px-4 py-2 bg-gray-200 text-gray-600 font-semibold rounded opacity-50">Next</button>
        <?php endif; ?>
    </div>
</main>

<!-- Upload Product Modal -->
<div id="uploadProductModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg shadow-lg">
        <h3 class="text-xl text-black font-semibold mb-4">Upload New Product</h3>

        


        <form method="POST" action="../actions/upload_products.php" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="name" class="block text-gray-700">Product Name</label>
                <input type="text" id="name" name="name" class="w-full border text-black border-gray-300 rounded-lg p-2" required>
            </div>
            <div>
    <label for="description" class="block text-black" >Description</label>
    <textarea id="description" name="description" class="w-full border text-black border-gray-300 rounded-lg p-2"></textarea>
</div>

            <div>
                <label for="price" class="block text-gray-700">Price (₦)</label>
                <input type="number" id="price" name="price" class="w-full border text-black border-gray-300 rounded-lg p-2" required>
            </div>
            <div>
                <label for="category" class="block text-gray-700">Category</label>
                <select id="category" name="category" class="w-full border text-black border-gray-300 rounded-lg p-2" required>
                    <option value="General Electronics">General Electronics</option>
                    <option value="Solar Power">Solar Power</option>
                    <option value="Home Entertainment">Home Entertainment</option>
                    <option value="Audio Devices">Audio Devices</option>
                    <option value="Cameras and Photography">Cameras and Photography</option>
                    <option value="Mobile Device">Mobile Device</option>
                    <option value="Kitchen Appliances">Kitchen Appliances</option>
                    <option value="Surveliance Cameras">Surveliance Cameras</option>
                </select>
            </div>
            <div>   
                <label for="brand" class="block text-gray-700">Brands</label>
                <select id="brand" name="brand" class="w-full border text-black border-gray-300 rounded-lg p-2" required>
                    <option value="Shile">Shile</option>
                    <option value="Omni">Omni</option>
                    <option value="Togo">Togo</option>
                    <option value="juka">Juka</option>
                </select>
            </div>
            <div>
                <label for="image" class="block text-gray-700">image</label>
                <input type="file" id="image" name="image" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <div class="flex justify-end gap-4">
                <button type="button" id="closeUploadModal" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Upload</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center">
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

            <!-- Product Brand -->
            <div class="mb-4">
                <label for="editBrand" class="block text-gray-700">Brand</label>
                <select id="editBrand" name="brand" class="w-full border text-black border-gray-300 rounded-lg p-2">
                    <option value="Shile" <?= ($product['brand'] == 'Shile') ? 'selected' : ''; ?>>Shile</option>
                    <option value="Omni" <?= ($product['brand'] == 'Omni') ? 'selected' : ''; ?>>Omni</option>
                    <option value="Togo" <?= ($product['brand'] == 'Togo') ? 'selected' : ''; ?>>Togo</option>
                    <option value="Juka" <?= ($product['brand'] == 'Juka') ? 'selected' : ''; ?>>Juka</option>
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




<script>
        let toastElList = [].slice.call(document.querySelectorAll('.toast'))
        let toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, { delay: 3000 });
        });
        toastList.forEach(toast => toast.show());
    </script>
<script>
    const uploadProductBtn = document.getElementById('uploadProductBtn');
    const uploadProductModal = document.getElementById('uploadProductModal');
    const closeUploadModal = document.getElementById('closeUploadModal');
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');


    uploadProductBtn.addEventListener('click', () => {
        uploadProductModal.classList.remove('hidden');
    });

    closeUploadModal.addEventListener('click', () => {
        uploadProductModal.classList.add('hidden');
    });

    // Open Edit Modal and populate fields
function openEditModal(productId) {
     // Show the modal
     document.getElementById('editModal').classList.remove('hidden');
}


    closeEditModal.addEventListener('click', () => {
        editModal.classList.add('hidden');
    });
</script>


