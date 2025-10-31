@extends('layouts.app')

@section('content')
<div class="py-16 bg-cream-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-cocoa-900 mb-8 text-center">โปรไฟล์ของฉัน 👤</h1>

        <div class="grid gap-8 md:grid-cols-2 max-w-5xl mx-auto">
            <div class="p-6 bg-white shadow-card rounded-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="p-6 bg-white shadow-card rounded-2xl">
                @include('profile.partials.update-password-form')
            </div>

            <div class="p-6 bg-white shadow-card rounded-2xl md:col-span-2">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
