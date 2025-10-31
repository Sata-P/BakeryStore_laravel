<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PGSHOP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap');
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f7f3e8; /* สีขาวครีม */
            color: #333333; /* สีตัวอักษรเริ่มต้นเป็นเทาเข้ม */
        }
    </style>
</head>
<body class="text-gray-800"> {{-- ใช้ text-gray-800 เหมือนเดิม --}}

    @include('layouts.partials.navbar')

    <main>
        @yield('content')

        {{-- ตรวจว่ามี $slot ก่อนค่อยแสดง --}}
        @isset($slot)
            {{ $slot }}
        @endisset
    </main>


</body>
</html>