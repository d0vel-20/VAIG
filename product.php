<?php 
$pageTitle = "Shop";
include './includes/config.php'; // Include DB connection
include './includes/header.php';

// Set default values for filters and pagination
$category = isset($_GET['category']) ? $_GET['category'] : '';
$brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = 20;

// Calculate offset for pagination
$offset = ($page - 1) * $itemsPerPage;
  
// Build the base query
$sql = "SELECT * FROM products WHERE 1=1";

// Add search query filter
if (!empty($query)) {
    $sql .= " AND (name LIKE ? OR category LIKE ? OR brand LIKE ?)";
}

// Add category filter if set
if (!empty($category)) {
    $sql .= " AND category = ?";
}

// Add brand filter if set
if (!empty($brand)) {
    $sql .= " AND brand = ?";
}

// Add pagination limit
$sql .= " LIMIT ?, ?";

// Prepare the query
$stmt = $conn->prepare($sql);

// Bind parameters dynamically
$params = [];
$paramTypes = '';

if (!empty($query)) {
    $searchTerm = '%' . $query . '%';
    $params[] = $searchTerm; // name
    $params[] = $searchTerm; // category
    $params[] = $searchTerm; // brand
    $paramTypes .= 'sss';
}

if (!empty($category)) {
    $params[] = $category;
    $paramTypes .= 's';
}

if (!empty($brand)) {
    $params[] = $brand;
    $paramTypes .= 's';
}

// Add limit and offset
$params[] = $offset;
$params[] = $itemsPerPage;
$paramTypes .= 'ii';

// Bind and execute
$stmt->bind_param($paramTypes, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Fetch products
$products = $result->fetch_all(MYSQLI_ASSOC);

// Get total product count for pagination
$totalQuery = "SELECT COUNT(*) as total FROM products WHERE 1=1";

// Add search query filter to the count query
if (!empty($query)) {
    $totalQuery .= " AND (name LIKE '%$query%' OR category LIKE '%$query%' OR brand LIKE '%$query%')";
}

if (!empty($category)) {
    $totalQuery .= " AND category = '$category'";
}

if (!empty($brand)) {
    $totalQuery .= " AND brand = '$brand'";
}

$totalResult = $conn->query($totalQuery);
$totalProducts = $totalResult->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalProducts / $itemsPerPage);
?>


<!-- Main Content -->
<main class="max-w-9xl mx-auto p-6 md:mt-24 mt-[130px]">
    <!-- Search and Filter Section -->
    <section class="flex flex-wrap justify-between items-center mb-6 md:px-12">
        <!-- Filter and Sort -->
        <div class="flex items-center justify-center gap-2">
            <!-- Filter by Category -->
            <form method="GET" class="flex gap-2">
                <select name="category" class="px-4 py-2 w-[90px] md:w-[200px] border rounded-lg text-[10px] md:text-[15px] focus:outline-none focus:ring focus:ring-purple-300">
                    <option value="">Filter by Category</option>
                    <option value="General Electronics" <?= $category == 'General Electronics' ? 'selected' : ''; ?>>General Electronics</option>
                    <option value="Solar Power" <?= $category == 'Solar Power' ? 'selected' : ''; ?>>Solar Power</option>
                    <option value="Home Entertainment" <?= $category == 'Home Entertainment' ? 'selected' : ''; ?>>Home Entertainment</option>
                </select>

                <!-- Filter by Brand -->
                <select name="brand" class="px-4 py-2 w-[90px] md:w-[200px] border rounded-lg text-[10px] md:text-[15px] focus:outline-none focus:ring focus:ring-purple-300">
                    <option value="">Filter by Brand</option>
                    <option value="Shile" <?= $brand == 'Shile' ? 'selected' : ''; ?>>Shile</option>
                    <option value="Omni" <?= $brand == 'Omni' ? 'selected' : ''; ?>>Omni</option>
                    <option value="Togo" <?= $brand == 'Togo' ? 'selected' : ''; ?>>Togo</option>
                    <option value="Juka" <?= $brand == 'Juka' ? 'selected' : ''; ?>>Juka</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600">Apply</button>
            </form>
        </div>
    </section>

    <!-- Product Display -->
    <section class="py-6 px-4 md:px-12">
        <h2 class="text-2xl kanit-regular mb-8">Shop varieties of electronics</h2>

        <div class="grid gap-6 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <a href="./product_id.php?id=<?= $product['id'] ?>" class="group block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="<?= './uploads/' . $product['image'] ?>" alt="<?= $product['name'] ?>" class="w-full h-40 object-cover">
                        </div>
                        <div class="p-2">
                            <p class="text-gray-800 text-[12px] kanit-light"><?= $product['name'] ?></p>
                            <p class="text-gray-800 text-[12px] text-purple-700 kanit-light">$<?= $product['price'] ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-600 col-span-full">No products found.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Pagination -->
    <section class="flex justify-center items-center mt-8 space-x-2">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&category=<?= $category ?>&brand=<?= $brand ?>" class="px-4 py-2 border rounded-lg bg-white hover:bg-purple-100 focus:ring focus:ring-purple-300">Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&category=<?= $category ?>&brand=<?= $brand ?>" class="px-4 py-2 border rounded-lg <?= $page == $i ? 'bg-purple-500 text-white' : 'bg-white hover:bg-purple-100' ?> focus:ring focus:ring-purple-300"><?= $i ?></a>
        <?php endfor; ?>
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>&category=<?= $category ?>&brand=<?= $brand ?>" class="px-4 py-2 border rounded-lg bg-white hover:bg-purple-100 focus:ring focus:ring-purple-300">Next</a>
        <?php endif; ?>
    </section>
</main>

<?php include './includes/footer.php'; ?>
