@extends('layout_petugas.petugas')

@section('title', 'Kelola Barang')
@section('page-title', 'Kelola Barang')

@section('content')

<div class="max-w-7xl mx-auto">

<!-- HEADER -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-900">Katalog Barang</h2>
        <p class="text-xs text-gray-500 mt-1">
            @if(request('search'))
                Hasil untuk "<span class="font-semibold">{{ request('search') }}</span>"
            @else
                {{ $barangs->total() }} barang tersedia
            @endif
        </p>
    </div>

    <!-- Search + View Toggle -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto">

        <!-- Search -->
        <form method="GET" action="{{ route('petugas.barang.index') }}" class="flex gap-2 flex-1 sm:flex-initial">
            <input type="text"
                   name="search"
                   placeholder="Cari barang..."
                   value="{{ request('search') }}"
                   class="flex-1 sm:w-56 text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-2.5">
            <select name="status"
                    class="text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2.5">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak_tersedia" {{ request('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
            <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition">
                Cari
            </button>
            @if(request('search') || request('status'))
                <a href="{{ route('petugas.barang.index') }}"
                   class="px-3 py-2.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm font-medium">✕</a>
            @endif
        </form>

        <!-- View Toggle -->
        <div class="flex rounded-lg border border-gray-200 overflow-hidden bg-white self-stretch sm:self-auto">
            <button onclick="setView('card')" id="btn-card"
                    class="view-btn active flex-1 sm:flex-initial flex items-center justify-center gap-1.5 px-3 py-2.5 text-sm font-medium transition">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2"/>
                    <rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2"/>
                    <rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2"/>
                    <rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2"/>
                </svg>
                <span class="hidden sm:inline">Card</span>
            </button>
            <button onclick="setView('table')" id="btn-table"
                    class="view-btn flex-1 sm:flex-initial flex items-center justify-center gap-1.5 px-3 py-2.5 text-sm font-medium transition border-l border-gray-200">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" d="M3 5h18M3 10h18M3 15h18M3 20h18"/>
                </svg>
                <span class="hidden sm:inline">Tabel</span>
            </button>
        </div>

    </div>
</div>

@if($barangs->count() > 0)

<!-- ═══════════════════════════════════════
     CARD VIEW — horizontal layout seperti foto
════════════════════════════════════════ -->
<div id="view-card" class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    @foreach($barangs as $barang)
    <div class="bg-white rounded-[28px] shadow-[0_14px_40px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden flex flex-row w-full">

        <!-- IMAGE (LEFT) -->
        <div class="relative w-56 xl:w-64 2xl:w-72 aspect-square overflow-hidden bg-gray-100 flex-shrink-0">

            @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}"
                     alt="{{ $barang->nama_barang }}"
                     class="w-full h-full object-cover transition duration-500 hover:scale-105">
            @else
                <img src="{{ asset('img/default.png') }}"
                     class="w-full h-full object-cover transition duration-500 hover:scale-105">
            @endif

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>

            <!-- STOCK BADGE -->
            <div class="absolute bottom-3 left-3 bg-orange-100 text-orange-900 text-xs font-bold px-3 py-1.5 rounded-full border-2 border-orange-400 backdrop-blur shadow-sm">
                stok: {{ $barang->stok }}
            </div>

            <!-- STATUS BADGE -->
            <div class="absolute top-3 right-3">
                <span class="inline-block px-3 py-1.5 text-xs font-bold rounded-full backdrop-blur shadow-sm
                    {{ $barang->status == 'tersedia' ? 'bg-green-100 text-green-900 border-2 border-green-400' : 'bg-gray-100 text-gray-900 border-2 border-gray-400' }}">
                    {{ $barang->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}
                </span>
            </div>
        </div>

        <!-- CONTENT (RIGHT) — LEBARIN KE SAMPING -->
        <div class="flex-1 px-6 py-5 flex flex-col gap-4">

            <!-- TITLE -->
            <h3 class="text-xl font-extrabold text-gray-900 tracking-tight leading-snug line-clamp-2">
                {{ strtoupper($barang->nama_barang) }}
            </h3>
            
            <!-- INFO ROW -->
            <div class="flex gap-4">
                <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                    <p class="text-[11px] text-gray-500 font-semibold mb-1">Kondisi</p>
                    <p class="text-sm font-bold text-gray-900">
                        {{ ucfirst($barang->kondisi ?? 'Baik') }}
                    </p>
                </div>

                <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                    <p class="text-[11px] text-gray-500 font-semibold mb-1">Max. Pinjam</p>
                    <p class="text-sm font-bold text-gray-900">
                        {{ $barang->minimal_peminjaman ?? '-' }} Hari
                    </p>
                </div>
            </div>

            <!-- DESCRIPTION -->
            <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                <p class="text-[11px] text-gray-500 font-semibold mb-1">Deskripsi</p>
                <p class="text-sm text-gray-700 leading-relaxed line-clamp-3">
                    {{ $barang->deskripsi ?? 'Tidak ada deskripsi' }}
                </p>
            </div>

            <!-- BUTTON -->
            <a href="{{ route('petugas.barang.show', $barang->id) }}"
               class="mt-auto inline-block w-fit px-6 py-3 rounded-xl bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 transition shadow-[0_6px_18px_rgba(37,99,235,0.35)]">
                Lihat Detail
            </a>
        </div>

    </div>
    @endforeach
</div>

<!-- ═══════════════════════════════════════
     TABLE VIEW
════════════════════════════════════════ -->
<div id="view-table" class="hidden">
    <div class="bg-white rounded-[18px] border border-gray-200 shadow-[0_4px_16px_rgba(0,0,0,0.07)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[520px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide w-10">#</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Nama Barang</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Kondisi</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Stok</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Status</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Min. Pinjam</th>
                        <th class="px-4 py-3 w-24"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($barangs as $i => $barang)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-xs text-gray-400 font-medium">{{ $i + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                    @if($barang->foto)
                                        <img src="{{ asset('storage/' . $barang->foto) }}"
                                             alt="{{ $barang->nama_barang }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('img/default.png') }}"
                                             class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <span class="font-bold text-gray-900">{{ $barang->nama_barang }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2.5 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full border border-green-200">
                                {{ ucfirst($barang->kondisi ?? 'Baik') }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2.5 py-1 bg-orange-50 text-orange-700 text-xs font-bold rounded-full border border-orange-200">
                                {{ $barang->stok }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full border
                                {{ $barang->status == 'tersedia' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-700 border-gray-200' }}">
                                {{ $barang->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700 font-medium">
                            {{ $barang->minimal_peminjaman ? $barang->minimal_peminjaman . ' Hari' : '-' }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('petugas.barang.show', $barang->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border-2 border-blue-600 text-blue-700 text-xs font-bold hover:bg-blue-600 hover:text-white transition whitespace-nowrap">
                                Detail
                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $barangs->links() }}
</div>

@else
<!-- EMPTY STATE -->
<div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
    <svg class="mx-auto h-20 w-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
    </svg>
    @if(request('search'))
        <h3 class="text-lg font-bold text-gray-900 mb-2">Barang Tidak Ditemukan</h3>
        <p class="text-sm text-gray-600 mb-4">Pencarian "<span class="font-semibold">{{ request('search') }}</span>" tidak menemukan hasil</p>
        <a href="{{ route('petugas.barang.index') }}"
           class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
            Lihat Semua Barang
        </a>
    @else
        <h3 class="text-lg font-bold text-gray-900 mb-2">Barang Tidak Tersedia</h3>
        <p class="text-sm text-gray-600">Saat ini belum ada barang yang dapat dipinjam</p>
    @endif
</div>
@endif

</div>

@endsection

@push('styles')
<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.view-btn { color: #6B7280; background: #fff; }
.view-btn.active { color: #1D4ED8; background: #EFF6FF; }
</style>
@endpush

@push('scripts')
<script>
function setView(type) {
    const cardView = document.getElementById('view-card');
    const tableView = document.getElementById('view-table');
    const btnCard = document.getElementById('btn-card');
    const btnTable = document.getElementById('btn-table');

    if (type === 'card') {
        cardView.classList.remove('hidden');
        tableView.classList.add('hidden');
        btnCard.classList.add('active');
        btnTable.classList.remove('active');
    } else {
        cardView.classList.add('hidden');
        tableView.classList.remove('hidden');
        btnTable.classList.add('active');
        btnCard.classList.remove('active');
    }
    try { localStorage.setItem('barang-view', type); } catch(e) {}
}

document.addEventListener('DOMContentLoaded', function () {
    try {
        const saved = localStorage.getItem('barang-view');
        if (saved === 'table') setView('table');
    } catch(e) {}
});
</script>
@endpush