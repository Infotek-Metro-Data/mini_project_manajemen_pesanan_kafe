@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">+ Tambah Kategori</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Deskripsi</th>
                    <th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-semibold">{{ $category->name }}</td>
                    <td class="p-4 text-gray-500">{{ $category->description ?? '-' }}</td>
                    <td class="p-4 text-right flex justify-end gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-600 hover:text-yellow-800">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection