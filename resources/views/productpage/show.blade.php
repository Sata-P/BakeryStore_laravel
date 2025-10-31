@extends('layouts.guest')

@section('content')
  @include('layouts.partials.navbar')

  <section class="container mx-auto px-4 py-10">
    {{-- Header --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      {{-- รูปสินค้า --}}
      <div>
        <img src="{{ $product->image_url ?? asset('imgs/cake.jpg') }}"
             alt="{{ $product->name }}"
             class="w-full rounded-2xl shadow-soft object-cover">
      </div>

      {{-- รายละเอียด --}}
      <div>
        <h1 class="text-3xl md:text-4xl font-extrabold">{{ $product->name }}</h1>
        <p class="mt-3 text-slate-700">{{ $product->description }}</p>

        <div class="mt-6 flex items-center gap-4">
          <span class="text-2xl font-extrabold">
            ฿{{ number_format($product->price, 2) }}
          </span>
          <span class="text-slate-500">สต็อก: {{ $product->stock_qty ?? '—' }}</span>
        </div>

        {{-- เรตติ้งเฉลี่ย --}}
        <div class="mt-4 flex items-center gap-2">
          <span class="text-amber-500">★</span>
          <span class="font-semibold">{{ $avgRating ?: 0 }}</span>
          <span class="text-slate-500">/ 5</span>
          <span class="text-slate-500"> ({{ $product->reviews->count() }} รีวิว)</span>
        </div>

        <div class="mt-6">
          <a href="{{ url('/products') }}"
             class="inline-block px-5 py-2 rounded-full border hover:bg-white">
            ← กลับไปยังสินค้า
          </a>
        </div>
      </div>
    </div>

    {{-- เส้นคั่น --}}
    <div class="my-10 border-t"></div>

    {{-- ส่วนรีวิว --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      {{-- ฟอร์มรีวิว --}}
      <div class="md:col-span-1">
        <h2 class="text-xl font-bold mb-4">เขียนรีวิว</h2>

        @auth
          @if (session('status'))
            <div class="mb-3 text-emerald-700 bg-emerald-50 border border-emerald-100 rounded px-3 py-2">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('products.reviews.store', $product) }}"
                class="bg-white rounded-2xl shadow-soft p-4 space-y-3">
            @csrf

            <label class="block text-sm font-medium">ให้คะแนน</label>
            <select name="rating" class="w-32 border rounded px-3 py-2">
              @for($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" @selected(old('rating')==$i)>{{ $i }}</option>
              @endfor
            </select>
            @error('rating') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror

            <label class="block text-sm font-medium mt-2">ความคิดเห็น</label>
            <textarea name="comment" rows="4" class="w-full border rounded px-3 py-2"
                      placeholder="รสชาติเป็นอย่างไร เนื้อสัมผัสดีไหม...">{{ old('comment') }}</textarea>
            @error('comment') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror

            <button class="mt-2 px-4 py-2 rounded-full bg-slate-900 text-white">
              ส่งรีวิว
            </button>
          </form>
        @else
          <p class="text-slate-600">
            กรุณา <a class="underline" href="{{ url('/login') }}">เข้าสู่ระบบ</a> เพื่อเขียนรีวิว
          </p>
        @endauth
      </div>

      {{-- รายการรีวิว --}}
      <div class="md:col-span-2">
        <h2 class="text-xl font-bold mb-4">รีวิวทั้งหมด</h2>

        @forelse($product->reviews->sortByDesc('created_at') as $r)
          <div class="bg-white rounded-2xl shadow-soft p-4 mb-4">
            <div class="flex items-center gap-2">
              <span class="font-semibold">{{ $r->user->name ?? 'ผู้ใช้' }}</span>
              <span class="text-amber-500">★</span>
              <span class="font-semibold">{{ $r->rating }}</span>
              <span class="text-slate-500 text-sm">
                · {{ \Carbon\Carbon::parse($r->review_date)->toFormattedDateString() }}
              </span>
            </div>
            @if($r->comment)
              <p class="mt-2 text-slate-700">{{ $r->comment }}</p>
            @endif
          </div>
        @empty
          <div class="text-slate-500">ยังไม่มีรีวิว</div>
        @endforelse
      </div>
    </div>
  </section>
@endsection
