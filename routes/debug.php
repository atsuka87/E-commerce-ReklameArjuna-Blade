<?php

use Illuminate\Support\Facades\Route;
use App\Services\MidtransService;

Route::get('/test-midtrans', function() {
    try {
        $midtransService = new MidtransService();
        
        // Check configuration
        $config = [
            'server_key' => config('services.midtrans.server_key'),
            'client_key' => config('services.midtrans.client_key'),
            'is_production' => config('services.midtrans.is_production'),
        ];
        
        return response()->json([
            'status' => 'success',
            'config' => $config,
            'message' => 'Midtrans configuration loaded successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'config' => [
                'server_key' => config('services.midtrans.server_key'),
                'client_key' => config('services.midtrans.client_key'),
                'is_production' => config('services.midtrans.is_production'),
            ]
        ]);
    }
});

Route::get('/test-midtrans-snap', function () {
    try {
        $serverKey = (string) config('services.midtrans.server_key');
        $clientKey = (string) config('services.midtrans.client_key');
        $isProduction = (bool) config('services.midtrans.is_production');

        \Midtrans\Config::$serverKey = $serverKey;
        \Midtrans\Config::$isProduction = $isProduction;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $orderId = 'TEST-' . now()->format('YmdHis') . '-' . random_int(1000, 9999);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'Test',
                'email' => 'test@example.com',
                'phone' => '08123456789',
            ],
            'item_details' => [
                [
                    'id' => 'item-1',
                    'price' => 10000,
                    'quantity' => 1,
                    'name' => 'Test Item',
                ],
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'status' => 'success',
            'message' => 'Midtrans Snap token created successfully',
            'is_production' => $isProduction,
            'server_key_prefix' => substr($serverKey, 0, 15),
            'client_key_prefix' => substr($clientKey, 0, 15),
            'order_id' => $orderId,
            'snap_token' => $snapToken,
        ]);
    } catch (\Exception $e) {
        $serverKey = (string) config('services.midtrans.server_key');
        $clientKey = (string) config('services.midtrans.client_key');
        $isProduction = (bool) config('services.midtrans.is_production');

        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'is_production' => $isProduction,
            'server_key_prefix' => substr($serverKey, 0, 15),
            'client_key_prefix' => substr($clientKey, 0, 15),
        ], 500);
    }
});
