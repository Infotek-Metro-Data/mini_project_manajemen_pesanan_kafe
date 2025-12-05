@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<style>
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

    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 10px 30px -5px rgba(245, 158, 11, 0.15); 
        transition: all 0.3s ease;
    }
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -5px rgba(245, 158, 11, 0.25);
        border-color: #fcd34d;
    }

    .text-gradient {
        background: linear-gradient(to right, #d97706, #dc2626);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    .floating-icon { animation: float 3s ease-in-out infinite; }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-20">

    <div class="flex flex-col md:flex-row justify-between items-center mb-10 animate-entry">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900">
                Selamat Datang, <span class="text-gradient">{{ auth()->user()->name }}</span>! 👋
            </h1>
            <p class="text-gray-500 mt-2 text-lg">Perut kenyang, hati senang. Mau pesan apa hari ini?</p>
        </div>
        <div class="mt-4 md:mt-0">
            <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-bold border border-orange-200 flex items-center gap-2">
                <i class="fas fa-star text-orange-500"></i> Member Pelanggan
            </span>
        </div>
    </div>

    <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-12 animate-entry delay-1 group">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-800 z-0"></div>
        <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1000&q=80" 
             class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:scale-105 transition duration-700 ease-in-out z-0" alt="Cafe Background">
        
        <div class="relative z-10 p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-white max-w-lg">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 leading-tight">Nikmati Kopi & Makanan Terbaik di Kota Ini ☕</h2>
                <p class="text-gray-200 mb-6">Pesan sekarang tanpa antri, bayar mudah, dan nikmati pesananmu.</p>
                <a href="{{ route('orders.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-orange-500/50 transform hover:scale-105 transition text-lg">
                    <i class="fas fa-utensils"></i> Pesan Sekarang
                </a>
            </div>
            <div class="hidden md:block text-9xl opacity-80 floating-icon drop-shadow-2xl">
                🍔
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 animate-entry delay-2">
        
        <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
            <div>
                <p class="text-gray-500 font-medium mb-1">Total Jajan Kamu</p>
                <h3 class="text-3xl font-extrabold text-gray-800">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h3>
                <p class="text-xs text-green-600 mt-1 font-bold"><i class="fas fa-arrow-up"></i> Terima kasih!</p>
            </div>
            <div class="bg-green-100 w-14 h-14 rounded-full flex items-center justify-center text-green-600 text-2xl shadow-inner">
                <i class="fas fa-wallet"></i>
            </div>
        </div>

        <a href="{{ route('orders.history') }}" class="glass-card p-6 rounded-2xl flex items-center justify-between group cursor-pointer">
            <div>
                <p class="text-gray-500 font-medium mb-1">Riwayat Pesanan</p>
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $myOrders->count() }} <span class="text-sm text-gray-400 font-normal">Kali</span></h3>
                <p class="text-xs text-blue-600 mt-1 font-bold group-hover:underline">Lihat Detail &rarr;</p>
            </div>
            <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center text-blue-600 text-2xl shadow-inner group-hover:scale-110 transition">
                <i class="fas fa-receipt"></i>
            </div>
        </a>

    </div>

    @if($menus->isNotEmpty())
    <div class="animate-entry delay-3">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <span class="text-orange-500">🔥</span> Rekomendasi Hari Ini
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($menus as $menu)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 group">
                <div class="relative h-48 overflow-hidden">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                            <i class="fas fa-image text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800 shadow-sm">
                        {{ $menu->category->name }}
                    </div>
                </div>
                <div class="p-5">
                    <h4 class="font-bold text-lg text-gray-900 mb-1">{{ $menu->name }}</h4>
                    <p class="text-amber-600 font-extrabold text-xl">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    
                    <form action="{{ route('orders.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="items[0][menu_id]" value="{{ $menu->id }}">
                        <input type="hidden" name="items[0][quantity]" value="1">
                        <button type="submit" class="w-full bg-gray-900 text-white font-bold py-2 rounded-xl hover:bg-gray-800 transition shadow-md flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i> Pesan Cepat (1)
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

<script>
    function welcomeFireworks() {
        var duration = 2 * 1000;
        var animationEnd = Date.now() + duration;
        var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

        function randomInRange(min, max) { return Math.random() * (max - min) + min; }

        var interval = setInterval(function() {
            var timeLeft = animationEnd - Date.now();
            if (timeLeft <= 0) return clearInterval(interval);
            var particleCount = 50 * (timeLeft / duration);
            confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
            confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
        }, 250);
    }

    document.addEventListener('DOMContentLoaded', function() {
        welcomeFireworks();
    });
</script>

@endsection