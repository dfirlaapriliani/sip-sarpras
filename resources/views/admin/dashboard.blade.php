@extends('layout_admin.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen p-6">

    {{-- ── HEADER ── --}}
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    Selamat Datang! 👋
                </h1>
                <p class="text-gray-600 text-sm md:text-base">
                    Kelola sistem inventaris Anda dengan mudah
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center gap-3">
                {{-- Indicator auto-refresh --}}
                <div class="flex items-center gap-1.5 text-xs text-gray-400" id="refreshIndicator">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse inline-block"></span>
                    Live
                </div>
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-blue-100">
                    <p class="text-xs text-gray-500">Tanggal Hari Ini</p>
                    <p class="text-sm font-semibold text-blue-600" id="currentDate"></p>
                </div>
            </div>
        </div>
    </div>

    {{-- ── STATS CARDS ── --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">

        {{-- Total Barang --}}
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-blue-100">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 p-3 rounded-lg group-hover:bg-blue-200 transition-colors duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Inventaris</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">Total Barang</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 stat-num" id="stat-total_barang">
                    {{ number_format($stats['total_barang']) }}
                </h2>
                <div class="flex items-center text-xs text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    <span>Update terbaru</span>
                </div>
            </div>
            <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        </div>

        {{-- Total Peminjaman --}}
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-blue-100">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 p-3 rounded-lg group-hover:bg-blue-200 transition-colors duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Transaksi</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">Total Peminjaman</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 stat-num" id="stat-total_peminjaman">
                    {{ number_format($stats['total_peminjaman']) }}
                </h2>
                <div class="flex items-center text-xs text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Semua waktu</span>
                </div>
            </div>
            <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        </div>

        {{-- Total Users --}}
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-blue-100">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 p-3 rounded-lg group-hover:bg-blue-200 transition-colors duration-300">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Pengguna</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">Total Users</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 stat-num" id="stat-total_users">
                    {{ number_format($stats['total_users']) }}
                </h2>
                <div class="flex items-center text-xs text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <span>Terdaftar</span>
                </div>
            </div>
            <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        </div>
    </div>

    {{-- ── SHORTCUT ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('admin.barang.index') }}"
           class="flex items-center gap-4 bg-white border border-slate-200 rounded-xl p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
            <div class="w-12 h-12 bg-blue-100 group-hover:bg-blue-200 rounded-xl flex items-center justify-center text-2xl transition-colors">📦</div>
            <div>
                <div class="font-bold text-slate-800 text-sm">Kelola Barang</div>
                <div class="text-xs text-slate-500">Tambah, edit, hapus barang</div>
            </div>
        </a>
        <a href="{{ route('admin.categories.index') }}"
           class="flex items-center gap-4 bg-white border border-slate-200 rounded-xl p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
            <div class="w-12 h-12 bg-indigo-100 group-hover:bg-indigo-200 rounded-xl flex items-center justify-center text-2xl transition-colors">🗂️</div>
            <div>
                <div class="font-bold text-slate-800 text-sm">Kategori</div>
                <div class="text-xs text-slate-500">Kelola kategori barang</div>
            </div>
        </a>
        <a href="{{ route('admin.log-aktivitas.index') }}"
           class="flex items-center gap-4 bg-white border border-slate-200 rounded-xl p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
            <div class="w-12 h-12 bg-cyan-100 group-hover:bg-cyan-200 rounded-xl flex items-center justify-center text-2xl transition-colors">📋</div>
            <div>
                <div class="font-bold text-slate-800 text-sm">Log Aktivitas</div>
                <div class="text-xs text-slate-500">Pantau semua aktivitas</div>
            </div>
        </a>
    </div>

</div>

<script>
// Tampilkan tanggal
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('currentDate');
    if (el) {
        el.textContent = new Date().toLocaleDateString('id-ID', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
    }

    // Auto-refresh stats setiap 30 detik
    const statsUrl = "{{ route('admin.dashboard.stats') }}";

    function animateNum(el, newVal) {
        const current = parseInt(el.textContent.replace(/\D/g, '')) || 0;
        if (current === newVal) return;
        const step     = Math.ceil(Math.abs(newVal - current) / 20);
        const dir      = newVal > current ? 1 : -1;
        let val        = current;
        const interval = setInterval(() => {
            val += dir * step;
            if ((dir === 1 && val >= newVal) || (dir === -1 && val <= newVal)) {
                val = newVal;
                clearInterval(interval);
            }
            el.textContent = val.toLocaleString('id-ID');
        }, 30);
    }

    function refreshStats() {
        fetch(statsUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            const map = {
                'stat-total_barang':     data.total_barang,
                'stat-total_peminjaman': data.total_peminjaman,
                'stat-total_users':      data.total_users,
                'stat-menunggu':         data.menunggu,
                'stat-disetujui':        data.disetujui,
                'stat-dipinjam':         data.dipinjam,
                'stat-dikembalikan':     data.dikembalikan,
                'stat-ditolak':          data.ditolak,
            };
            Object.entries(map).forEach(([id, val]) => {
                const el = document.getElementById(id);
                if (el) animateNum(el, val);
            });
        })
        .catch(() => {}); // silent fail
    }

    // Refresh pertama setelah 30 detik, lalu setiap 30 detik
    setInterval(refreshStats, 30000);
});
</script>
@endsection