@extends('frontend.layouts.app')

@section('title', 'Keranjang')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>
        
        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Produk ({{ $cartItems->count() }})</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="p-6">
                                    <div class="flex items-center space-x-4">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg overflow-hidden">
                                            @if($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                                            @else
                                                <svg class="w-full h-full text-gray-400 p-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                            <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                                            
                                            @if($item->custom_options)
                                                <div class="mt-2 space-y-1">
                                                    @if(isset($item->custom_options['custom_text']))
                                                        <p class="text-xs text-gray-600">
                                                            <span class="font-medium">Teks:</span> {{ $item->custom_options['custom_text'] }}
                                                        </p>
                                                    @endif
                                                    @if(isset($item->custom_options['custom_size']))
                                                        <p class="text-xs text-gray-600">
                                                            <span class="font-medium">Ukuran:</span> {{ $item->custom_options['custom_size'] }}
                                                        </p>
                                                    @endif
                                                    @if(isset($item->custom_options['custom_color']))
                                                        <p class="text-xs text-gray-600">
                                                            <span class="font-medium">Warna:</span> {{ $item->custom_options['custom_color'] }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                            
                                            <div class="mt-3 flex items-center space-x-4">
                                                <!-- Quantity Update -->
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock + $item->quantity }}" 
                                                           class="w-16 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 text-sm">
                                                    <button type="submit" class="text-yellow-600 hover:text-yellow-700 text-sm">
                                                        Update
                                                    </button>
                                                </form>
                                                
                                                <!-- Remove Item -->
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-700 text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <!-- Price -->
                                        <div class="text-right">
                                            <p class="text-lg font-semibold text-gray-900">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Order</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span class="font-medium">Gratis</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-gray-900">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('checkout.index') }}" class="w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-4 rounded-lg text-center block">
                            Checkout
                        </a>
                        
                        <a href="{{ route('products.index') }}" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg text-center block mt-3">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Keranjang Belanja Kosong</h3>
                <p class="text-gray-500 mb-6">Belum ada produk di keranjang Anda</p>
                <a href="{{ route('products.index') }}" class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-2 rounded-md">
                    Belanja Sekarang
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
