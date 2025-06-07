<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleItemExportController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return view('auth.index');
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('guest')->controller(UserController::class)->group(function () {
    Route::get('/login', [UserController::class, 'showLogin'])->name('show.login');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/change', [LanguageController::class, 'change'])->name('change.language');
    Route::get('/register', [UserController::class, 'showRegister'])->name('show.register');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::resource('users', UserController::class);


    //    ===> Product
    Route::get('/product', [ProductController::class, 'getToPos'])->name('product.view');

    Route::get('/product/add', [ProductController::class, 'index'])->name('product.show');
    Route::post('/product/add', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/product/add/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.showup');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/search', [ProductController::class, 'search']);
    Route::get('/product/phone', [ProductController::class, 'getPhone'])->name('phone');
    Route::get('/product/laptop', [ProductController::class, 'getLaptop'])->name('laptop');
    Route::get('/product/tablet', [ProductController::class, 'getTablet'])->name('tablet');
    Route::get('/product/watch', [ProductController::class, 'getWatch'])->name('watch');
    Route::get('/product/headphones', [ProductController::class, 'getHeadphones'])->name('headphones');
    Route::get('/dashboard', [ProductController::class, 'getStock'])->name('stocks');
    Route::get('/products/search', [ProductController::class, 'search'])->name('product.search');

    //    ===> Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'getOrders'])->name('orders');

    //    ===> Add To Cart
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::post('/cart/increase', [CartController::class, 'increase']);
    Route::post('/cart/decrease', [CartController::class, 'decrease']);
    Route::post('/cart/remove', [CartController::class, 'remove']);
    Route::get('/cart/get', [CartController::class, 'getCart']);
    Route::post('/cart/clear', [CartController::class, 'clearCart']);
    Route::post('/cart/search', [CartController::class, 'search']);
    Route::post('/cart/remove', [CartController::class, 'removeCart']);

    //   ===> Checkout
    Route::post('/checkout/cash', [CheckoutController::class, 'cashCheckout'])->middleware('auth');
    Route::post('/checkout/qr', [CheckoutController::class, 'qrPayment']);

    Route::get('/export-sale-items', [SaleItemExportController::class, 'export'])->name('export.sale.items');
});
