@extends('layout_peminjam.peminjam')

@section('title', 'Dashboard Peminjam')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Welcome Card -->
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-xl p-8">
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-white text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
                    <p class="text-blue-100 text-sm">Kelola peminjaman barang Anda dengan mudah</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-24 h-24 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative circles -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Total Peminjaman -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium mb-2">Total Peminjaman</h3>
                <div class="flex items-end justify-between">
                    <p class="text-4xl font-bold text-gray-800">12</p>
                    <div class="flex items-center text-green-600 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>+2 bulan ini</span>
                    </div>
                </div>
            </div>
            <!-- Decorative element -->
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-100 to-transparent rounded-tl-full opacity-20"></div>
        </div>

        <!-- Sedang Dipinjam -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-100 to-orange-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md">
                        <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1 rounded-full">Aktif</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium mb-2">Sedang Dipinjam</h3>
                <div class="flex items-end justify-between">
                    <p class="text-4xl font-bold text-gray-800">3</p>
                    <div class="flex items-center text-orange-600 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <span>Dikembalikan</span>
                    </div>
                </div>
            </div>
            <!-- Decorative element -->
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-gradient-to-br from-orange-100 to-transparent rounded-tl-full opacity-20"></div>
        </div>

        <!-- Riwayat -->
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">Selesai</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium mb-2">Riwayat</h3>
                <div class="flex items-end justify-between">
                    <p class="text-4xl font-bold text-gray-800">20</p>
                    <div class="flex items-center text-green-600 text-sm font-semibold">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Semuanya</span>
                    </div>
                </div>
            </div>
            <!-- Decorative element -->
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-gradient-to-br from-green-100 to-transparent rounded-tl-full opacity-20"></div>
        </div>

    </div>


</div>
@endsection