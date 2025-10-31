<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JJ Bakery Shop') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-[#FFFBE9] antialiased bg-[#2F1B0C]">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        <!-- โลโก้ -->
        <div>
            <a href="/">
                <img src="{{ asset('imgs/cake.jpg') }}" alt="JJ Bakery Shop" class="w-20 h-20 rounded-lg shadow-md">
            </a>
        </div>

        <!-- กล่องเนื้อหา (Login / Register / Forgot) -->
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-6 bg-[#CEAB93] shadow-lg overflow-hidden sm:rounded-2xl border border-[#E3CAA5]">
            {{ $slot }}
        </div>

    </div>
</body>

</html>
