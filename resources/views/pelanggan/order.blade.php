@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4 text-center">Pesan Menu</h2>

    <form action="{{ route('pelanggan.order.store') }}" method="POST">
        @csrf

        <label class="block mb-2 font-semibold">Pilih Menu</label>
        <select name="menu_id" class="w-full border rounded p-2 mb-4" required>
            <option value="">-- Pilih Menu --</option>
            @foreach ($menus as $menu)
                <option value="{{ $menu->id }}">
                    {{ $menu->name }} - Rp{{ number_format($menu->price) }}
                </option>
            @endforeach
        </select>

        <label class="block mb-2 font-semibold">Jumlah Pesanan</label>
        <input type="number" name="qty" class="w-full border rounded p-2 mb-4" min="1" required>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Pesan Sekarang
        </button>
    </form>
</div>
@endsection
