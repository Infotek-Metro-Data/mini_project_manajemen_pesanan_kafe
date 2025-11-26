@extends('layouts.app')

@section('title', 'Pesan Menu')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-card {
            animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
        }

        @for ($i = 1; $i <= 20; $i++)
            .delay-{{ $i }} {
                animation-delay:
                    {{ $i * 0.05 }}
                    s;
            }

        @endfor input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .text-gradient {
            background: linear-gradient(to right, #f59e0b, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .floating-bar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 -10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-32">

        <div class="text-center mb-12 animate-card">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
                Mau Makan <span class="text-gradient">Apa Hari Ini?</span> 😋
            </h1>
            <p class="text-gray-500 text-lg">Pilih menu favoritmu, kami siapkan dengan cinta.</p>
        </div>

        <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($menus as $index => $menu)
                    <div
                        class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 animate-card delay-{{ $loop->iteration }} group">

                        <div class="relative h-56 overflow-hidden bg-gray-100">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out"
                                    alt="{{ $menu->name }}">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-300">
                                    <i class="fas fa-utensils text-5xl"></i>
                                </div>
                            @endif

                            <div class="absolute top-3 right-3">
                                @if($menu->stock > 5)
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-green-600 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                        Stok: {{ $menu->stock }}
                                    </span>
                                @else
                                    <span
                                        class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm animate-pulse">
                                        Sisa: {{ $menu->stock }}
                                    </span>
                                @endif
                            </div>

                            <div class="absolute bottom-3 left-3">
                                <span class="bg-black/60 backdrop-blur-sm text-white text-xs font-medium px-3 py-1 rounded-lg">
                                    {{ $menu->category->name }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-lg text-gray-800 leading-tight">{{ $menu->name }}</h3>
                            </div>

                            <p class="text-gray-500 text-sm line-clamp-2 mb-4 min-h-[40px]">
                                {{ $menu->description ?? 'Menu lezat siap memanjakan lidah Anda.' }}
                            </p>

                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-50">
                                <div class="text-xl font-extrabold text-amber-600">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </div>

                                <div class="flex items-center bg-gray-100 rounded-full p-1">
                                    <input type="hidden" name="items[{{ $index }}][menu_id]" value="{{ $menu->id }}">

                                    <button type="button" onclick="updateQty({{ $index }}, -1, {{ $menu->stock }})"
                                        class="w-8 h-8 rounded-full bg-white text-gray-600 shadow-sm hover:bg-gray-200 flex items-center justify-center transition">
                                        <i class="fas fa-minus text-xs"></i>
                                    </button>

                                    <input type="number" id="qty-{{ $index }}" name="items[{{ $index }}][quantity]" value="0"
                                        readonly
                                        class="w-10 text-center bg-transparent border-none text-gray-800 font-bold focus:ring-0 p-0 text-sm">

                                    <button type="button" onclick="updateQty({{ $index }}, 1, {{ $menu->stock }})"
                                        class="w-8 h-8 rounded-full bg-amber-500 text-white shadow-md hover:bg-amber-600 hover:scale-110 flex items-center justify-center transition">
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="fixed bottom-0 left-0 right-0 floating-bar z-50 transform transition-transform duration-300 translate-y-full"
                id="checkoutBar">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="bg-amber-100 text-amber-600 w-12 h-12 rounded-full flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-xl animate-bounce"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs uppercase font-bold tracking-wider">Total Pesanan</p>
                            <p class="text-gray-900 font-bold text-lg"><span id="totalItems">0</span> Item Dipilih</p>
                        </div>
                    </div>

                    <button type="button" onclick="submitOrder()"
                        class="bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-green-500/30 transform hover:scale-105 transition flex items-center gap-2">
                        Checkout Sekarang <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>

        </form>
    </div>

    <script>
        function updateQty(index, change, maxStock) {
            const input = document.getElementById(`qty-${index}`);
            let currentQty = parseInt(input.value);
            let newQty = currentQty + change;

            if (newQty >= 0 && newQty <= maxStock) {
                input.value = newQty;
                updateFloatingBar();
            }
        }

        function updateFloatingBar() {
            const inputs = document.querySelectorAll('input[type="number"]');
            let totalQty = 0;

            inputs.forEach(input => {
                totalQty += parseInt(input.value);
            });

            const bar = document.getElementById('checkoutBar');
            const counter = document.getElementById('totalItems');

            counter.innerText = totalQty;

            if (totalQty > 0) {
                bar.classList.remove('translate-y-full');
            } else {
                bar.classList.add('translate-y-full');
            }
        }

        function submitOrder() {
            var duration = 2 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 9999 };

            function randomInRange(min, max) { return Math.random() * (max - min) + min; }

            var interval = setInterval(function () {
                var timeLeft = animationEnd - Date.now();
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    document.getElementById('orderForm').submit();
                    return;
                }
                var particleCount = 50 * (timeLeft / duration);
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);
        }
    </script>

@endsection