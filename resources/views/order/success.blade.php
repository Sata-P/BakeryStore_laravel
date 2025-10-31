@extends('layouts.app')
@section('content')
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Confirmed
        </h2>
    </div>
</header>
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center p-12">
            
            {{-- ไอคอนติ๊กถูก (เหมือนเดิม) --}}
            <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            
            <h3 class="mt-4 text-2xl font-bold text-gray-900">Thank you for your order!</h3>
            <p class="mt-2 text-gray-600">
                คำสั่งซื้อของคุณหมายเลข #{{ $order->id }} ได้รับการยืนยันแล้ว
            </p>
            <p class="mt-1 text-gray-600">
                ยอดรวม: ${{ number_format($order->total_amount, 2) }}
            </p>

            <!-- 👇👇 นี่คือส่วน QR Code ที่แก้ไขแล้ว 👇👇 -->
            <div class="mt-8 border-t pt-8">
                <p class="text-lg font-medium text-gray-800">กรุณาสแกน QR Code นี้เพื่อชำระเงิน</p>
                <p class="text-sm text-gray-500">(สำหรับ PromtPay หรือช่องทางอื่นๆ)</p>
                
                {{-- เปลี่ยนมาใช้ QR Code จาก path /imgs/qr.jpg --}}
                {{-- (ต้องมั่นใจว่าไฟล์นี้อยู่ใน public/imgs/qr.jpg) --}}
                <img src="{{ asset('imgs/qr.jpg') }}" 
                     alt="Payment QR Code"
                     class="mx-auto mt-4 rounded-lg shadow-md w-[250px] h-[250px]"> {{-- เพิ่ม w/h ให้ขนาดคงที่ --}}
            </div>
            <!-- 👆👆 จบส่วน QR Code 👆👆 -->

            <div class="mt-8">
                <a href="/" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    กลับไปหน้าแรก
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
