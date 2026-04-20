@extends('layout_petugas.petugas')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Welcome Card --}}
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 md:p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-center md:text-left">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">
                    Selamat Datang, {{ auth()->user()->name ?? 'Petugas' }}! 👋
                </h1>
                <p class="text-blue-100">Siap mengelola sarana dan prasarana hari ini</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- Live indicator --}}
                <div class="flex items-center gap-1.5 text-xs text-blue-200">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse inline-block"></span>
                    Live
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center">
                    <p class="text-sm text-blue-100">Tanggal</p>
                    <p class="text-xl font-bold">{{ date('d M Y') }}</p>
                </div>
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
                    <h3 class="text-3xl font-bold text-gray-800 stat-num" id="stat-total_barang">
                        {{ number_format($stats['total_barang']) }}
                    </h3>
                    <p class="text-gray-400 text-xs mt-2">Semua item inventaris</p>
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
                    <h3 class="text-3xl font-bold text-gray-800 stat-num" id="stat-barang_tersedia">
                        {{ number_format($stats['barang_tersedia']) }}
                    </h3>
                    <p class="text-green-600 text-xs mt-2">Siap dipinjam</p>
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
                    <h3 class="text-3xl font-bold text-gray-800 stat-num" id="stat-sedang_dipinjam">
                        {{ number_format($stats['sedang_dipinjam']) }}
                    </h3>
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
                    <h3 class="text-3xl font-bold text-gray-800 stat-num" id="stat-total_peminjam">
                        {{ number_format($stats['total_peminjam']) }}
                    </h3>
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

</div>

<script>
const statsUrl = "{{ route('petugas.dashboard.stats') }}";

function animateNum(el, newVal) {
    const current = parseInt(el.textContent.replace(/\D/g, '')) || 0;
    if (current === newVal) return;
    const step = Math.ceil(Math.abs(newVal - current) / 20);
    const dir  = newVal > current ? 1 : -1;
    let val    = current;
    const iv   = setInterval(() => {
        val += dir * step;
        if ((dir === 1 && val >= newVal) || (dir === -1 && val <= newVal)) {
            val = newVal;
            clearInterval(iv);
        }
        el.textContent = val.toLocaleString('id-ID');
    }, 30);
}

function refreshStats() {
    fetch(statsUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(data => {
            const map = {
                'stat-total_barang':    data.total_barang,
                'stat-barang_tersedia': data.barang_tersedia,
                'stat-sedang_dipinjam': data.sedang_dipinjam,
                'stat-total_peminjam':  data.total_peminjam,
            };
            Object.entries(map).forEach(([id, val]) => {
                const el = document.getElementById(id);
                if (el) animateNum(el, val);
            });
        })
        .catch(() => {});
}

setInterval(refreshStats, 30000);
</script>
@endsection