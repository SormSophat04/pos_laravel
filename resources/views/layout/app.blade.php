<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/product.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pro_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-indigo-600 text-white shadow-lg">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="bi bi-amazon fs-3"></i>
                    <h1 class="text-2xl font-bold">POS System</h1>
                </div>
                <div class="flex items-center space-x-2">

                    @if (Auth::user()->role == 'admin')
                        <form action="{{ route('orders') }}" method="get">
                            @csrf
                            <button type="submit" id="new-transaction"
                                class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition">
                                <i class="fas fa-window-restore mr-2"></i>{{ __('message.dashboard') }}
                            </button>
                        </form>
                        <!-- Add Product Button -->
                        <form action="{{ route('product.show') }}" method="get">
                            @csrf
                            <button type="submit"
                                class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition">
                                <i class="fas fa-box mr-2"></i>{{ __('message.add_product') }}
                            </button>
                        </form>

                        <!-- Add Cashier Button -->
                        <form action="{{ route('show.register') }}" method="get">
                            @csrf
                            <button type="submit"
                                class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition">
                                <i class="fas fa-user-plus mr-2"></i>{{ __('message.add_cashier') }}
                            </button>
                        </form>
                    @elseif (Auth::user()->role == 'cashier')
                        <form action="{{ route('product.view') }}" method="get">
                            @csrf
                            <button type="submit" id="new-transaction"
                                class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition">
                                <i class="fas fa-home-alt mr-2"></i>{{ __('message.home') }}
                            </button>
                        </form>
                        <form action="{{ route('orders') }}" method="get">
                            @csrf
                            <button type="submit" id="new-transaction"
                                class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition">
                                <i class="fas fa-window-restore mr-2"></i>{{ __('message.dashboard') }}
                            </button>
                        </form>
                    @endif
                </div>
                <div class="flex items-center space-x-4">
                    <div class="border-1 px-2 py-1 gap-3 rounded-4 border-indigo-500 d-flex align-items-center">
                        <a href="{{ route('change.language', ['lang' => 'en']) }}">
                            <img src="{{ asset('images/uk.png') }}" alt="" class="rounded-2 w-8 h-auto">
                        </a>
                        <a href="{{ route('change.language', ['lang' => 'kh']) }}">
                            <img src="{{ asset('images/kh.png') }}" alt="" class="rounded-2 w-8 h-auto">
                        </a>
                    </div>


                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" id="new-transaction"
                            class="bg-danger text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition">
                            {{ __('message.logout') }}<i class="fas fa-right-from-bracket ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 container mx-auto px-4 py-6 flex flex-col lg:flex-row gap-6">
            <!-- Products Section -->
            @yield('product_section')
            @yield('table')
            @yield('tables')
            @yield('content')
            @yield('dashboard_content')
            <!-- Cart Section -->
            @yield('cart_section')
            @yield('product_form')
            @yield('form_update')
            @yield('summary_content')
        </main>
    </div>

    <!-- Payment Modal -->


    <!-- Receipt Modal -->


    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
