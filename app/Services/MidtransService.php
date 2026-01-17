<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    private $serverKey;
    private $clientKey;
    private $isProduction;

    public function __construct()
    {
        $this->serverKey = config('services.midtrans.server_key');
        $this->clientKey = config('services.midtrans.client_key');
        $this->isProduction = config('services.midtrans.is_production', false);
    }

    public function createSnapToken(Order $order)
    {
        try {
            \Midtrans\Config::$serverKey = $this->serverKey;
            \Midtrans\Config::$isProduction = $this->isProduction;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
            
            // Check if server key is set
            if (empty($this->serverKey) || $this->serverKey === 'your-server-key-here') {
                throw new \Exception('Midtrans Server Key is not configured properly');
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $order->total_amount,
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->phone,
                ],
                'item_details' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->product_id,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'name' => $item->product_name,
                    ];
                })->toArray(),
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'midtrans_order_id' => $order->order_number,
                    'gross_amount' => $order->total_amount,
                    'raw_payload' => $params,
                ]
            );

            return $snapToken;
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            Log::error('Server Key: ' . $this->serverKey);
            Log::error('Is Production: ' . ($this->isProduction ? 'true' : 'false'));
            throw $e;
        }
    }

    public function handleNotification(array $notification)
    {
        $orderId = $notification['order_id'];
        $transactionStatus = $notification['transaction_status'];
        $paymentType = $notification['payment_type'];
        $grossAmount = $notification['gross_amount'];

        if (!$this->verifySignature($notification)) {
            Log::error('Invalid Midtrans signature');
            return false;
        }

        $order = Order::where('order_number', $orderId)->first();
        if (!$order) {
            Log::error('Order not found: ' . $orderId);
            return false;
        }

        $payment = Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'midtrans_order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'payment_type' => $paymentType,
                'gross_amount' => $grossAmount,
                'raw_payload' => $notification,
            ]
        );

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $order->update(['status' => 'paid']);
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $order->update(['status' => 'canceled']);
        }

        return true;
    }

    private function verifySignature(array $notification)
    {
        $orderId = $notification['order_id'];
        $statusCode = $notification['status_code'];
        $grossAmount = $notification['gross_amount'];
        $signatureKey = $notification['signature_key'];

        $calculatedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $this->serverKey);

        return $signatureKey === $calculatedSignature;
    }
}
