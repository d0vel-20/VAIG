<?php 
  $pageTitle = "Cart";
  include '../includes/config.php';
  include '../includes/header.php';

?>

<div class=" mt-[100px] md:mt-[80px] min-h-screen flex flex-col justify-between">
        <!-- Cart Section -->
        <div class="container mx-auto px-4 py-8 max-w-7xl">
            <h1 class="text-2xl kanit-regular text-gray-800 mb-6">Your Cart</h1>

            <!-- Cart Table -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-purple-700 text-white text-left text-sm font-semibold">
                            <th class="py-4 px-6 kanit-light">Product</th>
                            <th class="py-4 px-6 kanit-light">Quantity</th>
                            <th class="py-4 px-6 kanit-light">Price</th>
                        </tr>
                    </thead>
                    <tbody id="cartItems">
                        <!-- Add more rows dynamically here -->

                    </tbody>
                </table>
            </div>

            <!-- Subtotal & Checkout Section -->
            <div class="mt-8 flex flex-col lg:flex-row justify-between items-center bg-white rounded-lg p-6">
                <div class="text-md kanit-regular text-gray-800">
                    Total: <p class="text-purple-700 kanit-light" id="totalele"></p>
                </div>
                    <a href="../public/checkout.php">
                    <button 
                    id="proceedToCheckout"
                    class="bg-purple-700 w-full  md:w-[300px] hover:bg-purple-800 text-white px-10 py-2 mt-4 lg:mt-0 rounded-md kanit-light focus:outline-none focus:ring-4 focus:ring-purple-500 text-md">
                    Proceed to Checkout
                </button>
                    </a>
            </div>
        </div>


    </div>

    <script>
        document.getElementById("proceedToCheckout").addEventListener("click", () => {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }
    // Redirect to the checkout page
    window.location.href = "../public/checkout.php";
});
    </script>




<?php include '../includes/footer.php'; ?>

