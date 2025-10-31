@extends('layouts.app')

@section('content')
<div class="w-full max-w-md mx-auto bg-white shadow-card rounded-2xl p-8 mt-10">
    <h2 class="text-2xl font-bold text-center mb-6 text-cocoa-900">สมัครสมาชิก</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-slate-700">ชื่อ</label>
            <input id="name" class="w-full rounded-lg border border-slate-300 px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-cocoa-900"
                   type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-slate-700">อีเมล</label>
            <input id="email" class="w-full rounded-lg border border-slate-300 px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-cocoa-900"
                   type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-slate-700">รหัสผ่าน</label>
            <input id="password" class="w-full rounded-lg border border-slate-300 px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-cocoa-900"
                   type="password" name="password" required autocomplete="new-password">
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">ยืนยันรหัสผ่าน</label>
            <input id="password_confirmation" class="w-full rounded-lg border border-slate-300 px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-cocoa-900"
                   type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <!-- Address -->
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-slate-700">ที่อยู่</label>
            <input id="address" class="w-full rounded-lg border border-slate-300 px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-cocoa-900"
                   type="text" name="address" value="{{ old('address') }}">
        </div>

        <!-- Phone -->
        <div class="mb-6">
            <label for="phone" class="block text-sm font-medium text-slate-700">เบอร์โทรศัพท์</label>
            <input id="phone" class="w-full rounded-lg border border-slate-300 px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-cocoa-900"
                   type="text" name="phone" value="{{ old('phone') }}">
        </div>

        <!-- Register Button -->
        <div class="flex justify-between items-center">
            <a href="{{ route('login') }}" class="text-sm text-cocoa-900 hover:underline">เข้าสู่ระบบ</a>
            <button type="submit" class="bg-cocoa-900 text-white px-6 py-2 rounded-lg hover:bg-cocoa-800">
                สมัครสมาชิก
            </button>
        </div>
    </form>
</div>
@endsection
