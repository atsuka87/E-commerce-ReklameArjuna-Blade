<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('frontend.checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang belanja kosong');
        }

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $order = Order::create([
            'order_number' => 'RA-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'shipping_cost' => 0,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
                'custom_options' => $cartItem->custom_options,
            ]);

            $cartItem->product->decrement('stock', $cartItem->quantity);
        }

        Cart::where('user_id', Auth::id())->delete();

        $midtransService = new MidtransService();
        $snapToken = $midtransService->createSnapToken($order);

        return view('frontend.checkout.payment', compact('order', 'snapToken'));
    }
}
