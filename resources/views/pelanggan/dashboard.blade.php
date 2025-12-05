@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.9s ease-out;
        }

        .chakra-glow {
            box-shadow: 0 0 15px rgba(255, 115, 0, 0.4);
            transition: 0.3s;
        }

        .chakra-glow:hover {
            box-shadow: 0 0 30px rgba(255, 115, 0, 0.7);
            transform: translateY(-4px);
        }

        @keyframes rasengan {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .rasengan:hover i {
            animation: rasengan 0.5s linear infinite;
        }

        @keyframes shakeNinja {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-2px);
            }

            50% {
                transform: translateX(2px);
            }

            75% {
                transform: translateX(-2px);
            }

            100% {
                transform: translateX(0);
            }
        }

        .shake:hover {
            animation: shakeNinja 0.3s ease-in-out;
        }
    </style>

    <div class="px-4 sm:px-0 fade-in">

        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-2">
            <i class="fas fa-tachometer-alt text-amber-600"></i>
            Dashboard Admin
            <span class="text-orange-600 text-xl animate-pulse">🔥</span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 chakra-glow shake">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Menu</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalMenus }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-4">
                        <i class="fas fa-utensils text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 chakra-glow shake">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Pesanan</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-4">
                        <i class="fas fa-shopping-cart text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-amber-500 chakra-glow shake">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Pendapatan</p>
                        <p class="text-3xl font-bold text-gray-900">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-amber-100 rounded-full p-4">
                        <i class="fas fa-money-bill-wave text-2xl text-amber-600"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8 fade-in chakra-glow">

            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-bolt text-amber-600 mr-2"></i>Aksi Cepat
                <span class="ml-2 text-orange-500 animate-pulse">⚡</span>
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                <a href="{{ route('categories.create') }}"
                    class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg p-4 text-center rasengan hover:scale-105 transition-all shadow-md">
                    <i class="fas fa-plus-circle text-2xl mb-2"></i>
                    <p class="text-sm font-semibold">Tambah Kategori</p>
                </a>

                <a href="{{ route('menus.create') }}"
                    class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg p-4 text-center rasengan hover:scale-105 transition-all shadow-md">
                    <i class="fas fa-plus-circle text-2xl mb-2"></i>
                    <p class="text-sm font-semibold">Tambah Menu</p>
                </a>

                <a href="{{ route('menus.index') }}"
                    class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg p-4 text-center rasengan hover:scale-105 transition-all shadow-md">
                    <i class="fas fa-list text-2xl mb-2"></i>
                    <p class="text-sm font-semibold">Kelola Menu</p>
                </a>

                <a href="{{ route('orders.index') }}"
                    class="bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-lg p-4 text-center rasengan hover:scale-105 transition-all shadow-md">
                    <i class="fas fa-shopping-cart text-2xl mb-2"></i>
                    <p class="text-sm font-semibold">Lihat Pesanan</p>
                </a>

            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow-md p-6 fade-in">

            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-clock text-amber-600 mr-2"></i>Pesanan Terbaru
            </h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                                Pesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition-all">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $order->order_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $order->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($order->status === 'pending')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i> Pending
                                        </span>
                                    @elseif($order->status === 'dibayar')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i> Dibayar
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            <i class="fas fa-times mr-1"></i> Batal
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-2"></i>
                                    <p>Belum ada pesanan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

@endsection