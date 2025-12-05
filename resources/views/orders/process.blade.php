@extends('layouts.app')

@section('title', 'Proses Pesanan')

@section('content')

    <h1 class="text-2xl font-bold mb-4">Proses Pesanan</h1>

    <div class="space-y-6">

        @foreach ($orders as $order)

            <div class="bg-white p-5 rounded shadow">

                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="font-semibold">Pesanan #{{ $order->id }}</h2>
                        <p class="text-gray-500 text-sm">
                            Pelanggan: <span class="font-medium">{{ $order->user->name }}</span>
                        </p>
                        <p class="text-gray-500 text-sm">
                            Dibuat: {{ $order->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    @if ($order->status == 'pending')
                        <span class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Pending</span>
                    @elseif ($order->status == 'dibayar')
                        <span class="bg-green-600 text-white px-3 py-1 rounded text-sm">Dibayar</span>
                    @else
                        <span class="bg-red-600 text-white px-3 py-1 rounded text-sm">Dibatalkan</span>
                    @endif
                </div>

                <hr class="my-4">

                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2">Menu</th>
                            <th class="p-2">Qty</th>
                            <th class="p-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="p-2 border">{{ $item->menu->name }}</td>
                                <td class="p-2 border">{{ $item->qty }}</td>
                                <td class="p-2 border">Rp {{ number_format($item->subtotal) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr class="my-4">

                @if ($order->bukti_pembayaran)
                    <p class="font-semibold mb-2">Bukti Pembayaran:</p>
                    <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" class="h-40 rounded shadow mb-4">
                @else
                    <p class="text-gray-500 italic mb-4">Belum ada bukti pembayaran.</p>
                @endif

                <form action="{{ route('orders.process.update', $order->id) }}" method="POST" class="flex gap-4">
                    @csrf

                    <select name="status" class="border p-2 rounded" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="dibayar" {{ $order->status == 'dibayar' ? 'selected' : '' }}>
                            Tandai Dibayar
                        </option>
                        <option value="batal" {{ $order->status == 'batal' ? 'selected' : '' }}>
                            Batalkan Pesanan
                        </option>
                    </select>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </form>

            </div>

        @endforeach

        @if ($orders->isEmpty())
            <p class="text-center text-gray-500">Belum ada pesanan.</p>
        @endif

    </div>

@endsection