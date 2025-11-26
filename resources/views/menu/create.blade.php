@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6">Tambah Menu Baru</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Gagal Menyimpan!</strong>
                <ul class="mt-1 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold mb-2">Nama Menu <span class="text-red-500">*</span></label>
                    <input type="text" name="name" class="w-full border p-3 rounded" value="{{ old('name') }}" required>
                </div>
                <div>
                    <label class="block font-bold mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" class="w-full border p-3 rounded" required>
                        <option value="">-- Pilih --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($categories->isEmpty())
                        <p class="text-xs text-red-500 mt-1">Belum ada kategori! <a href="{{ route('categories.create') }}"
                                class="underline">Buat dulu disini.</a></p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" class="w-full border p-3 rounded" value="{{ old('price') }}" required>
                </div>
                <div>
                    <label class="block font-bold mb-2">Stok Awal <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" class="w-full border p-3 rounded" value="{{ old('stock') }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">Foto Menu</label>
                <input type="file" name="image" class="w-full border p-2 rounded">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Max 2MB)</p>
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-2">Deskripsi</label>
                <textarea name="description" class="w-full border p-3 rounded" rows="3">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-rose-600 text-white font-bold py-3 rounded hover:bg-rose-700">Simpan
                Menu</button>
        </form>
    </div>
@endsection