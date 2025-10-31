<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Coupon; // 👈 เพิ่ม use ที่ด้านบนไฟล์
use Carbon\Carbon;     // 👈 เพิ่ม use ที่ด้านบนไฟล์
use App\Models\Product;   // ✅ ต้องมี


class CartController extends Controller
{
    /**
     * แสดงหน้าตะกร้าสินค้า
     */
    public function index()
    {
        $cartItems = \App\Models\CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();
        return view('cartpage.index', ['cartItems' => $cartItems]);
    }

    public function store(Request $request)
    {
        // 1. ตรวจสอบว่ามี product_id ส่งมาจริง
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        // 2. เช็คว่ามีสินค้านี้ในตะกร้าของ User นี้ "อยู่แล้ว" หรือไม่
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // ถ้ามีอยู่แล้ว => ให้บวกจำนวน (quantity) เพิ่ม 1
            $cartItem->increment('quantity');
        } else {
            // ถ้ายังไม่มี => ให้สร้างรายการใหม่
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        // 3. เสร็จแล้วให้ Redirect กลับไปหน้าตะกร้า
        return redirect()->route('cartpage.index')->with('success', 'เพิ่มสินค้าลงในตะกร้าแล้ว!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        // 1. ตรวจสอบก่อนว่า User นี้เป็นเจ้าของตะกร้ารายการนี้จริง
        if ($cartItem->user_id != Auth::id()) {
            return abort(403);
        }

        // 2. ตรวจสอบข้อมูลที่ส่งมา (ต้องเป็นตัวเลข และอย่างน้อย 1)
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // 3. อัปเดตจำนวน
        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cartpage.index')->with('success', 'อัปเดตจำนวนสินค้าแล้ว!');
    }

    /**
     * ลบสินค้าออกจากตะกร้า
     */
    public function destroy(CartItem $cartItem)
    {
        // 1. ตรวจสอบเจ้าของ
        if ($cartItem->user_id != Auth::id()) {
            return abort(403);
        }

        // 2. ลบ
        $cartItem->delete();

        return redirect()->route('cartpage.index')->with('success', 'ลบสินค้าออกจากตะกร้าแล้ว!');
    }



    public function applyCoupon(Request $request)
    {
        // 1. ตรวจสอบ code
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        // 2. Validation
        if (!$coupon) {
            return redirect()->route('cartpage.index')->with('error', 'Coupon code ไม่ถูกต้อง!');
        }
        if (!$coupon->is_active) {
            return redirect()->route('cartpage.index')->with('error', 'Coupon นี้ไม่สามารถใช้งานได้');
        }
        if ($coupon->start_date && $coupon->start_date->isFuture()) {
            return redirect()->route('cartpage.index')->with('error', 'Coupon นี้ยังไม่เริ่มใช้งาน');
        }
        if ($coupon->end_date && $coupon->end_date->isPast()) {
            return redirect()->route('cartpage.index')->with('error', 'Coupon นี้หมดอายุแล้ว');
        }

        // 3. ถ้าผ่านหมด ให้เก็บลง Session
        session(['coupon' => $coupon]);

        return redirect()->route('cartpage.index')->with('success', 'ใช้ Coupon สำเร็จ!');
    }

    /**
     * ลบคูปองออก
     */
    public function removeCoupon()
    {
        session()->forget('coupon');
        return redirect()->route('cartpage.index')->with('success', 'ลบ Coupon ออกแล้ว');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        // ถ้ามีสินค้าอยู่ในตะกร้าแล้ว → เพิ่มจำนวน
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('prod_id', $product->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'prod_id' => $product->product_id,
                'quantity' => 1,
                'unit_price' => $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'เพิ่มสินค้าลงตะกร้าเรียบร้อยแล้ว!');
    }
}
