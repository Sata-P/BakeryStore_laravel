@extends('layouts.guest')

@section('content')
  @include('layouts.partials.navbar')

  {{-- ฮีโร่ลายเส้นอ่อน --}}
  <section class="relative overflow-hidden">
    <div aria-hidden="true" class="absolute inset-0 opacity-10">
      <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <pattern id="pat" width="40" height="40" patternUnits="userSpaceOnUse">
            <path d="M0 40 40 0M-10 10 10 -10M30 50 50 30" stroke="#0f172a" stroke-width=".8"/>
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#pat)" />
      </svg>
    </div>

    <div class="container mx-auto px-4 py-24 relative">
      <div class="max-w-3xl">
        <span class="inline-flex items-center text-xs font-semibold tracking-widest uppercase bg-white/70 border rounded-full px-3 py-1">อบสดทุกวัน</span>
        <h1 class="mt-4 text-5xl md:text-6xl font-extrabold leading-tight">เริ่มช้อปขนมอร่อยจากร้านของเรา</h1>
        <p class="mt-4 text-slate-600 text-lg">เค้ก ขนมปัง และเพสตรี้แฮนด์เมด — อบสดใหม่ทุกเช้า</p>
        <div class="mt-10 flex items-center gap-4">
        {{-- CTA หลัก: ช้อปเลย --}}
        <a href="{{ url('/products') }}"
            class="group inline-flex items-center gap-2 rounded-full
                    px-8 md:px-10 py-4 md:py-5
                    text-lg md:text-xl font-semibold
                    bg-slate-900 text-white
                    shadow-[0_10px_28px_rgba(15,23,42,.18)]
                    hover:shadow-[0_14px_34px_rgba(15,23,42,.22)]
                    hover:-translate-y-0.5 active:translate-y-0
                    transition">
            ช้อปเลย
            <svg class="w-5 h-5 md:w-6 md:h-6 -translate-x-0.5 group-hover:translate-x-0 transition"
                viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
        {{-- CTA รอง: ทำไมต้องเรา? --}}
        <a href="#benefits"
            class="inline-flex items-center gap-2 rounded-full
                    px-7 md:px-9 py-3.5 md:py-4
                    text-lg font-medium
                    bg-white/90 text-slate-900
                    ring-1 ring-slate-300 hover:bg-white hover:ring-slate-400
                    focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-300
                    transition">
            ทำไมต้องเรา?
        </a>
        </div>
      </div>
    </div>
  </section>

  {{-- จุดเด่น --}}
  <section id="benefits" class="container mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-6">
      <div class="bg-white rounded-2xl shadow-soft p-6">
        <div class="w-10 h-10 grid place-content-center rounded-full bg-cream-200">🍞</div>
        <h3 class="mt-3 font-bold text-lg">วัตถุดิบคุณภาพ</h3>
        <p class="text-slate-600">ไข่ไก่สด เนยแท้ เกรดพรีเมียม และครีมคุณภาพ</p>
      </div>
      <div class="bg-white rounded-2xl shadow-soft p-6">
        <div class="w-10 h-10 grid place-content-center rounded-full bg-cream-200">⏱️</div>
        <h3 class="mt-3 font-bold text-lg">อบใหม่ทุกวัน</h3>
        <p class="text-slate-600">ความฟูและความหอม สดใหม่จากเตาทุกเช้า</p>
      </div>
      <div class="bg-white rounded-2xl shadow-soft p-6">
        <div class="w-10 h-10 grid place-content-center rounded-full bg-cream-200">🚚</div>
        <h3 class="mt-3 font-bold text-lg">รับสินค้าไว</h3>
        <p class="text-slate-600">สั่งออนไลน์แล้วรับหน้าร้านได้ภายในไม่กี่นาที</p>
      </div>
    </div>
  </section>

  {{-- สินค้าแนะนำ (ถ้ามีตัวแปร $featured) --}}
  @isset($featured)
  <section class="container mx-auto px-4 pb-16">
    <div class="flex items-baseline justify-between mb-6">
      <h2 class="text-2xl font-extrabold">สินค้าแนะนำ</h2>
      <a href="{{ url('/products') }}" class="text-slate-600 hover:underline">ดูสินค้าทั้งหมด →</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($featured as $p)
        <a href="{{ url('/products/'.($p->product_id ?? $p->id)) }}"
           class="group bg-white rounded-2xl shadow-soft hover:shadow-card transition overflow-hidden">
          <div class="relative">
            <img src="{{ $p->image_url ?? asset('imgs/cake.jpg') }}" class="w-full h-44 object-cover group-hover:scale-[1.02] transition" alt="">
            <span class="absolute top-3 left-3 bg-white/90 text-xs px-2 py-1 rounded-full border">฿{{ isset($p->price)?number_format($p->price,2):'0.00' }}</span>
          </div>
          <div class="p-4">
            <div class="font-semibold line-clamp-1">{{ $p->name ?? '-' }}</div>
            <div class="text-slate-600 text-sm line-clamp-2">{{ $p->description ?? '' }}</div>
          </div>
        </a>
      @endforeach
    </div>
  </section>
  @endisset
@endsection
