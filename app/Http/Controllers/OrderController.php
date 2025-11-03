<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // 👈 1. เพิ่ม use DB


class OrderController extends Controller
{
    /**
     * บันทึกคำสั่งซื้อ (Place Order)
     */
    public function store(Request $request) // 👈 นี่คือฟังก์ชันที่ Error หากไม่เจอ
    {
        // 2. ดึงข้อมูลจำเป็น
        $user = Auth::user();
        $cartItems = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        // 3. (Validation) ถ้าตะกร้าว่าง ให้เด้งกลับ
        if ($cartItems->isEmpty()) {
            return redirect()->route('cartpage.index')->with('error', 'ตะกร้าของคุณว่างเปล่า');
        }

        // 4. (Validation) ตรวจสอบข้อมูลที่อยู่ (จากฟอร์ม)
        $request->validate([
            'phone_no' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // 5. คำนวณราคาทั้งหมด (อีกครั้ง)
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        $coupon = session('coupon');
        $discount = 0;
        $total = $subtotal;
        $couponId = null;

        if ($coupon) {
            if ($coupon->type == 'percent') {
                $discount = $subtotal * ($coupon->value / 100);
            } else {
                $discount = $coupon->value;
            }
            if ($discount > $subtotal) $discount = $subtotal;

            $total = $subtotal - $discount;
            $couponId = $coupon->id;
        }


        try {
            DB::beginTransaction();


            $order = Order::create([
                'user_id' => $user->id,
                'coupon_id' => $couponId,
                'status' => 'processing',
                'total_amount' => $total,
                'shipping_name' => $user->name,
                'shipping_address' => $request->address,
                'shipping_phone' => $request->phone_no,
            ]);


            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->prod_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                ]);

    
                $product = $item->product; // ดึง Model Product ที่ถูกโหลดไว้แล้ว
                $product->decrement('stock_qty', $item->quantity);
            }

            CartItem::where('user_id', $user->id)->delete();


            session()->forget('coupon');


            DB::commit();


            return redirect()->route('order.success', $order->id)->with('success', 'สั่งซื้อสำเร็จ!');
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->route('checkoutpage.index')->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    /**
     * แสดงหน้า "สั่งซื้อสำเร็จ"
     */
    public function success(Order $order) // 👈 นี่คือฟังก์ชันสำหรับหน้า Thank You
    {
        // ตรวจสอบว่าเป็น Order ของ User นี้จริง
        if ($order->user_id != Auth::id()) {
            return redirect('/');
        }
        $order->load('items.product'); // optional
        return view('order.success', ['order' => $order]);
    }
}
