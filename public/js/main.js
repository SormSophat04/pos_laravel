// Global cart object
let cart = {};
// $botToken = env("TELEGRAM_BOT_TOKEN");
// $chatId = env("TELEGRAM_CHAT_ID");

// function addToCart(id, name, price) {
//     fetch("/cart/add", {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json",
//             "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
//                 .content,
//         },
//         body: JSON.stringify({ id, name, price }),
//     })
//         .then((res) => res.json())
//         .then((data) => {
//             if (data.status === "success") {
//                 cart = data.cart;
//                 updateCartUI(cart);
//             }
//         });
// }

function addToCart(id, name, price, qty) {
    if (qty === 0) {
        alert("This product is out of stock.");
        return;
    }

    fetch("/cart/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({ id, name, price }),
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.status === "success") {
                cart = data.cart;
                updateCartUI(cart);
            }
        });
}

// function updateCartUI(cart) {
//     let subtotal = 0;
//     let totalItems = 0;
//     let cartHtml = "";

//     for (let id in cart) {
//         const item = cart[id];
//         const itemTotal = item.price * item.quantity;
//         subtotal += itemTotal;

//         cartHtml += `
//                 <div class="cart-item flex justify-between items-center bg-gray-100 p-3 mb-2 rounded shadow-sm">
//                     <div>
//                         <div class="font-semibold">${item.name}</div>
//                         <div class="text-sm text-gray-500">$${item.price.toFixed(
//                             2
//                         )}</div>
//                     </div>
//                     <div class="flex items-center space-x-2">
//                         <button class="decrease-qty m-0 text-secondary" data-id="${id}"><i class="bi bi-dash-circle-fill fs-4"></i></button>
//                         <span class="font-medium px-3 mx-2">${
//                             item.quantity
//                         }</span>
//                         <button class="increase-qty m-0 text-secondary" data-id="${id}"><i class="bi bi-plus-circle-fill fs-4"></i></button>
//                         <button class="remove-item text-red-500 ms-3" data-id="${id}">
//                             <i class="bi bi-trash-fill fs-5"></i>
//                         </button>
//                     </div>
//                 </div>
//             `;
//     }

//     const tax = subtotal * 0.1;
//     const total = subtotal + tax;

//     document.getElementById("cart-items").innerHTML =
//         cartHtml ||
//         `<div
//                 id="cart-items"
//                 class="mb-4 max-h-96 overflow-y-auto border-gray-200"
//                     >
//                     <div id="cart-items" class="text-center py-8 text-gray-500">
//                     <i class="fas fa-shopping-cart text-4xl mb-2"></i>
//                 <p>{{message.cart_empty}}</p>
//             </div>
//             </div>`;
//     document.getElementById("subtotal").textContent = `$${subtotal.toFixed(2)}`;
//     document.getElementById("tax").textContent = `$${tax.toFixed(2)}`;
//     document.getElementById("total").textContent = `$${total.toFixed(2)}`;
//     document.getElementById("total-items").textContent = `${totalItems} item${
//         totalItems !== 1 ? "s" : ""
//     }`;
//     document.getElementById("clear-cart-btn").disabled =
//         Object.keys(cart).length === 0;
//     addCartEventListeners();
// }

function updateCartUI(cart) {
    let subtotal = 0;
    let totalItems = 0;
    let cartHtml = "";

    for (let id in cart) {
        const item = cart[id];
        const itemTotal = Number(item.price).toFixed(2) * item.quantity;
        subtotal += itemTotal;
        totalItems += item.quantity;

        cartHtml += `
            <div class="cart-item flex justify-between items-center bg-gray-100 p-3 mb-2 rounded shadow-sm">
                <div>
                    <div class="font-semibold">${item.name}</div>
                    <div class="text-sm text-gray-500">$${Number(
                        item.price
                    ).toFixed(2)}</div>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="decrease-qty m-0 text-secondary" data-id="${id}">
                        <i class="bi bi-dash-circle-fill fs-4"></i>
                    </button>
                    <span class="font-medium px-3 mx-2">${item.quantity}</span>
                    <button class="increase-qty m-0 text-secondary" data-id="${id}">
                        <i class="bi bi-plus-circle-fill fs-4"></i>
                    </button>
                    <button class="remove-item text-red-500 ms-3" data-id="${id}">
                        <i class="bi bi-trash-fill fs-5"></i>
                    </button>
                </div>
            </div>
        `;
    }

    // const tax = subtotal * 0.1;
    // const total = subtotal + tax;

    // document.getElementById("cart-items").innerHTML =
    //     cartHtml ||
    //     `<div class="text-center py-8 text-gray-500">
    //         <i class="fas fa-shopping-cart text-4xl mb-2"></i>
    //         <p>${message.cart_empty}</p>
    //     </div>`;

    // document.getElementById("subtotal").textContent = `$${subtotal.toFixed(2)}`;
    // document.getElementById("tax").textContent = `$${tax.toFixed(2)}`;
    // document.getElementById("total").textContent = `$${total.toFixed(2)}`;

    // document.getElementById("total-items").textContent = `${totalItems} item${
    //     totalItems !== 1 ? "s" : ""
    // }`;

    // document.getElementById("clear-cart-btn").disabled =
    //     Object.keys(cart).length === 0;

    // addCartEventListeners();

    const tax = subtotal * 0.1;
    const total = subtotal + tax;

    // Define the 'message' object before it is used
    const message = {
        cart_empty: "Your cart is empty.", // Replace with your desired empty cart message
    };

    document.getElementById("cart-items").innerHTML =
        cartHtml ||
        `<div class="text-center py-8 text-gray-500">
            <i class="fas fa-shopping-cart text-4xl mb-2"></i>
            <p>${message.cart_empty}</p>
        </div>`;

    document.getElementById("subtotal").textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById("tax").textContent = `$${tax.toFixed(2)}`;
    document.getElementById("total").textContent = `$${total.toFixed(2)}`;

    document.getElementById("total-items").textContent = `${totalItems} item${
        totalItems !== 1 ? "s" : ""
    }`;

    document.getElementById("clear-cart-btn").disabled =
        Object.keys(cart).length === 0;

    addCartEventListeners();
}

function addCartEventListeners() {
    document.querySelectorAll(".increase-qty").forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.dataset.id;
            fetch("/cart/increase", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({ id }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.status === "success") {
                        cart = data.cart;
                        updateCartUI(cart);
                    }
                });
        });
    });

    document.querySelectorAll(".decrease-qty").forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.dataset.id;
            fetch("/cart/decrease", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({ id }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.status === "success") {
                        cart = data.cart;
                        updateCartUI(cart);
                    }
                });
        });
    });

    document.querySelectorAll(".remove-item").forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.dataset.id;
            fetch("/cart/remove", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({ id }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.status === "success") {
                        cart = data.cart;
                        updateCartUI(cart);
                    }
                });
        });
    });
}

window.onload = function () {
    fetch("/cart/get")
        .then((res) => res.json())
        .then((data) => {
            if (data.status === "success") {
                cart = data.cart;
                updateCartUI(cart);
            }
        });
};

document.getElementById("clear-cart-btn").addEventListener("click", () => {
    fetch("/cart/clear", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.status === "success") {
                cart = {};
                updateCartUI(cart);
            } else {
                alert("Failed to clear cart.");
            }
        });
});

let currentTotal = 0;

function openCashModal() {
    currentTotal = parseFloat(
        document.getElementById("total").textContent.replace("$", "")
    );
    document.getElementById(
        "cash-total"
    ).textContent = `$${currentTotal.toFixed(2)}`;
    document.getElementById("cash-received").value = "";
    document.getElementById("cash-change").textContent = "$0.00";
    document.getElementById("cashModal").classList.remove("hidden");
}
function closeCashModal() {
    document.getElementById("cashModal").classList.add("hidden");
}
function openQRModal() {
    currentTotal = parseFloat(
        document.getElementById("total").textContent.replace("$", "")
    );
    document.getElementById("qr-total").textContent = `$${currentTotal.toFixed(
        2
    )}`;
    document.getElementById("qrModal").classList.remove("hidden");
}
function closeQRModal() {
    document.getElementById("qrModal").classList.add("hidden");
}

function calculateChange() {
    const received = parseFloat(document.getElementById("cash-received").value);
    if (isNaN(received)) {
        document.getElementById("cash-change").textContent = "$0.00";
        return;
    }

    const change = received - currentTotal;
    document.getElementById("cash-change").textContent = `$${(change >= 0
        ? change
        : 0
    ).toFixed(2)}`;
}

function submitCashPayment() {
    const received = parseFloat(document.getElementById("cash-received").value);
    if (isNaN(received) || received < currentTotal) {
        alert("Not enough cash received.");
        return;
    }
    const change = received - currentTotal;
    showLoading();

    fetch("/checkout/cash", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            total: currentTotal,
            cash_received: received,
            change: change,
            cart: cart, // This should be an array of items
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            hideLoading();
            console.log("Server response:", data); // For debugging
            if (data.status === "success") {
                cart = {};
                updateCartUI(cart);
                closeCashModal();
                let cartArray = Array.isArray(data.cart)
                    ? data.cart
                    : Object.values(data.cart || {});
                showReceiptModal(cartArray, data.subtotal, data.discount || 0);
            } else {
                alert("Payment failed.");
            }
        })
        .catch((err) => {
            hideLoading(); // Ensure it hides even on error
            alert("Server error.");
            console.error(err);
        });
}

function submitQRPayment() {
    showLoading();
    fetch("/checkout/qr", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            total: currentTotal,
            cart: cart, // assuming cart is defined globally
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            hideLoading();
            console.log("Server response:", data);
            if (data.status === "success") {
                cart = {};
                updateCartUI(cart);
                closeQRModal(); // You can rename to closeQRModal() for clarity
                let cartArray = Array.isArray(data.cart)
                    ? data.cart
                    : Object.values(data.cart || {});
                showReceiptModal(cartArray, data.subtotal, data.discount || 0);
            } else {
                alert("QR Payment failed.");
            }
        })
        .catch((err) => {
            hideLoading();
            console.error("Error in QR Payment:", err);
            alert("An error occurred during QR Payment.");
        });
}

function showReceiptModal(cartItems, subtotal, discount = 0) {
    console.log("Showing receipt with:", cartItems, subtotal, discount);
    document.getElementById("receipt-number").innerText = Math.floor(
        10000 + Math.random() * 90000
    );

    const now = new Date();
    document.getElementById("receipt-date-time").innerText =
        now.toLocaleString();

    const receiptItems = document.getElementById("receipt-items");
    receiptItems.innerHTML = "";

    let total = 0;
    cartItems.forEach((item) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        const row = document.createElement("div");
        row.className = "flex justify-between text-sm mb-1";
        row.innerHTML = `<span>${item.name} x${
            item.quantity
        }</span><span>$${itemTotal.toFixed(2)}</span>`;
        receiptItems.appendChild(row);
    });

    const tax = total * 0.1;
    const finalTotal = total + tax - discount;

    document.getElementById("receipt-subtotal").innerText = `$${total.toFixed(
        2
    )}`;
    document.getElementById("receipt-tax").innerText = `$${tax.toFixed(2)}`;
    document.getElementById(
        "receipt-discount"
    ).innerText = `$${discount.toFixed(2)}`;
    document.getElementById("receipt-total").innerText = `$${finalTotal.toFixed(
        2
    )}`;

    document.getElementById("receipt-modal").classList.remove("hidden");
}

document.getElementById("close-receipt-modal").addEventListener("click", () => {
    document.getElementById("receipt-modal").classList.add("hidden");
});

document.getElementById("print-receipt").onclick = () => {
    window.print();
};

document.getElementById("new-sale-from-receipt").onclick = () => {
    document.getElementById("receipt-modal").classList.add("hidden");
};

function showLoading() {
    document.getElementById("loading-overlay").classList.remove("hidden");
}

function hideLoading() {
    document.getElementById("loading-overlay").classList.add("hidden");
}

let targetFormId = "";
let targetAction = "";

function requestPin(formId, actionUrl) {
    targetFormId = formId;
    targetAction = actionUrl;
    document.getElementById("pinInput").value = "";
    document.getElementById("pinError").style.display = "none";
    const pinModal = new bootstrap.Modal(document.getElementById("pinModal"));
    pinModal.show();
}

// Add event listener to the search input
document.getElementById('search').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const productCards = document.querySelectorAll('.product-cards-container .bg-light');

    productCards.forEach(card => {
        const productName = card.querySelector('.product-text-container h1').textContent.toLowerCase();

        // Show or hide product card based on search term
        if (productName.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Debounce function to limit how often the search runs
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Search function
const searchProducts = debounce(function(searchTerm) {
    const productCards = document.querySelectorAll('.product-cards-container .bg-light');

    productCards.forEach(card => {
        const productName = card.querySelector('.product-text-container h1').textContent.toLowerCase();

        if (productName.includes(searchTerm.toLowerCase())) {
            card.style.display = 'block';
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
        } else {
            card.style.display = 'none';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
        }
    });
}, 300);

// Add event listener to search input
document.getElementById('search').addEventListener('input', function(e) {
    searchProducts(e.target.value);
});

// Optional: Clear search on button click (if you want to add a clear button)
const clearSearch = () => {
    const searchInput = document.getElementById('search');
    searchInput.value = '';
    searchProducts('');
};

// If you want to add a clear button, add this to your HTML:
/*
<button onclick="clearSearch()" class="absolute right-3 top-3 text-gray-400">
    <i class="fas fa-times"></i>
</button>
*/
