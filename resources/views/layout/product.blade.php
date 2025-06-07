@extends('layout.app')

@section('product_section')
    <section class="lg:w-2/3">
        <div class="bg-white rounded-xl shadow-md p-4 mb-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ __('message.product') }}</h2>
                <div class="relative w-64">
                    <input type="text" id="search" placeholder="{{ __('message.search_product') }}..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Categories -->
            <div class="flex space-x-2 mb-4 overflow-x-auto pb-2">
                <form action="{{ route('product.view') }}" method="get">
                    @csrf
                    <input type="hidden" name="category" value="all">
                    <button
                        class="category-btn px-4 py-1 rounded-full @if (request('category') == 'all' || !request('category')) bg-indigo-600 text-white @else bg-gray-200 hover:bg-gray-300 @endif"
                        data-category="all">
                        {{ __('message.all') }}
                    </button>
                </form>

                <form action="{{ route('phone') }}" method="get">
                    @csrf
                    <input type="hidden" name="category" value="phone">
                    <button
                        class="category-btn px-4 py-1 rounded-full @if (request('category') == 'phone') bg-indigo-600 text-white @else bg-gray-200 hover:bg-gray-300 @endif"
                        data-category="electronics">
                        Phone
                    </button>
                </form>
                <form action="{{ route('laptop') }}" method="get">
                    @csrf
                    <input type="hidden" name="category" value="laptop">
                    <button
                        class="category-btn px-4 py-1 rounded-full @if (request('category') == 'laptop') bg-indigo-600 text-white @else bg-gray-200 hover:bg-gray-300 @endif"
                        data-category="clothing">
                        Laptop
                    </button>
                </form>
                <form action="{{ route('tablet') }}" method="get">
                    @csrf
                    <input type="hidden" name="category" value="tablet">
                    <button
                        class="category-btn px-4 py-1 rounded-full @if (request('category') == 'tablet') bg-indigo-600 text-white @else bg-gray-200 hover:bg-gray-300 @endif"
                        data-category="groceries">
                        Tablet
                    </button>
                </form>
                <form action="{{ route('watch') }}" method="get">
                    @csrf
                    <input type="hidden" name="category" value="watch">
                    <button
                        class="category-btn px-4 py-1 rounded-full @if (request('category') == 'watch') bg-indigo-600 text-white @else bg-gray-200 hover:bg-gray-300 @endif"
                        data-category="home">
                        Watch
                    </button>
                </form>
                <form action="{{ route('headphones') }}" method="get">
                    @csrf
                    <input type="hidden" name="category" value="headphones">
                    <button
                        class="category-btn px-4 py-1 rounded-full @if (request('category') == 'headphones') bg-indigo-600 text-white @else bg-gray-200 hover:bg-gray-300 @endif"
                        data-category="home">
                        Headphones
                    </button>
                </form>
            </div>

            <!-- Product Grid -->
            <div id="search-results" class="product-cards-container">
                <ul>
                    @foreach ($products as $product)
                        <div class="bg-light rounded-3 shadow text-start overflow-hidden"
                            style="width: 250px; margin-right: 29px; margin-left: 29px; margin-bottom: 30px; height: 379px; transition: 0.8s ease-in-out">
                            <div class="product-image-container">
                                <img src="{{ asset($product->image) }}" alt="Image?">
                            </div>
                            <div class="product-text-container">
                                <h1 class="mb-2">{{ $product->name }}</h1>
                                <p class="m-0">$ {{ $product->price }}</p>
                                <p class="text-danger">{{ $product->qty }} {{ __('message.in_stock') }}</p>
                                <div class="text-center mt-3">
                                    <button
                                        onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, {{ $product->qty }})"
                                        class="blue-button w-100"><i class="bi bi-cart-plus-fill fs-5"></i>
                                        {{ __('message.add_to_cart') }}</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>
@endsection

@section('cart_section')
    <section class="lg:w-1/3">
        <div class="bg-white rounded-xl shadow-md p-4 sticky top-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ __('message.current_order') }}</h2>
                <span id="total-items" class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-sm">0
                    {{ __('message.item') }}</span>
            </div>

            <!-- Cart Items -->
            <div id="cart-items" class="mb-4 max-h-96 overflow-y-auto border-b border-gray-200">
                <div id="cart-items" class="text-center py-8 text-gray-500">
                    <i class="fas fa-shopping-cart text-4xl mb-2"></i>
                    <p>{{ __('message.cart_empty') }}</p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="space-y-3 mb-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('message.subtotal') }}:</span>
                    <span id="subtotal" class="font-medium">$0.00</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('message.tax') }} (10%):</span>
                    <span id="tax" class="font-medium">$0.00</span>
                </div>
                <div class="flex justify-between border-t border-gray-200 pt-2">
                    <span class="text-gray-800 font-semibold">{{ __('message.total') }}:</span>
                    <span id="total" class="text-xl font-bold text-indigo-600">$0.00</span>
                </div>
            </div>

            <!-- Payment Buttons -->
            <div class="grid grid-cols-2 gap-3 mb-4">
                <button onclick="openCashModal()" id="cash-payment"
                    class="bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-2xl mr-2"></i> {{ __('message.cash') }}
                </button>
                <button onclick="openQRModal()" id="qr-payment"
                    class="bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center">
                    <i class="bi bi-phone text-2xl mr-2"></i> KHQR
                </button>
            </div>

            <!-- Discount Input -->
            {{-- <div class="mb-4">
                <label for="discount"
                    class="block text-sm font-medium text-gray-700 mb-1">{{ __('message.discount') }}</label>
                <div class="flex">
                    <input type="number" id="discount" placeholder="0"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    <select id="discount-type"
                        class="border border-gray-300 rounded-r-lg px-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="percent">%</option>
                        <option value="fixed">$</option>
                    </select>
                </div>
            </div> --}}

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 gap-3">
                <button id="clear-cart-btn"
                    class="bg-gray-200 text-gray-800 py-2 rounded-lg font-medium hover:bg-gray-300 transition">
                    <i class="fas fa-trash-alt mr-2"></i> {{ __('message.clear') }}
                </button>
                {{-- <button id="checkout"
                    class="bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                    <i class="fas fa-paper-plane mr-2"></i> {{ __('message.checkout') }}
                </button> --}}
            </div>
        </div>

        <!-- Cash Payment Modal -->
        <div id="cashModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg w-96 shadow-lg relative">
                <button onclick="closeCashModal()" class="absolute top-3 right-5 text-gray-500 fs-3">&times;</button>
                <h2 class="text-xl font-bold mb-4">Cash Payment</h2>
                <p>Total Amount: <span id="cash-total" class="font-bold text-blue-600">$0.00</span></p>

                <label class="block mt-4">Amount Received</label>
                <input id="cash-received" type="number"
                    class="w-full border px-3 py-2 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    oninput="calculateChange()">

                <p class="mt-4">Change: <span id="cash-change" class="font-bold text-green-600">$0.00</span></p>

                <button onclick="submitCashPayment()" class="mt-6 w-full bg-indigo-600 text-white py-2 rounded">
                    <i class="bi bi-check-circle-fill"></i> Complete Payment
                </button>
            </div>
        </div>
        <!-- QR Payment Modal -->
        <div id="qrModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg w-96 shadow-lg relative">
                <button onclick="closeQRModal()" class="absolute top-3 right-5 text-gray-500 fs-3">&times;</button>
                <h2 class="text-xl font-bold mb-4">QR Payment</h2>
                <div class="card khqr-card">
                    <div class="khqr-header">
                        KHQR
                    </div>
                    <div class="khqr-body">
                        <h5 class="mb-1 text-start fw-bold ms-4">SORM SOPHAT</h5>
                        <h3 id="qr-total" class="mb-3 ms-4 text-start fw-bold fs-4">$ 0</h3>
                        <div class="khqr-divider"></div>
                        <img src="{{ asset('images/qr.png') }}" alt="QR Code" class="qr-img">
                    </div>
                </div>
                <button onclick="submitQRPayment()" class="mt-6 w-full bg-indigo-600 text-white py-2 rounded">
                    <i class="bi bi-check-circle-fill"></i> Complete Payment
                </button>
            </div>
        </div>

        <div id="loading-overlay"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="text-green-500 text-xl font-semibold">
                <dotlottie-player src="https://lottie.host/a4bf4032-0894-4474-b272-8f77e1c0b460/NT6pXJpnQz.lottie"
                    background="transparent" speed="1" style="width: 300px; height: 300px" loop
                    autoplay></dotlottie-player>
            </div>
        </div>

        <!-- Receipt Modal -->
        <div id="receipt-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Receipt</h3>
                        <div class="flex space-x-2">

                            <button id="close-receipt-modal" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times fs-3"></i>
                            </button>
                        </div>
                    </div>

                    <div id="receipt-content" class="receipt p-4 border border-dashed border-gray-300 mb-4">
                        <div class="text-center mb-4">
                            <h2 class="text-xl font-bold">AMAZON POS</h2>
                            <p class="text-sm text-gray-600">123 Business 03, Street, Phnom Penh</p>
                            <p class="text-sm text-gray-600">Tel: (+855) 99-999-999</p>
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
                            <p class="text-sm text-gray-600 mt-2">Powered by Sorm Sophat</p>
                        </div>
                    </div>

                    <div class="flex justify-center gap-2">
                        <button id="print-receipt"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                            <i class="fas fa-print mr-2"></i> Print Now
                        </button>
                        <button id="new-sale-from-receipt"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                            <i class="fas fa-receipt mr-2"></i> New Sale
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .khqr-card {
                max-width: 360px;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            }

            .khqr-header {
                background-color: #e60012;
                color: white;
                padding: 1rem;
                font-size: 1.5rem;
                font-weight: bold;
                text-align: center;
            }

            .khqr-body {
                padding: 1.5rem;
                text-align: center;
            }

            .khqr-divider {
                border-top: 1px dashed #ccc;
                margin: 1rem 0;
            }

            .qr-img {
                width: 100%;
                max-width: 260px;
                margin: auto;
            }
        </style>
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    </section>
@endsection
