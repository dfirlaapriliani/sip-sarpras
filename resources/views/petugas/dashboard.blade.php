@extends('layout_petugas.petugas')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')
<div class="space-y-6">
    
    {{-- Welcome Card --}}
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 md:p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-center md:text-left">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name ?? 'Petugas' }}! 👋</h1>
                <p class="text-blue-100">Siap mengelola sarana dan prasarana hari ini</p>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center">
                <p class="text-sm text-blue-100">Tanggal</p>
                <p class="text-xl font-bold">{{ date('d M Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        
        {{-- Total Barang --}}
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Barang</p>
                    <h3 class="text-3xl font-bold text-gray-800">150</h3>
                    <p class="text-green-600 text-xs mt-2">↑ 12% dari bulan lalu</p>
                </div>
                <div class="bg-blue-100 rounded-full p-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Barang Tersedia --}}
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Barang Tersedia</p>
                    <h3 class="text-3xl font-bold text-gray-800">128</h3>
                    <p class="text-gray-500 text-xs mt-2">Siap dipinjam</p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Sedang Dipinjam --}}
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Sedang Dipinjam</p>
                    <h3 class="text-3xl font-bold text-gray-800">22</h3>
                    <p class="text-orange-600 text-xs mt-2">Dalam penggunaan</p>
                </div>
                <div class="bg-orange-100 rounded-full p-4">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Peminjam --}}
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Peminjam</p>
                    <h3 class="text-3xl font-bold text-gray-800">85</h3>
                    <p class="text-purple-600 text-xs mt-2">Pengguna aktif</p>
                </div>
                <div class="bg-purple-100 rounded-full p-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- Quick Actions & Recent Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Aksi Cepat
            </h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="#tambah-barang" class="flex flex-col items-center gap-2 p-4 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors duration-200 group">
                    <div class="bg-blue-500 rounded-full p-3 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Tambah Barang</span>
                </a>

                <a href="#data-barang" class="flex flex-col items-center gap-2 p-4 rounded-lg bg-green-50 hover:bg-green-100 transition-colors duration-200 group">
                    <div class="bg-green-500 rounded-full p-3 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Lihat Barang</span>
                </a>

                <a href="#peminjaman" class="flex flex-col items-center gap-2 p-4 rounded-lg bg-orange-50 hover:bg-orange-100 transition-colors duration-200 group">
                    <div class="bg-orange-500 rounded-full p-3 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Peminjaman</span>
                </a>

                <a href="#laporan" class="flex flex-col items-center gap-2 p-4 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors duration-200 group">
                    <div class="bg-purple-500 rounded-full p-3 group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Laporan</span>
                </a>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Aktivitas Terbaru
            </h2>
            <div class="space-y-3">
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="bg-green-100 rounded-full p-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800">Proyektok</p>
                        <p class="text-xs text-gray-500">oleh Ahmad Rizki • 5 menit lalu</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="bg-blue-100 rounded-full p-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800">Proyektor Epson ditambahkan</p>
                        <p class="text-xs text-gray-500">Inventaris baru • 1 jam lalu</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="bg-orange-100 rounded-full p-2">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800">Kamera Canon dipinjam</p>
                        <p class="text-xs text-gray-500">oleh Siti Nurhaliza • 2 jam lalu</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="bg-purple-100 rounded-full p-2">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800">Peminjam baru terdaftar</p>
                        <p class="text-xs text-gray-500">Budi Santoso • 3 jam lalu</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    
@endsection