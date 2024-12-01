<?php 
include '../includes/config.php'; // Include DB connection

// Check if an ID is passed
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $pageTitle = $product['name']; // Set the page title dynamically
    } else {
        $pageTitle = "Product Not Found"; // Default title for missing products
        echo "<p class='text-center text-red-500'>Product not found.</p>";
        exit;
    }
} else {
    $pageTitle = "No Product Selected"; // Default title if no ID is provided
    echo "<p class='text-center text-red-500'>No product selected.</p>";
    exit;
}

include '../includes/header.php';
?>

<!-- Product Details Page -->
<section class="py-10 px-4 mt-14">
    <div class="container mx-auto max-w-5xl bg-white shadow-md rounded-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Product Image -->
            <div class="p-4">
                <img src="../uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="w-full h-auto rounded-md object-cover shadow-lg">
            </div>

            <!-- Product Details -->
            <div class="p-6">
                <h1 class="text-3xl text-gray-800 mb-4 kanit-regular "><?= $product['name'] ?></h1>
                <p class="text-gray-600 mb-4 kanit-light"><?= $product['description'] ?></p>
                <p class="text-2xl  text-gray-800 mb-6 kanit-light">$<?= $product['price'] ?></p>

                <!-- Quantity Selector -->
                <div class="flex items-center gap-4 mb-6">
                    <button id="decrement" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-2 rounded focus:outline-none">
                        -
                    </button>
                    <input type="number" id="quantity" value="1" min="1" class="w-16 text-center text-lg font-semibold border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
                    <button id="increment" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-2 rounded focus:outline-none">
                        +
                    </button>
                </div>

                <!-- Add to Cart Button -->
                <button id="addToCart" class="bg-purple-600 text-white text-lg font-medium px-6 py-3 kanit-regular rounded shadow hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</section>

<script>

function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalItems = cart.reduce((sum, product) => sum + product.quantity, 0);
    const cartBadge = document.getElementById("cartBadge");

    if (cartBadge) {
        cartBadge.textContent = totalItems;
        // Hide badge if cart is empty
        cartBadge.style.display = totalItems > 0 ? "flex" : "none";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const addToCartButton = document.getElementById("addToCart");
    const quantityInput = document.getElementById("quantity");

    addToCartButton.addEventListener("click", () => {
        const productId = <?= json_encode($product['id']) ?>;
        const productName = <?= json_encode($product['name']) ?>;
        const productPrice = <?= json_encode($product['price']) ?>;
        const productImage = <?= json_encode($product['image']) ?>;
        const quantity = parseInt(quantityInput.value) || 1;

        const product = {
            id: productId,
            name: productName,
            price: parseFloat(productPrice),
            image: productImage,
            quantity: quantity,
        };

        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const existingProductIndex = cart.findIndex((item) => item.id === productId);

        if (existingProductIndex > -1) {
            cart[existingProductIndex].quantity += quantity;
        } else {
            cart.push(product);
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        alert(`${productName} added to cart!`);

        // Update the cart badge
        updateCartBadge();
    });

    // Initial badge update on page load
    updateCartBadge();
});

</script>

<?php include '../includes/footer.php'; ?>
