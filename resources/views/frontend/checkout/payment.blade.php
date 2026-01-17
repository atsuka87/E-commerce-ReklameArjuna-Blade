@extends('frontend.layouts.app')

@section('title', 'Pembayaran')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Order Success Header -->
            <div class="bg-green-50 border-b border-green-200 px-6 py-4">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h1 class="text-xl font-semibold text-green-800">Order Berhasil Dibuat</h1>
                        <p class="text-green-600">Nomor Order: {{ $order->order_number }}</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Order Details -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Order</h2>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nomor Order</span>
                                <span class="font-medium">{{ $order->order_number }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal</span>
                                <span class="font-medium">{{ $order->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Status</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Pembayaran</span>
                                <span class="font-bold text-gray-900">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">Alamat Pengiriman</h3>
                            <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                            <p class="text-sm text-gray-600 mt-1">Tel: {{ $order->phone }}</p>
                            @if($order->notes)
                                <p class="text-sm text-gray-600 mt-2">
                                    <span class="font-medium">Catatan:</span> {{ $order->notes }}
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Payment Section -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Pembayaran</h2>
                        
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <p class="text-sm text-gray-600 mb-2">
                                Silakan lengkapi pembayaran untuk konfirmasi order Anda
                            </p>
                            <p class="text-lg font-bold text-gray-900 mb-4">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>
                            
                            <button id="pay-button" class="w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-4 rounded-lg">
                                Bayar Sekarang
                            </button>
                        </div>
                        
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm text-blue-800">
                                    <p class="font-medium mb-1">Metode Pembayaran</p>
                                    <p>Kami menerima berbagai metode pembayaran:</p>
                                    <ul class="mt-2 space-y-1 text-xs">
                                        <li>• Transfer Bank (BCA, Mandiri, BNI, dll)</li>
                                        <li>• E-Wallet (GoPay, OVO, Dana, ShopeePay)</li>
                                        <li>• Kartu Kredit/Debit</li>
                                        <li>• Gerai Retail (Alfamart, Indomaret)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Items -->
                <div class="mt-8 pt-8 border-t">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Produk yang Dipesan</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Produk
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kustomisasi
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Qty
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($item->custom_options)
                                                <div class="text-xs text-gray-500">
                                                    @if(isset($item->custom_options['custom_text']))
                                                        <p>Teks: {{ $item->custom_options['custom_text'] }}</p>
                                                    @endif
                                                    @if(isset($item->custom_options['custom_size']))
                                                        <p>Ukuran: {{ $item->custom_options['custom_size'] }}</p>
                                                    @endif
                                                    @if(isset($item->custom_options['custom_color']))
                                                        <p>Warna: {{ $item->custom_options['custom_color'] }}</p>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-8 flex justify-between">
                    <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-6 rounded-lg">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('profile.index') }}" class="bg-gray-900 hover:bg-gray-800 text-white font-medium py-2 px-6 rounded-lg">
                        Lihat Order Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log('success', result);
                window.location.href = '{{ route('profile.index') }}';
            },
            onPending: function(result) {
                console.log('pending', result);
                window.location.href = '{{ route('profile.index') }}';
            },
            onError: function(result) {
                console.log('error', result);
                alert('Pembayaran gagal. Silakan coba lagi.');
            },
            onClose: function() {
                console.log('customer closed the popup without finishing the payment');
            }
        });
    };
</script>
@endsection
