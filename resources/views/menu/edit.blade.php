@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Menu</h2>
    
    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-bold mb-2">Nama Menu</label>
                <input type="text" name="name" value="{{ $menu->name }}" class="w-full border p-3 rounded" required>
            </div>
            <div>
                <label class="block font-bold mb-2">Kategori</label>
                <select name="category_id" class="w-full border p-3 rounded" required>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ $menu->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ $menu->price }}" class="w-full border p-3 rounded" required>
            </div>
            <div>
                <label class="block font-bold mb-2">Stok</label>
                <input type="number" name="stock" value="{{ $menu->stock }}" class="w-full border p-3 rounded" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Ganti Foto (Opsional)</label>
            @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" class="h-20 mb-2 rounded">
            @endif
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <div class="mb-6">
            <label class="block font-bold mb-2">Deskripsi</label>
            <textarea name="description" class="w-full border p-3 rounded" rows="3">{{ $menu->description }}</textarea>
        </div>

        <button class="w-full bg-green-600 text-white font-bold py-3 rounded hover:bg-green-700">Update Menu</button>
    </form>
</div>
@endsection