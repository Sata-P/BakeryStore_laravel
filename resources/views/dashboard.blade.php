@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-card p-8 text-center">
        <h1 class="text-3xl font-extrabold text-cocoa-900 mb-3">
            🎉 ยินดีต้อนรับ {{ Auth::user()->name ?? 'ลูกค้า' }} !
        </h1>
        <p class="text-slate-600 mb-8">
            คุณได้เข้าสู่ระบบเรียบร้อยแล้ว  
            สามารถเริ่มต้นช้อปขนมอร่อย ๆ หรือดูคำสั่งซื้อของคุณได้เลย
        </p>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ url('/products') }}" 
               class="px-6 py-3 bg-cocoa-900 text-white rounded-xl shadow-soft hover:bg-cocoa-800">
               🛍️ ดูสินค้าทั้งหมด
            </a>
            <a href="{{ url('/cartpage') }}" 
               class="px-6 py-3 bg-cream-100 text-cocoa-900 border border-cocoa-200 rounded-xl hover:bg-cream-200">
               🧺 ไปยังตะกร้าสินค้า
            </a>
        </div>
    </div>

    {{-- แนะนำสินค้า --}}
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-cocoa-900 mb-6 text-center">ขนมแนะนำของเรา 🍞</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-card p-5 text-center">
                <img src="{{ asset('imgs/cake.jpg') }}" class="w-24 h-24 mx-auto rounded-full mb-3" alt="Cake">
                <h3 class="font-semibold text-lg">เค้กวนิลาเนื้อนุ่ม</h3>
                <p class="text-sm text-slate-600 mt-1">หอมหวานอบสดใหม่ทุกวัน</p>
            </div>
            <div class="bg-white rounded-xl shadow-card p-5 text-center">
                <img src="{{ asset('imgs/bread.jpg') }}" class="w-24 h-24 mx-auto rounded-full mb-3" alt="Bread">
                <h3 class="font-semibold text-lg">ขนมปังเนยสด</h3>
                <p class="text-sm text-slate-600 mt-1">กรอบนอก นุ่มใน อร่อยลงตัว</p>
            </div>
            <div class="bg-white rounded-xl shadow-card p-5 text-center">
                <img src="{{ asset('imgs/cookie.jpg') }}" class="w-24 h-24 mx-auto rounded-full mb-3" alt="Cookie">
                <h3 class="font-semibold text-lg">คุกกี้ช็อกโกแลตชิพ</h3>
                <p class="text-sm text-slate-600 mt-1">หวานกรุบกรอบ ถูกใจทุกวัย</p>
            </div>
        </div>
    </div>
</div>
@endsection
