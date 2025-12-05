<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,kasir');
    }

    public function index()
    {
        $orders = Order::with('items.menu', 'user')->latest()->get();
        return view('order.process', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if ($request->status == 'batal' && $order->status != 'batal') {
            foreach ($order->items as $item) {
                $item->menu->increment('stock', $item->qty);
            }
        }

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan diperbarui');
    }
}
