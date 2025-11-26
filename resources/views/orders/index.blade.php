@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
        transform: translateY(10px);
    }
    @keyframes fadeIn {
        to { opacity: 1; transform: translateY(0); }
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 animate-fade-in">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Kelola <span class="text-indigo-600">Pesanan</span>
            </h1>
            <p class="text-gray-500 mt-1">Pantau dan proses semua pesanan masuk dari pelanggan.</p>
        </div>
        <div class="mt-4 sm:mt-0 flex gap-3">
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200 flex items-center gap-2">
                <span class="w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></span>
                <span class="text-sm font-bold text-gray-700">Pending: {{ $orders->where('status', 'pending')->count() }}</span>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200 flex items-center gap-2">
                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                <span class="text-sm font-bold text-gray-700">Lunas: {{ $orders->where('status', 'dibayar')->count() }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100 animate-fade-in delay-1">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase text-gray-500 font-bold tracking-wider">
                        <th class="p-5">ID Order</th>
                        <th class="p-5">Pelanggan</th>
                        <th class="p-5 text-center">Item</th>
                        <th class="p-5">Total Pembayaran</th>
                        <th class="p-5 text-center">Status</th>
                        <th class="p-5 text-center">Waktu</th>
                        <th class="p-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-blue-50/30 transition duration-150 group">
                        
                        <td class="p-5">
                            <span class="font-mono text-sm font-bold text-gray-700 bg-gray-100 px-2 py-1 rounded-md border border-gray-200">
                                #{{ $order->order_number }}
                            </span>
                        </td>

                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold shadow-sm">
                                    {{ substr($order->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">{{ $order->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $order->user->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="p-5 text-center">
                            <span class="inline-block bg-indigo-50 text-indigo-600 text-xs font-bold px-2.5 py-1 rounded-full">
                                {{ $order->orderItems->sum('quantity') }} Items
                            </span>
                        </td>

                        <td class="p-5">
                            <p class="font-extrabold text-gray-900 text-sm">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </td>

                        <td class="p-5 text-center">
                            @if($order->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-ping"></span> Pending
                                </span>
                            @elseif($order->status === 'dibayar')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    <i class="fas fa-check-circle"></i> Lunas
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200">
                                    <i class="fas fa-times-circle"></i> Batal
                                </span>
                            @endif
                        </td>

                        <td class="p-5 text-center text-xs text-gray-500">
                            <div class="font-medium">{{ $order->created_at->format('d M Y') }}</div>
                            <div class="text-gray-400">{{ $order->created_at->format('H:i') }}</div>
                        </td>

                        <td class="p-5 text-center">
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="flex justify-center items-center gap-2">
                                @csrf
                                
                                @if($order->status === 'pending')
                                    <button name="status" value="dibayar" class="bg-green-50 hover:bg-green-100 text-green-600 hover:text-green-700 p-2 rounded-lg transition shadow-sm border border-green-200" title="Terima Pembayaran">
                                        <i class="fas fa-check text-lg"></i>
                                    </button>

                                    <button name="status" value="batal" class="bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 p-2 rounded-lg transition shadow-sm border border-red-200" title="Batalkan Pesanan" onclick="return confirm('Yakin batalkan pesanan ini?')">
                                        <i class="fas fa-times text-lg"></i>
                                    </button>
                                @else
                                    <span class="text-gray-300 text-lg">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                @endif
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <div class="bg-gray-50 p-4 rounded-full mb-3">
                                    <i class="fas fa-clipboard-list text-4xl text-gray-300"></i>
                                </div>
                                <p class="text-lg font-medium text-gray-600">Tidak ada pesanan saat ini.</p>
                                <p class="text-sm">Pesanan baru akan muncul di sini secara otomatis.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection