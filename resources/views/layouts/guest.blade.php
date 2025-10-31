<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JJ Bakery Shop') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    {{-- ===== Scripts / Styles (Vite with safe fallback) ===== --}}
    @php $viteManifest = public_path('build/manifest.json'); @endphp
    @if (file_exists($viteManifest))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
          tailwind.config = {
            theme: {
              extend: {
                colors: {
                  cream: { 50:'#FFFBF3',100:'#FFF6E7',200:'#FFECCF' },
                  cocoa: { 900:'#1E293B' }
                },
                boxShadow: {
                  soft: '0 6px 24px rgba(15,23,42,.08)',
                  card: '0 10px 30px rgba(15,23,42,.06)'
                },
                borderRadius: { xl2:'1.25rem' }
              }
            }
          }
        </script>
        <style>
          body{ font-family:"Figtree", ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans" }
          .container{ max-width:1200px }
          .line-clamp-1{ display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; overflow:hidden }
          .line-clamp-2{ display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden }
        </style>
    @endif

    @stack('head')
</head>
<body class="bg-cream-50 text-slate-900">
    @if (session('status'))
        <div class="bg-emerald-50 text-emerald-700 text-sm px-4 py-3">{{ session('status') }}</div>
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="border-t mt-20">
        <div class="container mx-auto px-4 py-10 text-sm text-slate-500">
            © {{ date('Y') }} JJ Bakery Shop — Freshly baked with ♥
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
