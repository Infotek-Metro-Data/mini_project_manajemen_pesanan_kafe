@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    
    <div class="mb-6 flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('categories.index') }}" class="hover:text-amber-600 transition"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
        <span>/</span>
        <span class="text-gray-800 font-bold">Edit Data</span>
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-6 text-white">
            <h2 class="text-2xl font-bold flex items-center gap-3">
                <i class="fas fa-edit"></i> Edit Kategori
            </h2>
            <p class="text-amber-100 text-sm mt-1">Perbarui informasi kategori <b>"{{ $category->name }}"</b>.</p>
        </div>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="p-8 space-y-6">
            @csrf @method('PUT')
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-tag text-gray-400"></i>
                    </div>
                    <input type="text" name="name" value="{{ $category->name }}" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" class="w-full p-4 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" rows="3">{{ $category->description }}</textarea>
            </div>

            <div class="pt-4 flex items-center gap-3">
                <button type="submit" class="flex-1 bg-amber-500 text-white font-bold py-3 rounded-xl shadow-lg hover:bg-amber-600 hover:shadow-amber-500/30 transition transform hover:-translate-y-1">
                    Update Data
                </button>
                <a href="{{ route('categories.index') }}" class="px-6 py-3 rounded-xl bg-gray-100 text-gray-600 font-bold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection