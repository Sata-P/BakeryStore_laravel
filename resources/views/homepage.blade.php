@extends('layouts.app')

@section('content')

    <div class="relative bg-stone-200 overflow-hidden" 
         style="background-image: url('https://www.transparenttextures.com/patterns/simple-dashed.png');">
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900">
                Start shopping at our local shops
            </h1>
            <p class="mt-4 text-lg text-gray-700">
                Start shopping and save on your first order
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        @if(isset($products) && $products->count() > 0)
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
                
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="relative">
                            <div class="aspect-square bg-gray-100">
                                <img src="{{ $product['image_url'] }}" 
                                     alt="{{ $product['name'] }}" 
                                     class="w-full h-full object-contain p-2"> 
                            </div>
                            <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-700">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-base truncate" title="{{ $product['name'] }}">
                                {{ $product['name'] }}
                            </h3>
                            <p class="text-gray-600 mt-1">
                                B {{ $product['price'] }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <p class="text-center text-gray-500">No products found.</p>
        @endif
        
    </div>

@endsection