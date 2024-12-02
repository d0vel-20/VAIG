<?php 
  $pageTitle = "Check Out";
  include './includes/config.php';
  include './includes/header.php';

?>



<div class="min-h-screen mt-[80px] flex flex-col justify-between">
        <!-- Checkout Container -->
        <div class="container mx-auto px-4 py-8 max-w-3xl">
            <h1 class="text-3xl kanit-regular text-gray-800 mb-6">Checkout</h1>

            <!-- Cart Summary -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl kanit-regular text-gray-700 mb-4">Order Summary</h2>
                <div id="cartItems">
                    <!-- Example Product -->
                    
                </div>
                <div class="mt-6 flex justify-between items-center text-lg">
                    <span class="font-semibold">Total:</span>
                    <span class="text-purple-700 font-bold"></span>
                </div>
            </div>

            <!-- User Details Form -->
            <div class="bg-white shadow-lg rounded-lg p-6 mt-8">
                <h2 class="text-xl font-medium text-gray-700 mb-4">Your Details</h2>

                <!-- Error Message -->
                <p id="errorMessage" class="text-red-500 text-sm mb-4 hidden">
                    Please fill in all your details to proceed
                </p>

                <form id="checkoutForm">
                    <div class="grid grid-cols-1 gap-4">
                        <input type="text" id="userName" placeholder="Full Name" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-700 outline-none">
                            <input type="email" id="userEmail" placeholder="Email Address" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-700 outline-none">
                            <input type="number" id="userPhone" placeholder="Phone Number" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-700 outline-none">
                        <input type="text" id="userAddress" placeholder="Address" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-700 outline-none">
                        <input type="text" id="userState" placeholder="State" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-700 outline-none">
                        
                        
                    </div>
                </form>
            </div>

            <!-- WhatsApp Checkout Button -->
            <div class="mt-8">
                <a id="whatsappLink" target="_blank"
                    class="w-full bg-green-500 hover:bg-green-600 text-white text-center py-4 rounded-md font-medium focus:outline-none focus:ring-4 focus:ring-green-300 text-lg block">
                    Proceed to WhatsApp Checkout
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
      document.addEventListener("DOMContentLoaded", () => {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartItemsContainer = document.getElementById("cartItems");
    const totalElement = document.querySelector(".text-purple-700");
    const errorMessage = document.getElementById("errorMessage");

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <p class="text-center text-gray-500">Your cart is empty.</p>
        `;
        totalElement.textContent = "$0.00";
        return;
    }

    let cartTotal = 0;

    // Populate the cart items
    cart.forEach((item) => {
        const itemElement = document.createElement("div");
        itemElement.classList.add("flex", "justify-between", "items-center", "py-2", "border-b");

        // Add image, name, quantity, and price (no remove button or editable quantity)
        itemElement.innerHTML = `
            <div class="flex items-center">
                <img src="./uploads/${item.image}" alt="${item.name}" class="w-12 h-12 object-cover mr-4"> <!-- Product image -->
                <div>
                    <p class="kanit-regular">${item.name}</p>
                    <small class="text-gray-500 kanit-light">Quantity: ${item.quantity}</small>
                </div>
            </div>
            <span class="text-gray-700 kanit-light">$${(item.price * item.quantity).toFixed(2)}</span>
        `;
        cartItemsContainer.appendChild(itemElement);
        cartTotal += item.price * item.quantity;
    });

    // Set the total
    totalElement.textContent = `$${cartTotal.toFixed(2)}`;

    // WhatsApp Checkout Link
    const whatsappLink = document.getElementById("whatsappLink");
    whatsappLink.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent default link navigation

        const name = document.getElementById("userName").value.trim();
        const address = document.getElementById("userAddress").value.trim();
        const state = document.getElementById("userState").value.trim();
        const phone = document.getElementById("userPhone").value.trim();
        const email = document.getElementById("userEmail").value.trim();

        if (!name || !address || !state || !phone || !email) {
            errorMessage.classList.remove("hidden");
            return;
        }

        errorMessage.classList.add("hidden");

        let whatsappMessage = `Hello, I want to place an order:\n\n`;
        cart.forEach((item) => {
            whatsappMessage += `- ${item.name} (x${item.quantity}): $${(item.price * item.quantity).toFixed(2)}\n`;
        });
        whatsappMessage += `\nTotal: $${cartTotal.toFixed(2)}\n\n`;
        whatsappMessage += `Name: ${name}\nAddress: ${address}\nState: ${state}\nPhone: ${phone}\nEmail: ${email}`;

        const whatsappURL = `https://api.whatsapp.com/send?phone=2348148029055&text=${encodeURIComponent(whatsappMessage)}`;

        // Debugging logs
        console.log(whatsappMessage);
        console.log(whatsappURL);

        // Navigate to WhatsApp
        window.open(whatsappURL, "_blank");
    });
});


    </script>

















<?php include './includes/footer.php'; ?>
