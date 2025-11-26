@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <a href="{{ route('orders.history') }}" class="text-gray-500 hover:text-amber-600 mb-6 inline-block transition">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Riwayat
        </a>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

            <div
                class="bg-gray-50 p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Order #{{ $order->order_number }}</h1>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    @if($order->status === 'pending')
                        <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full font-bold text-sm">
                            <i class="fas fa-clock mr-1"></i> Menunggu Pembayaran
                        </span>
                    @elseif($order->status === 'dibayar')
                        <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-bold text-sm">
                            <i class="fas fa-check-circle mr-1"></i> Lunas / Diproses
                        </span>
                    @else
                        <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full font-bold text-sm">
                            <i class="fas fa-times-circle mr-1"></i> Dibatalkan
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-700 mb-4">Rincian Pesanan</h3>
                <div class="border rounded-lg overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="p-3">Menu</th>
                                <th class="p-3 text-center">Qty</th>
                                <th class="p-3 text-right">Harga</th>
                                <th class="p-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="p-3 font-medium">{{ $item->menu->name }}</td>
                                    <td class="p-3 text-center">{{ $item->quantity }}</td>
                                    <td class="p-3 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="p-3 text-right font-semibold">Rp
                                        {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 font-bold">
                            <tr>
                                <td colspan="3" class="p-4 text-right text-gray-600">Total Pembayaran</td>
                                <td class="p-4 text-right text-amber-600 text-lg">Rp
                                    {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="p-6 bg-amber-50 border-t border-amber-100">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Bukti Pembayaran</h3>

                @if($order->payment_proof)
                    <div class="mt-3">
                        <p class="text-green-600 text-sm font-semibold mb-2"><i class="fas fa-check mr-1"></i> Bukti berhasil
                            diupload</p>
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Bayar"
                            class="h-48 rounded-lg shadow border border-gray-200">
                    </div>
                @else
                    @if($order->status === 'pending')
                        <p class="text-sm text-gray-600 mb-4">Silakan transfer dan upload foto bukti pembayaran di bawah ini agar
                            pesanan diproses.</p>

                        <form action="{{ route('orders.uploadProof', $order->id) }}" method="POST" enctype="multipart/form-data"
                            class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                            @csrf
                            <input type="file" name="proof" class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-amber-100 file:text-amber-700
                                        hover:file:bg-amber-200
                                    " required>

                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                                Upload
                            </button>
                        </form>
                    @else
                        <p class="text-sm text-gray-500 italic">Upload bukti ditutup (Status: {{ $order->status }}).</p>
                    @endif
                @endif
            </div>

        </div>
    </div>
@endsection