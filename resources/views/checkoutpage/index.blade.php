@extends('layouts.app')

@section('content')
    @if (session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="p-4 bg-red-100 text-red-700 border border-red-300 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Checkout') }}
            </h2>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- ⭐️ ยิงฟอร์มไปที่ Route 'order.store' ⭐️ --}}
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Shipping Details</h3>
                                <div class="mt-6 space-y-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" id="name" value="{{ Auth::user()->name }}" disabled
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" id="email" value="{{ Auth::user()->email }}" disabled
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="phone_no" class="block text-sm font-medium text-gray-700">Phone No</label>
                                        <input type="text" name="phone_no" id="phone_no" value="{{ Auth::user()->phone_no }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('phone_no') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                        <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ Auth::user()->address }}</textarea>
                                        @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                                <ul role="list" class="divide-y divide-gray-200 mt-6">
                                    @foreach ($cartItems as $item)
                                        <li class="flex py-4">
                                            <div class="ml-3 flex-auto">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                            </div>
                                            <p class="text-sm font-medium text-gray-900">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="border-t border-gray-200 mt-6 pt-6 space-y-2">
                                    <div class="flex justify-between text-sm font-medium text-gray-700">
                                        <p>Subtotal</p>
                                        <p>${{ number_format($subtotal, 2) }}</p>
                                    </div>
                                    @if ($coupon)
                                        <div class="flex justify-between text-sm font-medium text-green-600">
                                            <p>Discount ({{ $coupon->code }})</p>
                                            <p>-${{ number_format($discount, 2) }}</p>
                                        </div>
                                    @endif
                                    <div class="flex justify-between text-lg font-medium text-gray-900 mt-2 pt-2 border-t border-gray-200">
                                        <p>Total</p>
                                        <p>${{ number_format($total, 2) }}</p>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <button type="submit"
                                        class="flex w-full items-center justify-center rounded-md border border-transparent bg-green-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-green-700">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection