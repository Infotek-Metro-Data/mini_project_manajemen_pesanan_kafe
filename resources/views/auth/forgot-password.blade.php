@extends('layouts.app')

@section('title', 'Lupa Password')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Lupa Password</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-500 text-white p-3 mb-4 rounded">{{ session('error') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <label class="block mb-2 font-semibold">Email</label>
        <input type="email" name="email" class="border p-2 rounded w-full mb-4" required>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full">
            Kirim Link Reset
        </button>
    </form>
</div>
@endsection
