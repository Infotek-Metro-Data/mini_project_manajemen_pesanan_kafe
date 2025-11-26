@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Menu Makanan & Minuman</h1>
        <a href="{{ route('menus.create') }}" class="bg-rose-600 text-white px-4 py-2 rounded shadow hover:bg-rose-700">+ Tambah Menu</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-4 text-left">Foto</th>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Kategori</th>
                    <th class="p-4 text-left">Harga</th>
                    <th class="p-4 text-left">Stok</th>
                    <th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-xs">No Image</div>
                        @endif
                    </td>
                    <td class="p-4 font-bold">{{ $menu->name }}</td>
                    <td class="p-4"><span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">{{ $menu->category->name }}</span></td>
                    <td class="p-4">Rp {{ number_format($menu->price) }}</td>
                    <td class="p-4 {{ $menu->stock < 10 ? 'text-red-500 font-bold' : '' }}">{{ $menu->stock }}</td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection