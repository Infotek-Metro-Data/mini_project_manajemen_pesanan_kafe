<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $menus = Menu::where('stock', '>', 0)->get();
        return view('orders.create', compact('menus'));
    }

    public function store(Request $r)
    {
        $r->validate(['items' => 'required|array']);

        $user = Auth::user();
        $total = 0;
        $itemsToProcess = [];

        foreach ($r->items as $item) {
            $menu = Menu::find($item['menu_id']);
            $qty = $item['quantity'];
            if (!$menu || $qty < 1)
                continue;
            if ($menu->stock < $qty)
                return back()->withErrors(['error' => "Stok {$menu->name} habis/kurang."]);

            $total += $menu->price * $qty;
            $itemsToProcess[] = ['menu' => $menu, 'qty' => $qty];
        }

        if (empty($itemsToProcess))
            return back()->withErrors(['error' => 'Pilih menu dulu.']);

        DB::transaction(function () use ($user, $total, $itemsToProcess) {
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'total_amount' => $total,
                'status' => 'pending'
            ]);

            foreach ($itemsToProcess as $data) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $data['menu']->id,
                    'quantity' => $data['qty'],
                    'price' => $data['menu']->price,
                    'subtotal' => $data['menu']->price * $data['qty']
                ]);
                $data['menu']->decrement('stock', $data['qty']);
            }
        });

        if ($user->role == 'pelanggan')
            return redirect()->route('orders.history');
        return redirect()->route('orders.index');
    }

    public function history()
    {
        $user = Auth::user();

        if ($user->role == 'pelanggan') {
            $orders = Order::where('user_id', $user->id)->latest()->paginate(10);
        } else {
            $orders = Order::latest()->paginate(10);
        }

        return view('orders.history', compact('orders'));
    }
    public function updateStatus(Request $r, Order $order)
    {
        if ($r->status == 'batal' && $order->status != 'batal') {
            foreach ($order->orderItems as $item)
                $item->menu->increment('stock', $item->quantity);
        }
        $order->update(['status' => $r->status]);
        return back()->with('success', 'Status diupdate.');
    }
    public function show(Order $order)
    {
        if (Auth::user()->role === 'pelanggan' && $order->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('orders.show', compact('order'));
    }
}