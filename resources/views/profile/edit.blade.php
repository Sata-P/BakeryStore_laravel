@extends('layouts.app')

@section('content')
<div class="py-16 bg-cream-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-cocoa-900 mb-8 text-center">โปรไฟล์ของฉัน 👤</h1>

        <div class="grid gap-8 md:grid-cols-2 max-w-5xl mx-auto">
            {{-- เพิ่ม class 'border border-cocoa-100' --}}
            <div class="p-6 bg-white shadow-card rounded-2xl border border-cocoa-100">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- เพิ่ม class 'border border-cocoa-100' --}}
            <div class="p-6 bg-white shadow-card rounded-2xl border border-cocoa-100">
                @include('profile.partials.update-password-form')
            </div>

            {{-- เพิ่ม class 'border border-cocoa-100' --}}
            <div class="p-6 bg-white shadow-card rounded-2xl md:col-span-2 border border-cocoa-100">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection