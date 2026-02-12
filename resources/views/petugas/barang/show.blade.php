@extends('layout_petugas.petugas')

@section('title', 'Detail Barang')
@section('page-title', 'Detail Barang')

@section('content')
    <div class="mb-6">
        <a href="{{ route('petugas.barang.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">

            <div class="bg-gray-50 flex items-center justify-center p-8 lg:p-12">
                @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}"
                         alt="{{ $barang->nama_barang }}"
                         class="max-w-full max-h-96 object-contain rounded-lg">
                @else
                    <svg class="w-48 h-48 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                @endif
            </div>

            <div class="p-6 lg:p-8">
                <div class="mb-4">
                    <span class="inline-block px-4 py-2 text-sm font-semibold rounded-lg
                        {{ $barang->status == 'tersedia' ? 'text-green-700 bg-green-50 border border-green-200' : 'text-gray-700 bg-gray-100 border border-gray-300' }}">
                        {{ $barang->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>

                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6">
                    {{ $barang->nama_barang }}
                </h1>

                <div class="mb-6 p-5 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-700 font-medium mb-1">Stok Saat Ini</p>
                            <p class="text-4xl font-bold {{ $barang->stok > 10 ? 'text-blue-600' : ($barang->stok > 0 ? 'text-orange-600' : 'text-red-600') }}">
                                {{ $barang->stok }}
                            </p>
                        </div>
                        <div>
                            @if($barang->stok <= 10 && $barang->stok > 0)
                                <span class="text-sm text-orange-600 font-medium">⚠️ Stok Terbatas</span>
                            @elseif($barang->stok == 0)
                                <span class="text-sm text-red-600 font-medium">❌ Stok Habis</span>
                            @else
                                <span class="text-sm text-blue-600 font-medium">✓ Stok Cukup</span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($barang->deskripsi)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-900 mb-3 text-lg">Deskripsi</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $barang->deskripsi }}</p>
                    </div>
                @endif

                <div class="space-y-3">
                    <h3 class="font-semibold text-gray-900 text-lg">Informasi Detail</h3>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Kondisi</span>
                        <span class="font-semibold text-gray-900">{{ ucfirst($barang->kondisi ?? 'Baik') }}</span>
                    </div>
                    @if($barang->minimal_peminjaman)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Minimal Peminjaman</span>
                            <span class="font-semibold text-gray-900">{{ $barang->minimal_peminjaman }} hari</span>
                        </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Ditambahkan</span>
                        <span class="font-semibold text-gray-900">{{ $barang->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection