@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<style>
    /* Animasi Masuk */
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-entry {
        animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    /* Efek Kartu */
    .vibrant-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .vibrant-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
    }
    
    /* Icon Background Overlay */
    .bg-icon-overlay {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 8rem;
        opacity: 0.15;
        transform: rotate(-15deg);
        pointer-events: none;
        transition: transform 0.5s ease;
    }
    .vibrant-card:hover .bg-icon-overlay {
        transform: rotate(0deg) scale(1.1);
    }
</style>

<div class="px-4 sm:px-6 lg:px-8 py-8 max-w-7xl mx-auto bg-gray-50 min-h-screen">

    <div class="flex flex-col md:flex-row justify-between items-center mb-10 animate-entry">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
                Dashboard <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Admin</span>
            </h1>
            <p class="text-gray-500 mt-1 text-lg">Selamat bekerja, semangat pantau omzet! 🚀</p>
        </div>
        <button onclick="fireworks()" class="mt-4 md:mt-0 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition flex items-center gap-2 font-bold">
            <span>🎉</span> Rayakan Omzet
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="vibrant-card bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl p-6 text-white shadow-lg animate-entry delay-1">
            <i class="fas fa-utensils bg-icon-overlay"></i>
            <div class="relative z-10">
                <p class="text-pink-100 font-medium text-lg mb-1">Total Menu</p>
                <h2 class="text-5xl font-extrabold">{{ $totalMenus }}</h2>
                <div class="mt-4 inline-flex items-center bg-white/20 px-3 py-1 rounded-full text-sm backdrop-blur-sm">
                    <i class="fas fa-plus-circle mr-2"></i> Siap Saji
                </div>
            </div>
        </div>

        <div class="vibrant-card bg-gradient-to-br from-violet-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg animate-entry delay-2">
            <i class="fas fa-shopping-cart bg-icon-overlay text-white"></i>
            <div class="relative z-10">
                <p class="text-indigo-100 font-medium text-lg mb-1">Total Pesanan</p>
                <h2 class="text-5xl font-extrabold">{{ $totalOrders }}</h2>
                <div class="mt-4 inline-flex items-center bg-white/20 px-3 py-1 rounded-full text-sm backdrop-blur-sm">
                    <i class="fas fa-chart-line mr-2"></i> Transaksi Masuk
                </div>
            </div>
        </div>

        <div class="vibrant-card bg-gradient-to-br from-amber-400 to-orange-600 rounded-2xl p-6 text-white shadow-lg animate-entry delay-3">
            <i class="fas fa-wallet bg-icon-overlay"></i>
            <div class="relative z-10">
                <p class="text-yellow-100 font-medium text-lg mb-1">Pendapatan</p>
                <h2 class="text-4xl font-extrabold tracking-tight">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                <div class="mt-4 inline-flex items-center bg-white/20 px-3 py-1 rounded-full text-sm backdrop-blur-sm">
                    <i class="fas fa-coins mr-2"></i> Uang Masuk
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1 animate-entry delay-2 space-y-6">
            
            <div class="bg-white rounded-2xl shadow-md p-6 border-t-4 border-purple-500">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-purple-500 mr-2"></i> Shortcut
                </h3>
                
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('categories.create') }}" class="group flex items-center justify-between p-4 bg-cyan-50 rounded-xl border border-cyan-100 hover:bg-cyan-500 hover:text-white transition duration-300">
                        <div class="flex items-center gap-3">
                            <div class="bg-white text-cyan-500 w-10 h-10 rounded-full flex items-center justify-center shadow-sm">
                                <i class="fas fa-tags"></i>
                            </div>
                            <span class="font-semibold text-cyan-700 group-hover:text-white">Tambah Kategori</span>
                        </div>
                        <i class="fas fa-arrow-right text-cyan-300 group-hover:text-white"></i>
                    </a>

                    <a href="{{ route('menus.create') }}" class="group flex items-center justify-between p-4 bg-emerald-50 rounded-xl border border-emerald-100 hover:bg-emerald-500 hover:text-white transition duration-300">
                        <div class="flex items-center gap-3">
                            <div class="bg-white text-emerald-500 w-10 h-10 rounded-full flex items-center justify-center shadow-sm">
                                <i class="fas fa-plus"></i>
                            </div>
                            <span class="font-semibold text-emerald-700 group-hover:text-white">Tambah Menu</span>
                        </div>
                        <i class="fas fa-arrow-right text-emerald-300 group-hover:text-white"></i>
                    </a>

                    <a href="{{ route('menus.index') }}" class="group flex items-center justify-between p-4 bg-fuchsia-50 rounded-xl border border-fuchsia-100 hover:bg-fuchsia-500 hover:text-white transition duration-300">
                        <div class="flex items-center gap-3">
                            <div class="bg-white text-fuchsia-500 w-10 h-10 rounded-full flex items-center justify-center shadow-sm">
                                <i class="fas fa-list"></i>
                            </div>
                            <span class="font-semibold text-fuchsia-700 group-hover:text-white">Daftar Menu</span>
                        </div>
                        <i class="fas fa-arrow-right text-fuchsia-300 group-hover:text-white"></i>
                    </a>

                    <a href="{{ route('orders.index') }}" class="group flex items-center justify-between p-4 bg-orange-50 rounded-xl border border-orange-100 hover:bg-orange-500 hover:text-white transition duration-300">
                        <div class="flex items-center gap-3">
                            <div class="bg-white text-orange-500 w-10 h-10 rounded-full flex items-center justify-center shadow-sm">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <span class="font-semibold text-orange-700 group-hover:text-white">Lihat Pesanan</span>
                        </div>
                        <i class="fas fa-arrow-right text-orange-300 group-hover:text-white"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 animate-entry delay-3">
            <div class="bg-white rounded-2xl shadow-md border-t-4 border-blue-500 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <h3 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-clock text-blue-500 mr-2"></i> Pesanan Masuk
                    </h3>
                    <a href="{{ route('orders.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider">
                                <th class="p-4">ID Order</th>
                                <th class="p-4">Pelanggan</th>
                                <th class="p-4">Total</th>
                                <th class="p-4 text-center">Status</th>
                                <th class="p-4 text-right">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentOrders as $order)
                            <tr class="hover:bg-blue-50 transition duration-200">
                                <td class="p-4 font-bold text-gray-700">#{{ $order->order_number }}</td>
                                <td class="p-4 font-medium text-gray-600">{{ $order->user->name }}</td>
                                <td class="p-4 font-bold text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="p-4 text-center">
                                    @if($order->status === 'pending')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-400 text-white shadow-sm">
                                            PENDING
                                        </span>
                                    @elseif($order->status === 'dibayar')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow-sm">
                                            LUNAS
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500 text-white shadow-sm">
                                            BATAL
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right text-gray-500 text-sm">
                                    {{ $order->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-gray-400">
                                    <i class="fas fa-box-open text-5xl mb-3 opacity-30"></i>
                                    <p>Belum ada pesanan masuk hari ini.</p>
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
        var count = 200;
        var defaults = {
            origin: { y: 0.7 }
        };

        function fire(particleRatio, opts) {
            confetti(Object.assign({}, defaults, opts, {
                particleCount: Math.floor(count * particleRatio)
            }));
        }

        fire(0.25, { spread: 26, startVelocity: 55, colors: ['#ff0000', '#ffa500'] });
        fire(0.2, { spread: 60, colors: ['#00ff00', '#0000ff'] });
        fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8, colors: ['#ffff00', '#ff00ff'] });
        fire(0.1, { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2 });
        fire(0.1, { spread: 120, startVelocity: 45 });
    }

    // Meledak saat loading
    document.addEventListener('DOMContentLoaded', function() {
        fireworks();
    });
</script>

@endsection