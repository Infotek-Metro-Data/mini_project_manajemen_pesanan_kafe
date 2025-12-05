<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function dashboard()
    {
        $menus = Menu::with('category')->get();
        return view('pelanggan.dashboard', compact('menus'));
    }

    public function storeOrder(Request $request)
    {
        Order::create([
            'menu_id' => $request->menu_id,
            'qty'     => $request->qty,
            'user_id' => auth()->id(),
            'status'  => 'pending',
        ]);

        return back()->with('success', 'Pesanan berhasil ditambahkan!');
    }
}
