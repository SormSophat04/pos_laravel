<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="{{asset('css/product.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
</head>
<body class="bg-gray-50">
<div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-indigo-600 text-white shadow-lg">
        <div
            class="container mx-auto px-4 py-4 flex justify-between items-center"
        >
            <div class="flex items-center space-x-2">
                <i class="fas fa-cash-register text-2xl"></i>
                <h1 class="text-2xl font-bold">Modern POS</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="bg-indigo-500 px-3 py-1 rounded-full">
                    <span id="current-time" class="font-medium">00:00:00</span>
                </div>
                <div class="bg-indigo-500 px-3 py-1 rounded-full">
                    <span id="current-date" class="font-medium">Jan 1, 2023</span>
                </div>
                <button type="submit"
                        id="new-transaction"
                        class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition"
                >
                    <i class="fas fa-user-plus mr-2"></i>Add Cashier
                </button>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit"
                        id="new-transaction"
                        class="bg-danger text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition"
                    >
                        Logout<i class="fas fa-right-from-bracket ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main
        class="flex-1 container mx-auto px-4 py-6 flex flex-col lg:flex-row gap-6"
    >
        <!-- Products Section -->
        <section class="lg:w-2/3">
            <div class="bg-white rounded-xl shadow-md p-4 mb-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Products</h2>
                    <div class="relative w-64">
                        <input
                            type="text"
                            id="product-search"
                            placeholder="Search products..."
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                        <i
                            class="fas fa-search absolute left-3 top-3 text-gray-400"
                        ></i>
                    </div>
                </div>

                <!-- Categories -->
                <div class="flex space-x-2 mb-4 overflow-x-auto pb-2">
                    <button
                        class="category-btn px-4 py-1 rounded-full bg-indigo-600 text-white"
                        data-category="all"
                    >
                        All
                    </button>
                    <button
                        class="category-btn px-4 py-1 rounded-full bg-gray-200 hover:bg-gray-300"
                        data-category="electronics"
                    >
                        Electronics
                    </button>
                    <button
                        class="category-btn px-4 py-1 rounded-full bg-gray-200 hover:bg-gray-300"
                        data-category="clothing"
                    >
                        Clothing
                    </button>
                    <button
                        class="category-btn px-4 py-1 rounded-full bg-gray-200 hover:bg-gray-300"
                        data-category="groceries"
                    >
                        Groceries
                    </button>
                    <button
                        class="category-btn px-4 py-1 rounded-full bg-gray-200 hover:bg-gray-300"
                        data-category="home"
                    >
                        Home
                    </button>
                </div>

                <!-- Product Grid -->
                <divreceipt
                    id="products-grid"
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 overflow-y-auto max-h-[calc(100vh-220px)]"
                >
                    <!-- Products will be loaded here by JavaScript -->
                    <div class="card shadow-sm rounded-4" style="width: 220px; height: 300px">
                        <div class="ratio ratio-4x3 rounded-top-4 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bGFwdG9wfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" class="w-100 h-100 object-fit-cover" alt="Smartphone">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">Smartphone</h5>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold text-primary fs-5">$799.99</span>
                                <span class="text-muted">8 in stock</span>
                            </div>
                            <button class="btn btn-primary w-100">
                                <i class="bi bi-cart-plus me-2"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </divreceipt>
            </div>
        </section>

        <!-- Cart Section -->
        <section class="lg:w-1/3">
            <div class="bg-white rounded-xl shadow-md p-4 sticky top-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Current Order</h2>
                    <span
                        id="item-count"
                        class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-sm"
                    >0 items</span
                    >
                </div>

                <!-- Cart Items -->
                <div
                    id="cart-items"
                    class="mb-4 max-h-96 overflow-y-auto border-b border-gray-200"
                >
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-shopping-cart text-4xl mb-2"></i>
                        <p>Your cart is empty</p>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span id="subtotal" class="font-medium">$0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax (10%):</span>
                        <span id="tax" class="font-medium">$0.00</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-2">
                        <span class="text-gray-800 font-semibold">Total:</span>
                        <span id="total" class="text-xl font-bold text-indigo-600"
                        >$0.00</span
                        >
                    </div>
                </div>

                <!-- Payment Buttons -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <button
                        id="cash-payment"
                        class="bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center"
                    >
                        <i class="fas fa-money-bill-wave mr-2"></i> Cash
                    </button>
                    <button
                        id="card-payment"
                        class="bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center"
                    >
                        <i class="fas fa-credit-card mr-2"></i> Card
                    </button>
                </div>

                <!-- Discount Input -->
                <div class="mb-4">
                    <label
                        for="discount"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >Discount</label
                    >
                    <div class="flex">
                        <input
                            type="number"
                            id="discount"
                            placeholder="0"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                        <select
                            id="discount-type"
                            class="border border-gray-300 rounded-r-lg px-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            <option value="percent">%</option>
                            <option value="fixed">$</option>
                        </select>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label
                        for="order-notes"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >Order Notes</label
                    >
                    <textarea
                        id="order-notes"
                        rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    ></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-3">
                    <button
                        id="clear-cart"
                        class="bg-gray-200 text-gray-800 py-2 rounded-lg font-medium hover:bg-gray-300 transition"
                    >
                        <i class="fas fa-trash-alt mr-2"></i> Clear
                    </button>
                    <button
                        id="checkout"
                        class="bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition"
                    >
                        <i class="fas fa-paper-plane mr-2"></i> Checkout
                    </button>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Payment Modal -->
<div
    id="payment-modal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden"
>
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold" id="payment-method-title">
                    Cash Payment
                </h3>
                <button
                    id="close-payment-modal"
                    class="text-gray-500 hover:text-gray-700"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-gray-600">Total Amount:</p>
                    <p id="payment-total" class="text-2xl font-bold text-indigo-600">
                        $0.00
                    </p>
                </div>

                <div id="cash-payment-section">
                    <label
                        for="amount-received"
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >Amount Received</label
                    >
                    <input
                        type="number"
                        id="amount-received"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    />

                    <div class="mt-2">
                        <p class="text-gray-600">Change:</p>
                        <p
                            id="change-amount"
                            class="text-xl font-medium text-green-600"
                        >
                            $0.00
                        </p>
                    </div>
                </div>

                <div id="card-payment-section" class="hidden">
                    <div class="space-y-3">
                        <div>
                            <label
                                for="card-number"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >Card Number</label
                            >
                            <input
                                type="text"
                                id="card-number"
                                placeholder="1234 5678 9012 3456"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            />
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label
                                    for="expiry-date"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                >Expiry Date</label
                                >
                                <input
                                    type="text"
                                    id="expiry-date"
                                    placeholder="MM/YY"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                            </div>
                            <div>
                                <label
                                    for="cvv"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                >CVV</label
                                >
                                <input
                                    type="text"
                                    id="cvv"
                                    placeholder="123"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button
                        id="complete-payment"
                        class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition"
                    >
                        <i class="fas fa-check-circle mr-2"></i> Complete Payment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Receipt Modal -->
<div
    id="receipt-modal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden"
>
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Receipt</h3>
                <div class="flex space-x-2">
                    <button
                        id="print-receipt"
                        class="text-gray-500 hover:text-indigo-600"
                    >
                        <i class="fas fa-print"></i>
                    </button>
                    <button
                        id="close-receipt-modal"
                        class="text-gray-500 hover:text-gray-700"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div
                id="receipt-content"
                class="receipt p-4 border border-dashed border-gray-300 mb-4"
            >
                <div class="text-center mb-4">
                    <h2 class="text-xl font-bold">MODERN POS</h2>
                    <p class="text-sm text-gray-600">123 Business Street, City</p>
                    <p class="text-sm text-gray-600">Tel: (123) 456-7890</p>
                </div>

                <div class="text-center mb-4">
                    <p class="text-sm">
                        Receipt #<span id="receipt-number">00001</span>
                    </p>
                    <p class="text-sm" id="receipt-date-time">Jan 1, 2023 12:00 PM</p>
                </div>

                <div class="border-t border-b border-gray-300 py-2 mb-4">
                    <div class="flex justify-between font-medium">
                        <span>ITEM</span>
                        <span>TOTAL</span>
                    </div>
                </div>

                <div id="receipt-items">
                    <!-- Items will be added here -->
                </div>

                <div class="border-t border-gray-300 pt-2 mt-4">
                    <div class="flex justify-between mb-1">
                        <span>Subtotal:</span>
                        <span id="receipt-subtotal">$0.00</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span>Tax (10%):</span>
                        <span id="receipt-tax">$0.00</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span>Discount:</span>
                        <span id="receipt-discount">$0.00</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg mt-2">
                        <span>TOTAL:</span>
                        <span id="receipt-total">$0.00</span>
                    </div>
                </div>

                <div class="text-center mt-6 pt-4 border-t border-gray-300">
                    <p class="text-sm text-gray-600">Thank you for your purchase!</p>
                    <p class="text-xs text-gray-500 mt-2">
                        Items can be returned within 14 days with receipt
                    </p>
                </div>
            </div>

            <div class="flex justify-center">
                <button
                    id="new-sale-from-receipt"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition"
                >
                    <i class="fas fa-receipt mr-2"></i> New Sale
                </button>
            </div>
        </div>
    </div>
</div>
</body>
{{--<script src="{{asset('js/product.js')}}"></script>--}}
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
</html>
