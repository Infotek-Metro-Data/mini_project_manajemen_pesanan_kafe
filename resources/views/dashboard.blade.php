@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #f59e0b;
        }

        @keyframes softPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .icon-pulse:hover i {
            animation: softPulse 1s infinite;
        }
    </style>

    <div class="px-4 sm:px-6 lg:px-8 py-8 max-w-7xl mx-auto">

        <div class="flex justify-between items-end mb-10 animate-slide-up">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                    Dashboard <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-600">Admin</span>
                </h1>
                <p class="text-gray-500 mt-2 text-lg">Pantau performa kafe Anda hari ini.</p>
            </div>
            <button onclick="fireworks()"
                class="hidden md:flex items-center gap-2 bg-gray-900 text-white px-5 py-2.5 rounded-full hover:bg-gray-800 transition shadow-lg hover:shadow-xl transform hover:scale-105">
                <span class="text-xl">🎉</span> Rayakan
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div
                class="glass-card p-6 rounded-2xl animate-slide-up delay-100 border-l-4 border-blue-500 relative overflow-hidden group">
                <div
                    class="absolute right-0 top-0 opacity-10 transform translate-x-4 -translate-y-4 group-hover:scale-110 transition duration-500">
                    <i class="fas fa-utensils text-9xl text-blue-500"></i>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 font-medium">Total Menu</h3>
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-xl icon-pulse">
                            <i class="fas fa-utensils text-xl"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-800">{{ $totalMenus }}</p>
                    <p class="text-sm text-blue-600 mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-arrow-up"></i> Siap disajikan
                    </p>
                </div>
            </div>

            <div
                class="glass-card p-6 rounded-2xl animate-slide-up delay-200 border-l-4 border-green-500 relative overflow-hidden group">
                <div
                    class="absolute right-0 top-0 opacity-10 transform translate-x-4 -translate-y-4 group-hover:scale-110 transition duration-500">
                    <i class="fas fa-shopping-cart text-9xl text-green-500"></i>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 font-medium">Total Pesanan</h3>
                        <div class="bg-green-100 text-green-600 p-3 rounded-xl icon-pulse">
                            <i class="fas fa-shopping-cart text-xl"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-800">{{ $totalOrders }}</p>
                    <p class="text-sm text-green-600 mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-check-circle"></i> Transaksi tercatat
                    </p>
                </div>
            </div>

            <div
                class="glass-card p-6 rounded-2xl animate-slide-up delay-300 border-l-4 border-amber-500 relative overflow-hidden group">
                <div
                    class="absolute right-0 top-0 opacity-10 transform translate-x-4 -translate-y-4 group-hover:scale-110 transition duration-500">
                    <i class="fas fa-coins text-9xl text-amber-500"></i>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 font-medium">Pendapatan</h3>
                        <div class="bg-amber-100 text-amber-600 p-3 rounded-xl icon-pulse">
                            <i class="fas fa-money-bill-wave text-xl"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-800">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-amber-600 mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-chart-line"></i> Omzet masuk
                    </p>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1 space-y-6 animate-slide-up delay-200">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="bg-amber-100 text-amber-600 p-1.5 rounded-lg"><i class="fas fa-bolt"></i></span>
                        Aksi Cepat
                    </h2>

                    <div class="space-y-3">
                        <a href="{{ route('categories.create') }}"
                            class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-blue-50 hover:text-blue-600 transition group border border-gray-100 hover:border-blue-200">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                    <i class="fas fa-folder-plus"></i>
                                </div>
                                <span class="font-medium">Tambah Kategori</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-blue-500"></i>
                        </a>

                        <a href="{{ route('menus.create') }}"
                            class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-green-50 hover:text-green-600 transition group border border-gray-100 hover:border-green-200">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-green-100 text-green-600 w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <span class="font-medium">Tambah Menu</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-green-500"></i>
                        </a>

                        <a href="{{ route('menus.index') }}"
                            class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-purple-50 hover:text-purple-600 transition group border border-gray-100 hover:border-purple-200">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-purple-100 text-purple-600 w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                    <i class="fas fa-th-list"></i>
                                </div>
                                <span class="font-medium">Kelola Menu</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-purple-500"></i>
                        </a>

                        <a href="{{ route('orders.index') }}"
                            class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-orange-50 hover:text-orange-600 transition group border border-gray-100 hover:border-orange-200">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-orange-100 text-orange-600 w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <span class="font-medium">Lihat Pesanan</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-orange-500"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 animate-slide-up delay-300">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="bg-green-100 text-green-600 p-1.5 rounded-lg"><i class="fas fa-clock"></i></span>
                            Pesanan Terbaru
                        </h2>
                        <a href="{{ route('orders.index') }}"
                            class="text-sm text-amber-600 font-semibold hover:underline">Lihat Semua</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                                    <th class="p-4 font-semibold">ID Order</th>
                                    <th class="p-4 font-semibold">Pelanggan</th>
                                    <th class="p-4 font-semibold">Total</th>
                                    <th class="p-4 font-semibold text-center">Status</th>
                                    <th class="p-4 font-semibold text-right">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentOrders as $order)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="p-4 font-medium text-gray-900">#{{ $order->order_number }}</td>
                                        <td class="p-4 text-gray-600 flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500">
                                                {{ substr($order->user->name, 0, 1) }}
                                            </div>
                                            {{ $order->user->name }}
                                        </td>
                                        <td class="p-4 font-bold text-gray-800">Rp
                                            {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="p-4 text-center">
                                            @if($order->status === 'pending')
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                    Pending
                                                </span>
                                            @elseif($order->status === 'dibayar')
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                                    Lunas
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 border border-red-200">
                                                    Batal
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right text-gray-500 text-sm">
                                            {{ $order->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-gray-400">
                                            <i class="fas fa-inbox text-4xl mb-3"></i>
                                            <p>Belum ada pesanan masuk.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function fireworks() {
            var duration = 3 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function () {
                var timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                var particleCount = 50 * (timeLeft / duration);

                confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);
        }

        document.addEventListener('DOMContentLoaded', function () {
            fireworks();
        });
    </script>

@endsection