@extends('layout_admin.admin')

@section('title', 'Detail Barang')
@section('page-title', 'Detail Barang')

@section('content')
<div class="p-4 sm:p-6">
    <!-- Header Section -->
    <div class="mb-4">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-white border border-gray-200 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg sm:text-xl font-semibold text-gray-800">Detail Data Barang</h1>
                    <p class="text-gray-500 text-sm">{{ $barang->nama_barang }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
        <!-- Left Column - Image & Quick Stats -->
        <div class="flex flex-col gap-4 h-full">
            
            <!-- Image Card -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}" 
                         alt="{{ $barang->nama_barang }}" 
                         class="w-full h-64 rounded-lg object-cover">
                @else
                    <div class="w-full h-64 rounded-lg bg-gray-50 flex flex-col items-center justify-center border border-dashed border-gray-300">
                        <svg class="w-16 h-16 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-400 text-sm">Tidak ada foto</p>
                    </div>
                @endif
            </div>

            <!-- Quick Stats Card -->
            <div class="bg-white rounded-lg border border-gray-200 p-4 flex-1">
                <h3 class="text-sm font-semibold text-gray-800 mb-3">Statistik Cepat</h3>
                <div class="grid grid-cols-2 gap-3 h-full content-start">
                    <div class="bg-purple-50 rounded-lg p-4 border border-purple-100">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 rounded bg-purple-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-purple-600 mb-1">Stok</p>
                        <p class="text-xl font-semibold text-purple-700">{{ $barang->stok }}</p>
                    </div>

                    <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 rounded bg-green-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-green-600 mb-1">Kondisi</p>
                        <p class="text-sm font-semibold text-green-700">{{ ucfirst($barang->kondisi) }}</p>
                    </div>

                    <div class="bg-cyan-50 rounded-lg p-4 border border-cyan-100">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 rounded bg-cyan-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-cyan-600 mb-1">Status</p>
                        <p class="text-sm font-semibold text-cyan-700">{{ ucfirst($barang->status) }}</p>
                    </div>

                    <div class="bg-orange-50 rounded-lg p-4 border border-orange-100">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 rounded bg-orange-500 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-orange-600 mb-1">Min. Pinjam</p>
                        <p class="text-sm font-semibold text-orange-700">{{ $barang->minimal_peminjaman }} hari</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column - Details -->
        <div class="flex flex-col h-full">
            
            <!-- Informasi Utama -->
            <div class="bg-white rounded-lg border border-gray-200 flex flex-col h-full">
                <div class="px-4 py-3 border-b border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-800">Informasi Barang</h3>
                </div>
                <div class="divide-y divide-gray-100 flex-1 overflow-auto">
                    <!-- Nama Barang -->
                    <div class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">Nama Barang</p>
                            <p class="text-sm text-gray-800 font-medium">{{ $barang->nama_barang }}</p>
                        </div>
                    </div>

                    <!-- Stok -->
                    <div class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">Jumlah Stok</p>
                            <span class="inline-flex items-center gap-1.5 bg-purple-50 text-purple-600 px-3 py-1.5 rounded-lg text-sm font-medium border border-purple-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                {{ $barang->stok }} Unit
                            </span>
                        </div>
                    </div>

                    <!-- Kondisi -->
                    <div class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">Kondisi Barang</p>
                            @if($barang->kondisi == 'baik')
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 px-3 py-1.5 rounded-lg text-sm font-medium border border-green-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Baik
                                </span>
                            @elseif($barang->kondisi == 'rusak ringan')
                                <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-lg text-sm font-medium border border-yellow-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    Rusak Ringan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-sm font-medium border border-red-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Rusak Berat
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">Status Ketersediaan</p>
                            @if($barang->status == 'tersedia')
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 px-3 py-1.5 rounded-lg text-sm font-medium border border-green-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg text-sm font-medium border border-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    </svg>
                                    Tidak Tersedia
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Minimal Peminjaman -->
                    <div class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">Minimal Peminjaman</p>
                            <p class="text-sm text-gray-800 inline-flex items-center gap-1.5 font-medium">
                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $barang->minimal_peminjaman }} hari
                            </p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="p-4 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-gray-500 mb-1">Deskripsi</p>
                            <p class="text-sm text-gray-800 leading-relaxed">{{ $barang->deskripsi ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Action Buttons -->
    <div class="grid grid-cols-2 gap-4 mt-4">
        <a href="{{ route('admin.barang.edit', $barang) }}" 
           class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg text-sm font-medium border border-blue-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Barang
        </a>
        <a href="{{ route('admin.barang.index') }}" 
           class="inline-flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-4 py-3 rounded-lg text-sm font-medium border border-gray-200 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>
</div>
@endsection