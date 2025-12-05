<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BuktiPembayaranController extends Controller
{
    public function upload(Request $request, Order $order)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('bukti')->store('bukti', 'public');

        $order->update([
            'bukti_pembayaran' => $path
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload');
    }
}
