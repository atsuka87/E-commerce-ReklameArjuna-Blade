@extends('frontend.layouts.app')

@section('title', 'Profile')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Profile Saya</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- User Information -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="text-center">
                        <div class="mx-auto h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="mt-4 text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-500">{{ $user->email }}</p>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            @if ($errors->any())
                                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded relative" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <span class="block sm:inline">{{ $error }}</span>
                                    @endforeach
                                </div>
                            @endif
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                            </div>
                            
                            <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded-md">
                                Update Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Order History -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Riwayat Pesanan</h2>
                    </div>
                    
                    @if($orders->count() > 0)
                        <div class="divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">{{ $order->order_number }}</h3>
                                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status == 'paid') bg-blue-100 text-blue-800
                                                @elseif($order->status == 'process') bg-purple-100 text-purple-800
                                                @elseif($order->status == 'shipped') bg-indigo-100 text-indigo-800
                                                @elseif($order->status == 'done') bg-green-100 text-green-800
                                                @elseif($order->status == 'canceled') bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                            <p class="text-lg font-bold text-gray-900 mt-1">
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        @foreach($order->items->take(2) as $item)
                                            <div class="flex items-center space-x-3 text-sm">
                                                <div class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded overflow-hidden">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}" class="h-full w-full object-cover">
                                                    @else
                                                        <svg class="w-full h-full text-gray-400 p-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <p class="font-medium text-gray-900">{{ $item->product_name }}</p>
                                                    <p class="text-gray-500">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->items->count() > 2)
                                            <p class="text-xs text-gray-500">
                                                +{{ $order->items->count() - 2 }} produk lainnya
                                            </p>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                                        <div class="text-sm text-gray-500">
                                            <p>{{ $order->shipping_address }}</p>
                                            <p>Tel: {{ $order->phone }}</p>
                                        </div>
                                        <button onclick="toggleOrderDetails('order-{{ $order->id }}')" 
                                                class="text-yellow-600 hover:text-yellow-700 text-sm font-medium">
                                            Lihat Detail
                                        </button>
                                    </div>
                                    
                                    <!-- Order Details (Hidden by default) -->
                                    <div id="order-{{ $order->id }}" class="hidden mt-4 pt-4 border-t border-gray-200">
                                        <h4 class="font-medium text-gray-900 mb-3">Detail Produk</h4>
                                        <div class="space-y-3">
                                            @foreach($order->items as $item)
                                                <div class="bg-gray-50 rounded p-3">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <p class="font-medium text-gray-900">{{ $item->product_name }}</p>
                                                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                                            
                                                            @if($item->custom_options)
                                                                <div class="mt-2 space-y-1">
                                                                    @if(isset($item->custom_options['custom_text']))
                                                                        <p class="text-xs text-gray-600">
                                                                            Teks: {{ $item->custom_options['custom_text'] }}
                                                                        </p>
                                                                    @endif
                                                                    @if(isset($item->custom_options['custom_size']))
                                                                        <p class="text-xs text-gray-600">
                                                                            Ukuran: {{ $item->custom_options['custom_size'] }}
                                                                        </p>
                                                                    @endif
                                                                    @if(isset($item->custom_options['custom_color']))
                                                                        <p class="text-xs text-gray-600">
                                                                            Warna: {{ $item->custom_options['custom_color'] }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <p class="font-medium text-gray-900">
                                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        @if($order->notes)
                                            <div class="mt-3">
                                                <h4 class="font-medium text-gray-900 mb-1">Catatan</h4>
                                                <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pesanan</h3>
                            <p class="text-gray-500 mb-6">Anda belum memiliki pesanan sebelumnya</p>
                            <a href="{{ route('products.index') }}" class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-2 rounded-md">
                                Mulai Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleOrderDetails(orderId) {
    const element = document.getElementById(orderId);
    element.classList.toggle('hidden');
}
</script>
@endsection
