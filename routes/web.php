<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// ✅ Route ที่ไม่ต้อง login
Route::get('/productpage', [ProductController::class, 'index'])->name('productpage.index');

Route::middleware('auth')->group(function () {
    // ✅ Cart routes
    Route::get('/cartpage', [CartController::class, 'index'])->name('cartpage.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.remove');

    // ✅ Checkout + Orders
    Route::get('/checkoutpage', [CheckoutController::class, 'index'])->name('checkoutpage.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/success/{order}', [OrderController::class, 'success'])
    ->middleware('auth')
    ->name('order.success');


    // ✅ Coupon
    Route::post('/coupon/apply', [CartController::class, 'applyCoupon'])->name('coupon.apply');
    Route::post('/coupon/remove', [CartController::class, 'removeCoupon'])->name('coupon.remove');

    // ✅ Reviews
    Route::post('/products/{product}/reviews', [ProductController::class, 'storeReview'])->name('products.reviews.store');

    // ✅ Profile & Dashboard
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');
});

require __DIR__ . '/auth.php';
