<header class="sticky top-0 z-40 backdrop-blur bg-white/70 border-b">
  <nav class="container mx-auto px-4 flex items-center gap-4 justify-between py-3">
    <a href="{{ url('/') }}" class="flex items-center gap-3 font-extrabold text-xl">
        <img src="{{ asset('imgs/cake.jpg') }}" alt="JJ" class="w-9 h-9 rounded-xl shadow-soft">
        <span class="tracking-tight">JJ Bakery Shop</span>
    </a>

    <form action="{{ url('/products') }}" method="GET" class="hidden md:block w-[48%]">
      <label class="relative block">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
          <!-- magnifier -->
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M21 21l-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/></svg>
        </span>
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search fresh pastries..."
          class="w-full pl-9 pr-4 py-2 rounded-full border bg-white/90 outline-none focus:ring-2 focus:ring-slate-200">
      </label>
    </form>

    

    <div class="flex items-center gap-2">
      {{-- 🛒 ปุ่ม Cart --}}
      <a href="{{ url('/cartpage') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
        <img src="{{ asset('imgs/cart.jpg') }}" alt="Cart" class="h-6 w-6">
      </a>

      {{-- 🔐 เงื่อนไขเมื่อเข้าสู่ระบบ --}}
      @auth
          {{-- ปุ่ม Profile --}}
          <a href="{{ route('profile.edit') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-full hover:bg-slate-100">
              <img src="{{ asset('imgs/user-icon.png') }}" alt="User" class="w-6 h-6 rounded-full">
              <span class="font-medium text-cocoa-900">{{ Auth::user()->name }}</span>
          </a>

          {{-- Dashboard --}}
          <a href="{{ url('/dashboard') }}" class="px-3 py-2 rounded-full hover:bg-slate-100">
            Dashboard
          </a>

          {{-- Logout --}}
          <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit"
                class="px-4 py-2 rounded-full bg-slate-900 text-white shadow-soft hover:bg-gray-700">
                Logout
              </button>
          </form>
      @else
          {{-- 🧁 ยังไม่ login --}}
          <a href="{{ url('/register') }}" class="px-3 py-2 rounded-full hover:bg-slate-100">
            Register
          </a>
          <a href="{{ url('/login') }}" class="px-4 py-2 rounded-full bg-slate-900 text-white shadow-soft hover:bg-gray-700">
            Login
          </a>
      @endauth

    </div>

  </nav>
</header>
