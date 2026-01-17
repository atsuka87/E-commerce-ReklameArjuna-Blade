@extends('backend.layouts.app')

@section('header', 'Detail Order')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <!-- Order Header -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Order #{{ $order->order_number }}</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium 
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'paid') bg-blue-100 text-blue-800
                        @elseif($order->status == 'process') bg-purple-100 text-purple-800
                        @elseif($order->status == 'shipped') bg-indigo-100 text-indigo-800
                        @elseif($order->status == 'done') bg-green-100 text-green-800
                        @elseif($order->status == 'canceled') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Customer Information</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <p class="font-medium">{{ $order->user->name }}</p>
                        <p>{{ $order->user->email }}</p>
                        <p>{{ $order->phone }}</p>
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Shipping Address</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <p>{{ $order->shipping_address }}</p>
                        @if($order->notes)
                            <p class="mt-2"><strong>Catatan:</strong> {{ $order->notes }}</p>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Order Items</h3>
        </div>
        <div class="border-t border-gray-200">
            <dl class="divide-y divide-gray-200">
                @foreach($order->items as $item)
                    <div class="px-4 py-5 sm:px-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}" class="h-full w-full object-cover">
                                @else
                                    <svg class="w-full h-full text-gray-400 p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h4>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                
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
                            </div>
                            
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </dl>
        </div>
        
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <div class="flex justify-between text-sm">
                <span class="font-medium text-gray-900">Total Amount</span>
                <span class="font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Update Status -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Update Status</h3>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                        <select name="status" required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                            <option value="{{ $order->status }}" selected>{{ ucfirst($order->status) }} (Current)</option>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="process">Process</option>
                            <option value="shipped">Shipped</option>
                            <option value="done">Done</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-yellow-500 py-2 px-4 text-sm font-medium text-gray-900 shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                            Update Status
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Payment Information -->
    @if($order->payment)
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Information</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Transaction ID</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->payment->midtrans_order_id }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Payment Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->payment->payment_type }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Transaction Status</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->payment->transaction_status }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Amount</dt>
                        <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($order->payment->gross_amount, 0, ',', '.') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    @endif

    <div class="mt-6 flex justify-between">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
            Kembali
        </a>
    </div>
</div>
@endsection
