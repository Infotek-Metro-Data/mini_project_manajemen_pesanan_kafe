@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6">Tambah Kategori Baru</h2>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                <input type="text" name="name"
                    class="w-full border p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required
                    placeholder="Contoh: Makanan Berat">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi (Opsional)</label>
                <textarea name="description"
                    class="w-full border p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"
                    placeholder="Deskripsi singkat..."></textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('categories.index') }}"
                    class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
@endsection