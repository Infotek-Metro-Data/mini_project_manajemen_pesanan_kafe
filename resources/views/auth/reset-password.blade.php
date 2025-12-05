@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<h1 class="text-2xl font-bold mb-4">Reset Password</h1>

<form action="{{ route('password.update') }}" method="POST" class="bg-white p-6 rounded shadow w-full max-w-md">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <label class="font-semibold block mb-1">Email</label>
    <input type="email" name="email" class="border p-2 rounded w-full mb-4" required>

    <label class="font-semibold block mb-1">Password Baru</label>
    <input type="password" name="password" class="border p-2 rounded w-full mb-4" required>

    <label class="font-semibold block mb-1">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="border p-2 rounded w-full mb-4" required>

    <button class="bg-green-600 text-white px-4 py-2 rounded w-full">Reset Password</button>
</form>

@endsection
