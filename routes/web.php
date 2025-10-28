<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('homepage');
});


Route::get('/cartpage', function () {
    return view('cartpage.index');
})->middleware('auth');

Route::get('/productpage', [ProductController::class, 'index'])->name('productpage.index');


Route::get('/checkoutpage', function () {
    // (ในอนาคต: ดึงข้อมูลตะกร้า, ที่อยู่ลูกค้า ฯลฯ)
    return view('checkoutpage.index');
})->middleware('auth')->name('checkout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cartpage', [CartController::class, 'index'])->name('cartpage.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    // 👇 สำหรับอัปเดตจำนวน (+ / -)
    Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    // 👇 สำหรับลบสินค้า (ปุ่ม Remove)
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::get('/checkoutpage', [CheckoutController::class, 'index'])->name('checkoutpage.index');

    Route::post('/coupon/apply', [CartController::class, 'applyCoupon'])->name('coupon.apply');
    Route::post('/coupon/remove', [CartController::class, 'removeCoupon'])->name('coupon.remove');
});


require __DIR__ . '/auth.php';
