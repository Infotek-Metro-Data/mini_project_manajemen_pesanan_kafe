@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')

    <style>
        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-entry {
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #4f46e5, #db2777);
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 animate-entry">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">
                    Riwayat <span class="text-gradient">Pesanan</span>
                </h1>
                <p class="text-gray-500 mt-1">Pantau semua status transaksi Anda di sini.</p>
            </div>

            @if($orders->count() > 0)
                <div
                    class="mt-4 md:mt-0 bg-white px-5 py-2 rounded-full shadow-sm border border-gray-200 flex items-center gap-2">
                    <span class="bg-blue-100 text-blue-600 text-xs font-bold px-2 py-1 rounded-full">Total</span>
                    <span class="font-bold text-gray-700">{{ $orders->total() }} Pesanan</span>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 animate-entry delay-1">
            <div
                class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl p-4 text-white shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">Menunggu Pembayaran</p>
                    <p class="text-2xl font-bold">{{ $orders->where('status', 'pending')->count() }}</p>
                </div>
                <div class="bg-white/20 p-2 rounded-lg">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-emerald-400 to-teal-600 rounded-xl p-4 text-white shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Berhasil Dibayar</p>
                    <p class="text-2xl font-bold">{{ $orders->where('status', 'dibayar')->count() }}</p>
                </div>
                <div class="bg-white/20 p-2 rounded-lg">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-4 text-white shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Transaksi</p>
                    <p class="text-2xl font-bold">
                        <?php 
                            $totalPage = 0;
    foreach ($orders as $o)
        if ($o->status == 'dibayar')
            $totalPage += $o->total_amount;
                        ?>
                        Rp {{ number_format($totalPage, 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-white/20 p-2 rounded-lg">
                    <i class="fas fa-wallet text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 animate-entry delay-2">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No.
                                Order</th>

                            @if(auth()->user()->role !== 'pelanggan')
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Pelanggan</th>
                            @endif

                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-blue-50/50 transition duration-200 group">

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</div>
                                    <div class="text-xs text-gray-400">{{ $order->orderItems->count() }} item</div>
                                </td>

                                @if(auth()->user()->role !== 'pelanggan')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs mr-3">
                                                {{ substr($order->user->name, 0, 1) }}
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                        </div>
                                    </td>
                                @endif

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">Rp
                                        {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($order->status === 'pending')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">
                                            <i class="fas fa-clock mr-1 mt-0.5"></i> Pending
                                        </span>
                                    @elseif($order->status === 'dibayar')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            <i class="fas fa-check-circle mr-1 mt-0.5"></i> Lunas
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-700 border border-red-200">
                                            <i class="fas fa-times-circle mr-1 mt-0.5"></i> Batal
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                    {{ $order->created_at->format('d M Y') }}
                                    <span class="block text-xs text-gray-400">{{ $order->created_at->format('H:i') }}</span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none transition shadow-sm">
                                        Detail
                                        <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-gray-100 p-4 rounded-full mb-3">
                                            <i class="fas fa-receipt text-3xl text-gray-400"></i>
                                        </div>
                                        <p class="text-lg font-medium text-gray-900">Belum ada pesanan</p>
                                        <p class="text-sm text-gray-400 mb-4">Pesanan yang Anda buat akan muncul di sini.</p>

                                        @if(auth()->user()->role === 'pelanggan')
                                            <a href="{{ route('orders.create') }}"
                                                class="text-indigo-600 hover:text-indigo-800 font-medium">
                                                Buat Pesanan Baru &rarr;
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection