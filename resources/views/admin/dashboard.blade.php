@extends('components.layout-admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Admin Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-4">
    Selamat datang!
</h1>

<div class="grid grid-cols-3 gap-6">
    <div class="bg-white p-5 rounded shadow">
        <p class="text-gray-500 text-sm">Total Barang</p>
        <h2 class="text-2xl font-bold">0</h2>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <p class="text-gray-500 text-sm">Peminjaman</p>
        <h2 class="text-2xl font-bold">0</h2>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <p class="text-gray-500 text-sm">Total Users</p>
        <h2 class="text-2xl font-bold">0</h2>
    </div>
</div>
@endsection
