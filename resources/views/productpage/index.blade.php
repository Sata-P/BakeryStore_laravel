{{-- ใช้ Layout เดียวกับหน้า Cart เลย --}}
@extends('layouts.app')

@section('content')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">คลิกเพื่อทดสอบเพิ่มสินค้าลงตะกร้า:</h3>

                    {{-- แสดงสินค้าทั้งหมดที่ Seeder สร้างไว้ --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                        @foreach ($products as $product)
                            <div class="border border-gray-200 rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h4 class="font-bold text-lg">{{ $product->name }}</h4>
                                    <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
                                </div>

                                <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection