@extends('layouts.app')

@section('content')

    {{-- แสดงข้อความ Success (อันเดิม) --}}
    @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="p-4 bg-green-100 text-green-700 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- 👇 1. เพิ่มกล่อง Error (สำหรับคูปองผิด) 👇 --}}
    @if (session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="p-4 bg-red-100 text-red-700 border border-red-300 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Header "Shopping Cart" (อันเดิม) --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Shopping Cart') }}
            </h2>
        </div>
    </header>

    {{-- ส่วนเนื้อหาหลัก (อันเดิม) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($cartItems->isEmpty())
                        <p>Your cart is empty.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 mt-4">
                            <thead class="bg-gray-50">
                                {{-- ... (thead
                                    / ส่วนหัวตาราง ... เหมือนเดิม) ... --}}
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Product</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Quantity</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Price</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Total</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @php $total = 0; @endphp
                                @foreach ($cartItems as $item)
                                    @php $itemTotal = $item->product->price * $item->quantity;
                                    $total += $itemTotal; @endphp
                                    {{-- ... (tr / แถวของสินค้า ... เหมือนเดิม) ... --}}
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $item->product->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                            <div class="flex items-center">
                                                <form action="{{ route('cart.update', ['cartItem' => $item->cart_item_id]) }}" method="POST">
                                                    class="m-0">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="quantity"
                                                        value="{{ $item->quantity - 1 }}">
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-l font-bold disabled:opacity-50"
                                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                        -
                                                    </button>
                                                </form>
                                                <span
                                                    class="px-4 py-1 bg-white border-t border-b border-gray-200">{{ $item->quantity }}</span>
                                                <form action="{{ route('cart.update', ['cartItem' => $item->cart_item_id]) }}" method="POST">

                                                    class="m-0">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="quantity"
                                                        value="{{ $item->quantity + 1 }}">
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-r font-bold">
                                                        +
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                            ${{ number_format($item->product->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                            ${{ number_format($itemTotal, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('cart.remove', ['cartItem' => $item->cart_item_id]) }}" method="POST">
 
                                                class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            {{-- 👇 2. อัปเกรด tfoot (ส่วนสรุปราคา) 👇 --}}
                            <tfoot class="border-t border-gray-200">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-700">Subtotal:</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">${{ number_format($total, 2) }}</td>
                                    <td></td>
                                </tr>

                                {{-- ตรวจสอบว่ามีคูปองใน session หรือไม่ --}}
                                @if ($coupon = session('coupon'))
                                    @php
                                        // คำนวณส่วนลด
                                        if ($coupon->type == 'percent') {
                                            $discount = $total * ($coupon->value / 100);
                                        } else {
                                            $discount = $coupon->value;
                                        }
                                        // ป้องกันส่วนลดมากกว่าราคารวม
                                        if ($discount > $total) {
                                            $discount = $total;
                                        }
                                        $newTotal = $total - $discount;
                                    @endphp
                                    <tr class="text-green-600">
                                        <td colspan="3" class="px-6 py-4 text-right font-medium">Discount
                                            ({{ $coupon->code }}):</td>
                                        <td class="px-6 py-4 font-medium">-${{ number_format($discount, 2) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr class="font-bold border-t-2 border-gray-300">
                                        <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-900">Grand Total:
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            ${{ number_format($newTotal, 2) }}</td>
                                        <td></td>
                                    </tr>
                                @else
                                    {{-- ถ้าไม่มีคูปอง --}}
                                    <tr class="font-bold border-t-2 border-gray-300">
                                        <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-900">Grand Total:
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900">${{ number_format($total, 2) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                @endif
                            </tfoot>
                        </table>

                        {{-- 👇 3. อัปเกรดส่วน Coupon/Checkout (คงตำแหน่งเดิมไว้) 👇 --}}
                        <div class="mt-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="w-full md:w-1/2">

                                {{-- ถ้ามีคูปองใน Session --}}
                                @if (session('coupon'))
                                    <div class="text-center md:text-left">
                                        <p class="text-sm font-medium text-gray-700">Coupon Applied:</p>
                                        <div
                                            class="mt-1 flex items-center justify-center md:justify-start gap-2">
                                            <span
                                                class="inline-flex items-center rounded-md bg-green-100 px-3 py-1 text-lg font-medium text-green-700">{{ session('coupon')->code }}</span>
                                            {{-- ฟอร์มสำหรับลบคูปอง --}}
                                            <form action="{{ route('coupon.remove') }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit"
                                                    class="text-sm text-red-500 hover:text-red-700 underline">Remove</button>
                                            </form>
                                        </div>
                                    </div>

                                {{-- ถ้าไม่มีคูปอง (ใช้ฟอร์มที่คุณชอบ) --}}
                                @else
                                    <form action="{{ route('coupon.apply') }}" method="POST">
                                        @csrf
                                        <label for="coupon_code"
                                            class="block text-sm font-medium text-gray-700 text-center md:text-left">Coupon
                                            Code</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="coupon_code" id="coupon_code"
                                                class="flex-1 block w-full rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-gray-800 placeholder-gray-400 p-2"
                                                placeholder="Enter your coupon" required>
                                            <button type="submit"
                                                class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Apply
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>

                            <!-- ส่วนปุ่ม Checkout (อยู่ขวา, เหมือนเดิม) -->
                            <div class="w-full md:w-auto mt-4 md:mt-0">
                                <a href="{{ route('checkoutpage.index') }}"
                                    class="flex w-full md:w-auto items-center justify-center rounded-md border border-transparent bg-green-600 px-12 py-3 text-base font-medium text-white shadow-sm hover:bg-green-700">
                                    Checkout
                                </a>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection