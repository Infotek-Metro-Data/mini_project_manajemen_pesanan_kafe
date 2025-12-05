<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Order; 
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalMenus = Menu::count();
            $totalOrders = Order::count();
            $totalRevenue = Order::where('status', 'dibayar')->sum('total_amount');
            $recentOrders = Order::with('user')->latest()->take(5)->get();

            return view('dashboard.admin', compact('totalMenus', 'totalOrders', 'totalRevenue', 'recentOrders'));
        }

        if ($user->role === 'kasir') {
            $pendingOrders = Order::where('status', 'pending')->count();
            
            $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
            
            $todayRevenue = Order::whereDate('created_at', Carbon::today())
                                 ->where('status', 'dibayar')
                                 ->sum('total_amount');
            
            $recentOrders = Order::with('user')->latest()->take(5)->get();

            return view('dashboard.kasir', compact('pendingOrders', 'todayOrders', 'todayRevenue', 'recentOrders'));
        }

        return redirect()->route('pelanggan.dashboard');
    }

    public function pelanggan()
    {

        $user = Auth::user();
        $myOrders = Order::where('user_id', $user->id)->latest()->take(5)->get();
        $totalSpent = Order::where('user_id', $user->id)->where('status', 'dibayar')->sum('total_amount');
        $menus = Menu::with('category')->limit(3)->get(); 

        return view('dashboard.pelanggan', compact('myOrders', 'totalSpent', 'menus'));
    }
}