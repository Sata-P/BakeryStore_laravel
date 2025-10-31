<?php

namespace App\Http\Controllers;

use App\Models\CartItem; // 👈 เพิ่ม use
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 👈 เพิ่ม use

class CheckoutController extends Controller
{
    /**
     * แสดงหน้า Checkout
     */
    public function index()
    {
        $cartItems = CartItem::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cartpage.index')->with('error', 'ตะกร้าของคุณว่างเปล่า');
        }

        // 1. คำนวณราคาก่อนลด (Subtotal)
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        // 2. ตรวจสอบคูปองและคำนวณส่วนลด
        $coupon = session('coupon');
        $discount = 0;
        $total = $subtotal;

        if ($coupon) {
            if ($coupon->type == 'percent') {
                $discount = $subtotal * ($coupon->value / 100);
            } else {
                $discount = $coupon->value;
            }

            if ($discount > $subtotal) {
                $discount = $subtotal;
            }
            
            $total = $subtotal - $discount;
        }

        // 3. ส่งข้อมูลทั้งหมดไปที่ View
        return view('checkoutpage.index', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal, // 👈 ส่ง subtotal
            'discount' => $discount, // 👈 ส่ง discount
            'coupon' => $coupon,     // 👈 ส่ง coupon (ถ้ามี)
            'total' => $total,       // 👈 ส่ง total (หลังลด)
        ]);
    }
}