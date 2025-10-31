<!-- เริ่มต้นส่วน Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <!-- Container หลัก จัดให้อยู่กลางและมี padding -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- ===== ส่วนซ้าย: โลโก้ + ชื่อร้าน + ช่องค้นหา ===== -->
            <div class="flex items-center space-x-6">

                <!-- โลโก้ร้าน และชื่อ -->
                <a href="/" class="flex items-center space-x-3">
                    <img src="{{ asset('imgs/cake.jpg') }}" class="h-12">
                    <span class="text-3xl font-bold text-gray-800">
                        JJ Bakery Shop
                    </span>
                </a>

                <!-- ช่องค้นหาสินค้า (โชว์เฉพาะจอขนาด sm ขึ้นไป) -->
                <div class="hidden sm:block relative">
                    <input type="text" placeholder="Search product...."
                        class="border border-gray-300 rounded-full py-2 px-4 pl-10 w-72 focus:outline-none focus:border-amber-500">
                    
                    <!-- ไอคอนแว่นขยาย (Search icon) -->
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- ===== ส่วนขวา: Cart + Login/Register หรือ Profile ===== -->
            <div class="flex items-center space-x-4">

                <!-- ปุ่มรถเข็น (Cart icon) -->
                <a href="{{ url('/cartpage') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                    <img src="{{ asset('imgs/cart.jpg') }}" alt="Cart" class="h-6 w-6">
                </a>

                <!-- ถ้ายังไม่ได้ล็อกอิน -->
                @guest
                    <!-- ปุ่มสมัครสมาชิก -->
                    <a href="{{ url('register') }}"
                        class="hidden sm:block text-gray-600 hover:text-gray-900 font-medium">Register</a>

                    <!-- ปุ่มเข้าสู่ระบบ -->
                    <a href="{{ url('/login') }}"
                        class="bg-gray-800 text-white px-5 py-2 rounded-full font-medium hover:bg-gray-700">Login</a>
                @endguest

                <!-- ถ้าล็อกอินแล้ว -->
                @auth
                    <div class="flex items-center space-x-4">

                        <!-- โปรไฟล์ (ชื่อผู้ใช้ + รูป Avatar อัตโนมัติจาก ui-avatars) -->
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff"
                                alt="Profile" class="h-10 w-10 rounded-full">

                            <span class="font-medium text-lg text-gray-700">
                                {{ Auth::user()->name }}
                            </span>
                        </a>

                        <!-- ปุ่ม Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="ml-2">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                                title="Log Out"
                                class="font-medium text-lg text-gray-500 hover:text-red-600 p-2 rounded-lg hover:bg-gray-100">
                                Logout
                            </a>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
<!-- ===== จบ Navbar ===== -->
