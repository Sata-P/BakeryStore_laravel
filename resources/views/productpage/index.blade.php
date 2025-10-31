@extends('layouts.guest')

@section('content')
  @include('layouts.partials.navbar')

  @php
      $products = $products ?? collect();
      $search   = request('q');
  @endphp

  <section class="container mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-3xl font-extrabold">สินค้า</h1>
        @if(!empty($search))
          <p class="text-slate-600">ผลการค้นหา: <strong>{{ $search }}</strong></p>
        @endif
      </div>
      <form action="{{ url('/products') }}" method="GET" class="hidden md:block">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="ค้นหา..."
               class="rounded-full border px-4 py-2 outline-none focus:ring-2 focus:ring-slate-200">
      </form>
    </div>

    @if(method_exists($products, 'count') && $products->count() === 0)
      <div class="bg-white rounded-2xl shadow-soft p-16 text-center text-slate-500">
        ไม่พบสินค้า
      </div>
    @else
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $p)
          <div class="bg-white rounded-2xl shadow-soft hover:shadow-card transition overflow-hidden group">
            <div class="relative">
              <img src="{{ $p->image_url ?? asset('imgs/cake.jpg') }}"
                   alt="{{ $p->name ?? 'สินค้า' }}"
                   class="w-full h-44 object-cover group-hover:scale-[1.02] transition">
              <span class="absolute top-3 left-3 bg-white/90 text-xs px-2 py-1 rounded-full border">
                ฿{{ isset($p->price) ? number_format($p->price, 2) : '0.00' }}
              </span>
            </div>
            <div class="p-4">
              <h3 class="font-semibold line-clamp-1">{{ $p->name ?? '-' }}</h3>
              <p class="text-slate-600 text-sm line-clamp-2">{{ $p->description ?? '' }}</p>
              <div class="mt-3 flex items-center justify-between">
                <span class="text-xs text-slate-500">สต็อก: {{ $p->stock_qty ?? '—' }}</span>
                <a href="{{ url('/products/'.($p->product_id ?? $p->id)) }}"
                   class="text-sm font-medium text-slate-900 underline decoration-2 underline-offset-4">
                  รายละเอียด
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      @if(method_exists($products, 'hasPages') && $products->hasPages())
        <div class="mt-10">
          {{ $products->links() }}
        </div>
      @endif
    @endif
  </section>
@endsection
