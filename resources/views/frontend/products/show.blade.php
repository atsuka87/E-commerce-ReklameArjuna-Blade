@extends('frontend.layouts.app')

@section('title', $product->name)

@section('content')
<!-- Breadcrumb -->
<section class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('products.index') }}" class="ml-1 text-gray-700 hover:text-gray-900 md:ml-3">
                            Produk
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-3">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Product Detail -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Image -->
            <div>
                <div class="bg-gray-100 rounded-lg overflow-hidden h-96 flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                    @else
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    @endif
                </div>
                
                @if($product->images->count() > 0)
                    <div class="mt-4 grid grid-cols-4 gap-2">
                        @foreach($product->images as $image)
                            <div class="bg-gray-100 rounded h-20 cursor-pointer hover:opacity-75">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover rounded">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Product Info -->
            <div>
                <div class="mb-4">
                    <span class="inline-block bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full">
                        {{ $product->category->name }}
                    </span>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <div class="mb-6">
                    <span class="text-3xl font-bold text-gray-900">
                        Rp {{ number_format($product->base_price, 0, ',', '.') }}
                    </span>
                    <div class="text-sm text-gray-500 mt-1">
                        Stok tersedia: {{ $product->stock }} unit
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                </div>
                
                @if($product->allow_custom)
                    <div class="mb-6 p-4 bg-yellow-50 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2 text-yellow-800">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Bisa Custom
                        </h3>
                        <p class="text-yellow-700 text-sm">
                            Produk ini dapat dicustom sesuai kebutuhan Anda. Isi form custom di bawah untuk detail lebih lanjut.
                        </p>
                    </div>
                @endif
                
                <!-- Add to Cart Form -->
                @auth
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                            </div>
                            
                            @if($product->allow_custom && in_array('custom_size', $product->custom_options ?? []))
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Ukuran Custom</label>
                                    <input type="text" name="custom_size" placeholder="Contoh: 5x10 cm" 
                                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                </div>
                            @endif
                        </div>
                        
                        @if($product->allow_custom && in_array('custom_text', $product->custom_options ?? []))
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Teks Custom</label>
                                <textarea name="custom_text" rows="3" placeholder="Masukkan teks yang ingin dicetak"
                                          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"></textarea>
                            </div>
                        @endif
                        
                        @if($product->allow_custom && in_array('custom_color', $product->custom_options ?? []))
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Warna Custom</label>
                                <input type="text" name="custom_color" placeholder="Contoh: Merah, Biru, Hitam" 
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            </div>
                        @endif
                        
                        @if($product->allow_custom && in_array('upload_logo', $product->custom_options ?? []))
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Logo (Opsional)</label>
                                <input type="file" name="upload_logo" accept="image/*" 
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, maksimal 2MB</p>
                            </div>
                        @endif
                        
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="flex space-x-4">
                            <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-6 rounded-lg">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-gray-100 p-6 rounded-lg text-center">
                        <p class="text-gray-600 mb-4">Silakan login untuk menambahkan produk ke keranjang</p>
                        <a href="{{ route('login') }}" class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-2 rounded-md">
                            Login
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Produk Terkait</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        @if($relatedProduct->image)
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="h-full w-full object-cover">
                        @else
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2">{{ $relatedProduct->name }}</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-900">
                                Rp {{ number_format($relatedProduct->base_price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
