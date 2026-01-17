<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'done')->sum('total_amount');
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();
        $totalUsers = User::where('role', 'user')->count();
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalCategories = Category::count();
        
        // Order statistics
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $completedOrders = Order::where('status', 'done')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        return view('backend.dashboard.index', compact(
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'totalUsers',
            'totalProducts',
            'activeProducts',
            'totalCategories',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'cancelledOrders'
        ));
    }
}
