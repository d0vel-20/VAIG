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
    const cartTableBody = document.getElementById("cartItems");
    const totalPriceElement = document.getElementById("totalele");
    console.log(totalPriceElement);

    function loadCart() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        console.log("Cart data loaded from localStorage:", cart); // Debug log

        if (cart.length === 0) {
            console.warn("Cart is empty.");
        }

        cartTableBody.innerHTML = "";

        let totalPrice = 0; // Initialize total price

        cart.forEach((product) => {
            const productRow = document.createElement("tr");
            productRow.classList.add("border-b");
            const productTotal = product.price * product.quantity; // Calculate total for the product
            totalPrice += productTotal; // Add to the total price

            productRow.innerHTML = `
                <td class="py-4 px-6">
                    <div class="flex items-center">
                        <img src="./uploads/${product.image}" alt="${product.name}" class="w-16 h-16 rounded-md mr-4 object-cover shadow-md">
                        <div class="flex flex-col">
                            <span class="kanit-light text-gray-700 text-sm">${product.name}</span>
                            <button class="text-red-500 hover:text-red-700 mt-1 text-sm flex items-center remove-item" data-id="${product.id}">
                                <i class="fas fa-trash mr-1"></i> Remove
                            </button>
                        </div>
                    </div>
                </td>
                <td class="py-4 px-6">
                    <input type="number" value="${product.quantity}" min="1" class="w-16 px-3 py-2 text-center text-sm border border-gray-300 rounded-md update-quantity" data-id="${product.id}">
                </td>
                <td class="py-4 px-6 text-gray-700 text-sm kanit-light">$${productTotal.toFixed(2)}</td>
            `;

            cartTableBody.appendChild(productRow);
        });

        // Update the total price in the HTML
        totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;

        // Update the badge
        updateCartBadge();
    }

    // Update Quantity
    cartTableBody.addEventListener("change", (event) => {
        if (event.target.classList.contains("update-quantity")) {
            const productId = parseInt(event.target.getAttribute("data-id"));
            const newQuantity = parseInt(event.target.value);
            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            const productIndex = cart.findIndex((item) => item.id === productId);
            if (productIndex > -1 && newQuantity > 0) {
                cart[productIndex].quantity = newQuantity;
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            loadCart();
        }
    });

    // Remove Item
    cartTableBody.addEventListener("click", (event) => {
        if (event.target.closest(".remove-item")) {
            const productId = parseInt(event.target.closest(".remove-item").getAttribute("data-id"));
            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            cart = cart.filter((item) => item.id !== productId);

            localStorage.setItem("cart", JSON.stringify(cart));
            loadCart();
        }
    });

    // Initial Load
    loadCart();
});






