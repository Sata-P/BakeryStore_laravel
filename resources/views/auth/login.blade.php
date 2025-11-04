@extends('layouts.app')

@section('content')
<div class="w-full max-w-md mx-auto bg-white shadow-card rounded-2xl p-8 mt-10">
    <h2 class="text-2xl font-bold text-center mb-6 text-cocoa-900">เข้าสู่ระบบ</h2>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-green-600 text-center font-medium">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-slate-700">อีเมล</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username"
                class="w-full mt-1 rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cocoa-900">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-slate-700">รหัสผ่าน</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full mt-1 rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cocoa-900">
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-4">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded border-gray-300 text-cocoa-900 shadow-sm focus:ring-cocoa-900">
            <label for="remember_me" class="ms-2 text-sm text-gray-700">จดจำฉันไว้</label>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-cocoa-900 hover:underline">
                    ลืมรหัสผ่าน?
                </a>
            @endif

            <a href="{{ route('register') }}" class="text-sm text-cocoa-900 hover:underline">
                สมัครสมาชิก
            </a>

            <button type="submit"
                class="bg-blue-700 text-white px-6 py-2 rounded-lg hover:bg-blue-600 shadow-soft">
                เข้าสู่ระบบ
            </button>
        </div>
    </form>
</div>
@endsection
