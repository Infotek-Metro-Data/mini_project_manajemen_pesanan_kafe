@extends('layouts.app')

@section('title', 'Kasir Terminal')

@section('content')

<style>
    .bg-animated {
        background: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .hover-scale {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.2);
    }

    .glass-white {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
    }

    .text-gradient-welcome {
        background: linear-gradient(to right, #ff00cc, #333399);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<div class="bg-animated"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 glass-white p-6 rounded-3xl">
        <div class="flex items-center gap-5">
            <div class="h-16 w-16 rounded-full bg-gradient-to-br from-fuchsia-500 to-purple-600 p-1 shadow-lg">
                <div class="h-full w-full bg-white rounded-full flex items-center justify-center text-2xl font-bold text-purple-600">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
            <div>
                <h1 class="text-3xl font-black text-gray-800">
                    Halo, <span class="text-gradient-welcome">{{ auth()->user()->name }}</span>!
                </h1>
                <div class="flex items-center gap-2 mt-1">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <p class="text-sm text-gray-500 font-medium">Kasir Aktif • Siap Tempur</p>
                </div>
            </div>
        </div>

        <div class="mt-4 md:mt-0 text-right bg-gray-50 px-6 py-2 rounded-2xl border border-gray-200">
            <div class="text-4xl font-black text-gray-800 font-mono tracking-tighter" id="clock">00:00</div>
            <div class="text-xs text-gray-500 font-bold uppercase tracking-widest">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        
        <div class="rounded-3xl p-6 hover-scale bg-gradient-to-br from-orange-400 to-pink-500 text-white relative overflow-hidden shadow-xl shadow-orange-200">
            <div class="absolute -right-6 -top-6 opacity-20 rotate-12">
                <i class="fas fa-stopwatch text-9xl"></i>
            </div>
            <div class="relative z-10">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-bold text-orange-100 text-sm uppercase tracking-wider">Antrean Pending</p>
                        <h2 class="text-6xl font-black mt-2">{{ $pendingOrders }}</h2>
                    </div>
                    @if($pendingOrders > 0)
                    <div class="bg-white text-orange-600 px-3 py-1 rounded-lg text-xs font-bold shadow animate-bounce">
                        URGENT!
                    </div>
                    @endif
                </div>
                <p class="mt-4 text-sm font-medium opacity-90 border-t border-white/20 pt-2">
                    Segera proses pesanan masuk
                </p>
            </div>
        </div>

        <div class="rounded-3xl p-6 hover-scale bg-gradient-to-br from-emerald-400 to-cyan-500 text-white relative overflow-hidden shadow-xl shadow-emerald-200">
            <div class="absolute -right-6 -top-6 opacity-20 rotate-12">
                <i class="fas fa-money-bill-wave text-9xl"></i>
            </div>
            <div class="relative z-10">
                <p class="font-bold text-emerald-100 text-sm uppercase tracking-wider">Omzet Hari Ini</p>
                <h2 class="text-5xl font-black mt-2">Rp {{ number_format($todayRevenue/1000, 0) }}k</h2>
                <p class="mt-4 text-sm font-medium opacity-90 border-t border-white/20 pt-2 flex items-center gap-1">
                    <i class="fas fa-arrow-trend-up"></i> Pendapatan Bersih
                </p>
            </div>
        </div>

        <div class="rounded-3xl p-6 hover-scale bg-gradient-to-br from-blue-500 to-indigo-600 text-white relative overflow-hidden shadow-xl shadow-blue-200">
            <div class="absolute -right-6 -top-6 opacity-20 rotate-12">
                <i class="fas fa-receipt text-9xl"></i>
            </div>
            <div class="relative z-10">
                <p class="font-bold text-blue-100 text-sm uppercase tracking-wider">Total Transaksi</p>
                <h2 class="text-6xl font-black mt-2">{{ $todayOrders }}</h2>
                <p class="mt-4 text-sm font-medium opacity-90 border-t border-white/20 pt-2">
                    Struk tercetak hari ini
                </p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-4 px-2">
                <h3 class="text-xl font-extrabold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-list-ul text-blue-500"></i> Antrean Masuk
                </h3>
                <a href="{{ route('orders.index') }}" class="bg-white px-4 py-2 rounded-full text-sm font-bold text-gray-600 shadow-sm border border-gray-100 hover:text-blue-600 hover:shadow-md transition">
                    Lihat Semua
                </a>
            </div>

            <div class="space-y-4">
                @forelse($recentOrders as $order)
                <div class="bg-white p-5 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm border-l-8 {{ $order->status == 'pending' ? 'border-orange-400 shadow-orange-100' : 'border-gray-200' }} hover-scale transition">
                    
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <div class="h-14 w-14 rounded-2xl flex items-center justify-center text-white font-bold text-lg shadow-md
                            {{ $order->status == 'pending' ? 'bg-orange-500' : 'bg-gray-400' }}">
                            #{{ substr($order->order_number, -3) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-800">{{ $order->user->name }}</h4>
                            <div class="flex items-center gap-2 text-xs font-medium text-gray-500">
                                <span class="bg-gray-100 px-2 py-0.5 rounded">{{ $order->created_at->format('H:i') }}</span>
                                <span>•</span>
                                <span>{{ $order->orderItems->count() }} Menu</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center w-full sm:w-auto">
                        <span class="text-xl font-black text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>

                    <div class="w-full sm:w-auto">
                        @if($order->status === 'pending')
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="status" value="dibayar">
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-200 hover:shadow-blue-300 hover:-translate-y-1 transition flex items-center justify-center gap-2">
                                    <i class="fas fa-check-circle"></i> TERIMA
                                </button>
                            </form>
                        @else
                            <span class="block w-full text-center bg-gray-100 text-gray-400 font-bold py-3 px-6 rounded-xl border border-gray-200 cursor-not-allowed">
                                SELESAI
                            </span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="bg-white p-10 rounded-3xl text-center border-2 border-dashed border-gray-200">
                    <div class="bg-blue-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                        <i class="fas fa-mug-hot text-4xl text-blue-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-400">Antrean Kosong</h3>
                    <p class="text-gray-400">Belum ada pesanan baru yang masuk.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="glass-white p-6 rounded-3xl sticky top-24">
                <h3 class="text-lg font-extrabold text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fas fa-bolt text-yellow-500"></i> Menu Cepat
                </h3>
                
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('orders.create') }}" class="group flex items-center p-4 rounded-2xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-lg shadow-purple-200 hover:shadow-purple-300 hover:-translate-y-1 transition">
                        <div class="bg-white/20 p-3 rounded-xl mr-4 group-hover:rotate-12 transition">
                            <i class="fas fa-plus text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-lg">Order Baru</p>
                            <p class="text-xs text-purple-100 opacity-80">Input manual</p>
                        </div>
                    </a>

                    <a href="{{ route('orders.index') }}" class="group flex items-center p-4 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition">
                        <div class="bg-blue-50 text-blue-600 p-3 rounded-xl mr-4 group-hover:scale-110 transition">
                            <i class="fas fa-history text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-700">Riwayat</p>
                            <p class="text-xs text-gray-400">Cek transaksi</p>
                        </div>
                    </a>
                </div>

                <div class="mt-8 bg-gradient-to-br from-yellow-50 to-orange-50 p-4 rounded-2xl border border-yellow-100 text-center">
                    <p class="text-xs font-bold text-orange-400 uppercase mb-1">💡 Tips Hari Ini</p>
                    <p class="text-sm font-medium text-gray-600 italic">"Pelanggan yang puas adalah iklan terbaik."</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('clock').innerText = timeString;
    }
    setInterval(updateClock, 1000);
    updateClock(); 
</script>

@endsection