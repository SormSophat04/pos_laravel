// Sample product data
const products = [
    {
        id: 1,
        name: "Wireless Headphones",
        price: 99.99,
        category: "electronics",
        stock: 15,
        image:
            "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aGVhZHBob25lc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 2,
        name: "Smartphone",
        price: 799.99,
        category: "electronics",
        stock: 8,
        image:
            "https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c21hcnRwaG9uZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 3,
        name: "Laptop",
        price: 1299.99,
        category: "electronics",
        stock: 5,
        image:
            "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bGFwdG9wfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 4,
        name: "T-Shirt",
        price: 19.99,
        category: "clothing",
        stock: 30,
        image:
            "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dHNoaXJ0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 5,
        name: "Jeans",
        price: 49.99,
        category: "clothing",
        stock: 20,
        image:
            "https://images.unsplash.com/photo-1473966968600-fa801b869a1a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8amVhbnN8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 6,
        name: "Milk",
        price: 3.99,
        category: "groceries",
        stock: 50,
        image:
            "https://images.unsplash.com/photo-1550583720-4a6f5220d757?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWlsa3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 7,
        name: "Bread",
        price: 2.49,
        category: "groceries",
        stock: 40,
        image:
            "https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YnJlYWR8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 8,
        name: "Coffee",
        price: 5.99,
        category: "groceries",
        stock: 25,
        image:
            "https://images.unsplash.com/photo-1511920170033-f8396924c348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y29mZmVlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 9,
        name: "Pillow",
        price: 12.99,
        category: "home",
        stock: 15,
        image:
            "https://images.unsplash.com/photo-1565538810643-b5bdb714032a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cGlsbG93fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 10,
        name: "Blanket",
        price: 29.99,
        category: "home",
        stock: 10,
        image:
            "https://images.unsplash.com/photo-1576566588028-4147f3842f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YmxhbmtldHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 11,
        name: "Smart Watch",
        price: 199.99,
        category: "electronics",
        stock: 12,
        image:
            "https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8d2F0Y2h8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
    },
    {
        id: 12,
        name: "Sneakers",
        price: 79.99,
        category: "clothing",
        stock: 18,
        image:
            "https://images.unsplash.com/photo-1600269452121-1f5d1414c7a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8c25lYWtlcnN8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
    },
];

// Current cart items
let cart = [];
let currentPaymentMethod = "";
let receiptNumber = 1;

// DOM Elements
const productsGrid = document.getElementById("products-grid");
const cartItems = document.getElementById("cart-items");
const itemCount = document.getElementById("item-count");
const subtotal = document.getElementById("subtotal");
const tax = document.getElementById("tax");
const total = document.getElementById("total");
const discount = document.getElementById("discount");
const discountType = document.getElementById("discount-type");
const productSearch = document.getElementById("product-search");
const categoryButtons = document.querySelectorAll(".category-btn");
const clearCartBtn = document.getElementById("clear-cart");
const checkoutBtn = document.getElementById("checkout");
const cashPaymentBtn = document.getElementById("cash-payment");
const cardPaymentBtn = document.getElementById("card-payment");
const paymentModal = document.getElementById("payment-modal");
const closePaymentModal = document.getElementById("close-payment-modal");
const paymentMethodTitle = document.getElementById("payment-method-title");
const paymentTotal = document.getElementById("payment-total");
const cashPaymentSection = document.getElementById("cash-payment-section");
const cardPaymentSection = document.getElementById("card-payment-section");
const amountReceived = document.getElementById("amount-received");
const changeAmount = document.getElementById("change-amount");
const completePayment = document.getElementById("complete-payment");
const receiptModal = document.getElementById("receipt-modal");
const closeReceiptModal = document.getElementById("close-receipt-modal");
const receiptItems = document.getElementById("receipt-items");
const receiptSubtotal = document.getElementById("receipt-subtotal");
const receiptTax = document.getElementById("receipt-tax");
const receiptDiscount = document.getElementById("receipt-discount");
const receiptTotal = document.getElementById("receipt-total");
const receiptNumberSpan = document.getElementById("receipt-number");
const receiptDateTime = document.getElementById("receipt-date-time");
const newSaleFromReceipt = document.getElementById("new-sale-from-receipt");
const newTransactionBtn = document.getElementById("new-transaction");
const printReceiptBtn = document.getElementById("print-receipt");
const currentTime = document.getElementById("current-time");
const currentDate = document.getElementById("current-date");

// Initialize the app
function init() {
    renderProducts(products);
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // Event listeners
    productSearch.addEventListener("input", filterProducts);
    categoryButtons.forEach((btn) => {
        btn.addEventListener("click", () => filterByCategory(btn));
    });
    clearCartBtn.addEventListener("click", clearCart);
    checkoutBtn.addEventListener("click", openCheckoutModal);
    cashPaymentBtn.addEventListener("click", () => openPaymentModal("cash"));
    cardPaymentBtn.addEventListener("click", () => openPaymentModal("card"));
    closePaymentModal.addEventListener("click", closeModal);
    amountReceived.addEventListener("input", calculateChange);
    completePayment.addEventListener("click", completePaymentProcess);
    closeReceiptModal.addEventListener("click", () =>
        receiptModal.classList.add("hidden")
    );
    newSaleFromReceipt.addEventListener("click", newTransaction);
    newTransactionBtn.addEventListener("click", newTransaction);
    printReceiptBtn.addEventListener("click", printReceipt);
    discount.addEventListener("input", updateTotals);
    discountType.addEventListener("change", updateTotals);

    // Close modals when clicking outside
    window.addEventListener("click", (e) => {
        if (e.target === paymentModal) {
            closeModal();
        }
        if (e.target === receiptModal) {
            receiptModal.classList.add("hidden");
        }
    });
}

// Render products to the grid
function renderProducts(productsToRender) {
    productsGrid.innerHTML = "";

    if (productsToRender.length === 0) {
        productsGrid.innerHTML = `
                    <div class="col-span-full text-center py-8 text-gray-500">
                        <i class="fas fa-search text-4xl mb-2"></i>
                        <p>No products found</p>
                    </div>
                `;
        return;
    }

    productsToRender.forEach((product) => {
        const productCard = document.createElement("div");
        productCard.className =
            "product-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300 cursor-pointer";
        productCard.innerHTML = `
                    <div class="relative">
                        <img src="${product.image}" alt="${
            product.name
        }" class="w-full h-40 object-cover">
                        ${
            product.stock < 5
                ? `<span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">Low stock</span>`
                : ""
        }
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 truncate">${
            product.name
        }</h3>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-lg font-bold text-indigo-600">$${product.price.toFixed(
            2
        )}</span>
                            <span class="text-sm text-gray-500">${
            product.stock
        } in stock</span>
                        </div>
                        <button class="add-to-cart-btn w-full mt-3 bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition"
                                data-id="${product.id}" data-name="${
            product.name
        }" data-price="${product.price}">
                            <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                        </button>
                    </div>
                `;
        productsGrid.appendChild(productCard);
    });

    // Add event listeners to all add to cart buttons
    document.querySelectorAll(".add-to-cart-btn").forEach((btn) => {
        btn.addEventListener("click", addToCart);
    });
}

// Filter products by search term
function filterProducts() {
    const searchTerm = productSearch.value.toLowerCase();
    const filteredProducts = products.filter((product) =>
        product.name.toLowerCase().includes(searchTerm)
    );
    renderProducts(filteredProducts);
}

// Filter products by category
function filterByCategory(btn) {
    // Update active category button
    categoryButtons.forEach((b) =>
        b.classList.remove("bg-indigo-600", "text-white")
    );
    categoryButtons.forEach((b) =>
        b.classList.add("bg-gray-200", "hover:bg-gray-300")
    );
    btn.classList.remove("bg-gray-200", "hover:bg-gray-300");
    btn.classList.add("bg-indigo-600", "text-white");

    const category = btn.dataset.category;
    if (category === "all") {
        renderProducts(products);
    } else {
        const filteredProducts = products.filter(
            (product) => product.category === category
        );
        renderProducts(filteredProducts);
    }
}

// Add product to cart
function addToCart(e) {
    const id = parseInt(e.target.dataset.id);
    const name = e.target.dataset.name;
    const price = parseFloat(e.target.dataset.price);

    // Check if product already in cart
    const existingItem = cart.find((item) => item.id === id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id,
            name,
            price,
            quantity: 1,
        });
    }

    // Add pulse animation to cart button
    const cartIcon = document.querySelector("#checkout i");
    cartIcon.classList.add("pulse");
    setTimeout(() => cartIcon.classList.remove("pulse"), 300);

    updateCart();
}

// Update cart UI
function updateCart() {
    if (cart.length === 0) {
        cartItems.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-shopping-cart text-4xl mb-2"></i>
                        <p>Your cart is empty</p>
                    </div>
                `;
        itemCount.textContent = "0 items";
    } else {
        cartItems.innerHTML = "";
        cart.forEach((item) => {
            const cartItem = document.createElement("div");
            cartItem.className =
                "cart-item flex justify-between items-center py-3 px-2 border-b border-gray-200 transition";
            cartItem.innerHTML = `
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">${
                item.name
            }</h4>
                            <p class="text-sm text-gray-600">$${item.price.toFixed(
                2
            )}</p>
                        </div>
                        <div class="flex items-center">
                            <button class="quantity-btn bg-gray-200 w-6 h-6 rounded-full flex items-center justify-center hover:bg-gray-300" data-id="${
                item.id
            }" data-action="decrease">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <span class="mx-2 w-8 text-center">${
                item.quantity
            }</span>
                            <button class="quantity-btn bg-gray-200 w-6 h-6 rounded-full flex items-center justify-center hover:bg-gray-300" data-id="${
                item.id
            }" data-action="increase">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                            <button class="remove-btn ml-4 text-red-500 hover:text-red-700" data-id="${
                item.id
            }">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    `;
            cartItems.appendChild(cartItem);
        });

        itemCount.textContent = `${cart.reduce(
            (total, item) => total + item.quantity,
            0
        )} ${
            cart.reduce((total, item) => total + item.quantity, 0) === 1
                ? "item"
                : "items"
        }`;

        // Add event listeners to quantity buttons
        document.querySelectorAll(".quantity-btn").forEach((btn) => {
            btn.addEventListener("click", adjustQuantity);
        });

        // Add event listeners to remove buttons
        document.querySelectorAll(".remove-btn").forEach((btn) => {
            btn.addEventListener("click", removeItem);
        });
    }

    updateTotals();
}

// Adjust item quantity
function adjustQuantity(e) {
    const id = parseInt(e.target.closest("button").dataset.id);
    const action = e.target.closest("button").dataset.action;

    const item = cart.find((item) => item.id === id);

    if (action === "increase") {
        item.quantity += 1;
    } else if (action === "decrease" && item.quantity > 1) {
        item.quantity -= 1;
    }

    updateCart();
}

// Remove item from cart
function removeItem(e) {
    const id = parseInt(e.target.closest("button").dataset.id);
    cart = cart.filter((item) => item.id !== id);
    updateCart();
}

// Clear cart
function clearCart() {
    if (cart.length === 0) return;

    if (confirm("Are you sure you want to clear the cart?")) {
        cart = [];
        updateCart();
    }
}

// Update order totals
function updateTotals() {
    const subTotal = cart.reduce(
        (total, item) => total + item.price * item.quantity,
        0
    );
    const taxAmount = subTotal * 0.1; // 10% tax

    // Calculate discount
    let discountAmount = 0;
    if (discount.value && parseFloat(discount.value) > 0) {
        if (discountType.value === "percent") {
            discountAmount = subTotal * (parseFloat(discount.value) / 100);
        } else {
            discountAmount = parseFloat(discount.value);
        }

        // Ensure discount doesn't exceed subtotal
        discountAmount = Math.min(discountAmount, subTotal);
    }

    const totalAmount = subTotal + taxAmount - discountAmount;

    subtotal.textContent = `$${subTotal.toFixed(2)}`;
    tax.textContent = `$${taxAmount.toFixed(2)}`;
    total.textContent = `$${totalAmount.toFixed(2)}`;

    // Update payment modal if open
    if (!paymentModal.classList.contains("hidden")) {
        paymentTotal.textContent = `$${totalAmount.toFixed(2)}`;
        if (currentPaymentMethod === "cash") {
            calculateChange();
        }
    }
}

// Open checkout modal
function openCheckoutModal() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // For this demo, we'll just open the cash payment modal
    openPaymentModal("cash");
}

// Open payment modal
function openPaymentModal(method) {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    currentPaymentMethod = method;
    paymentModal.classList.remove("hidden");

    if (method === "cash") {
        paymentMethodTitle.textContent = "Cash Payment";
        cashPaymentSection.classList.remove("hidden");
        cardPaymentSection.classList.add("hidden");
        amountReceived.value = "";
        changeAmount.textContent = "$0.00";
    } else {
        paymentMethodTitle.textContent = "Card Payment";
        cashPaymentSection.classList.add("hidden");
        cardPaymentSection.classList.remove("hidden");
    }

    paymentTotal.textContent = total.textContent;
}

// Close payment modal
function closeModal() {
    paymentModal.classList.add("hidden");
}

// Calculate change for cash payment
function calculateChange() {
    const totalAmount = parseFloat(total.textContent.replace("$", ""));
    const receivedAmount = parseFloat(amountReceived.value) || 0;

    if (receivedAmount >= totalAmount) {
        const change = receivedAmount - totalAmount;
        changeAmount.textContent = `$${change.toFixed(2)}`;
    } else {
        changeAmount.textContent = "$0.00";
    }
}

// Complete payment process
function completePaymentProcess() {
    const totalAmount = parseFloat(total.textContent.replace("$", ""));

    if (currentPaymentMethod === "cash") {
        const receivedAmount = parseFloat(amountReceived.value) || 0;

        if (receivedAmount < totalAmount) {
            alert(
                `Insufficient amount received. Total is $${totalAmount.toFixed(2)}`
            );
            return;
        }
    } else {
        // Validate card details (simplified for demo)
        const cardNumber = document.getElementById("card-number").value;
        const expiryDate = document.getElementById("expiry-date").value;
        const cvv = document.getElementById("cvv").value;

        if (!cardNumber || !expiryDate || !cvv) {
            alert("Please enter all card details");
            return;
        }

        if (cardNumber.replace(/\s/g, "").length !== 16) {
            alert("Please enter a valid 16-digit card number");
            return;
        }

        if (!expiryDate.match(/^(0[1-9]|1[0-2])\/?([0-9]{2})$/)) {
            alert("Please enter a valid expiry date (MM/YY)");
            return;
        }

        if (cvv.length !== 3) {
            alert("Please enter a valid 3-digit CVV");
            return;
        }
    }

    // Process payment (in a real app, this would communicate with a payment processor)
    setTimeout(() => {
        closeModal();
        generateReceipt();
    }, 1000);
}

// Generate receipt
function generateReceipt() {
    const subTotal = cart.reduce(
        (total, item) => total + item.price * item.quantity,
        0
    );
    const taxAmount = subTotal * 0.1;

    // Calculate discount
    let discountAmount = 0;
    if (discount.value && parseFloat(discount.value) > 0) {
        if (discountType.value === "percent") {
            discountAmount = subTotal * (parseFloat(discount.value) / 100);
        } else {
            discountAmount = parseFloat(discount.value);
        }

        discountAmount = Math.min(discountAmount, subTotal);
    }

    const totalAmount = subTotal + taxAmount - discountAmount;

    // Update receipt number
    receiptNumberSpan.textContent = receiptNumber.toString().padStart(5, "0");

    // Update date and time
    const now = new Date();
    const options = {
        year: "numeric",
        month: "short",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    };
    receiptDateTime.textContent = now.toLocaleDateString("en-US", options);

    // Add items to receipt
    receiptItems.innerHTML = "";
    cart.forEach((item) => {
        const itemTotal = item.price * item.quantity;
        const receiptItem = document.createElement("div");
        receiptItem.className = "flex justify-between mb-2";
        receiptItem.innerHTML = `
                    <div>
                        <span class="font-medium">${item.name}</span>
                        <span class="text-xs text-gray-600 block">${
            item.quantity
        } x $${item.price.toFixed(2)}</span>
                    </div>
                    <span>$${itemTotal.toFixed(2)}</span>
                `;
        receiptItems.appendChild(receiptItem);
    });

    // Update totals
    receiptSubtotal.textContent = `$${subTotal.toFixed(2)}`;
    receiptTax.textContent = `$${taxAmount.toFixed(2)}`;
    receiptDiscount.textContent =
        discountAmount > 0 ? `-$${discountAmount.toFixed(2)}` : "$0.00";
    receiptTotal.textContent = `$${totalAmount.toFixed(2)}`;

    // Show receipt modal
    receiptModal.classList.remove("hidden");

    // Increment receipt number for next sale
    receiptNumber++;
}

// Print receipt
function printReceipt() {
    const receiptContent = document.getElementById("receipt-content").innerHTML;
    const originalContent = document.body.innerHTML;

    document.body.innerHTML = `
                <style>
                    body { font-family: 'Courier New', monospace; }
                    @media print {
                        @page { size: auto; margin: 0; }
                        body { padding: 10px; }
                    }
                </style>
                ${receiptContent}
            `;

    window.print();
    document.body.innerHTML = originalContent;
    updateCart(); // Restore the original content
}

// Start a new transaction
function newTransaction() {
    cart = [];
    discount.value = "";
    document.getElementById("order-notes").value = "";
    updateCart();
    receiptModal.classList.add("hidden");
}

// Update current date and time
function updateDateTime() {
    const now = new Date();

    // Time
    const hours = now.getHours().toString().padStart(2, "0");
    const minutes = now.getMinutes().toString().padStart(2, "0");
    const seconds = now.getSeconds().toString().padStart(2, "0");
    currentTime.textContent = `${hours}:${minutes}:${seconds}`;

    // Date
    const options = { year: "numeric", month: "short", day: "numeric" };
    currentDate.textContent = now.toLocaleDateString("en-US", options);
}

// Initialize the app
init();
