@extends('layout_peminjam.peminjam')

@section('title', 'Daftar Barang')
@section('page-title', 'Daftar Barang')

@section('content')

{{-- FLASH MESSAGES --}}
@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="mb-4 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-medium">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-4 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-medium">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9V5a1 1 0 112 0v4a1 1 0 11-2 0zm1 6a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" clip-rule="evenodd"/>
        </svg>
        {{ session('error') }}
    </div>
@endif

<!-- CART FLOATING BANNER -->
@if(count($cart) > 0)
<div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-5 py-4 bg-blue-600 text-white rounded-2xl shadow-lg">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <div>
            <p class="font-bold text-sm">{{ count($cart) }} barang dipilih</p>
            <p class="text-blue-200 text-xs">Total: {{ array_sum(array_column($cart, 'jumlah')) }} unit</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <form action="{{ route('peminjam.cart.clear') }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" class="px-3 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-xs font-semibold transition">
                Kosongkan
            </button>
        </form>
        <a href="{{ route('peminjam.peminjaman.create') }}"
           class="px-5 py-2 bg-white text-blue-700 rounded-xl text-sm font-bold hover:bg-blue-50 transition shadow">
            Ajukan Pinjam →
        </a>
    </div>
</div>
@endif

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
        <form method="GET" action="{{ route('peminjam.barang.index') }}" class="flex gap-2 flex-1 sm:flex-initial">
            <input type="text" name="search" placeholder="Cari barang..."
                   value="{{ request('search') }}"
                   class="flex-1 sm:w-56 text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-2.5">
            <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('peminjam.barang.index') }}"
                   class="px-3 py-2.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm font-medium">✕</a>
            @endif
        </form>

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

<!-- CARD VIEW -->
<div id="view-card" class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    @foreach($barangs as $barang)
    @php $inCart = isset($cart[$barang->id]); @endphp
    <div class="bg-white rounded-[28px] shadow-[0_14px_40px_rgba(0,0,0,0.08)] border overflow-hidden flex flex-row w-full transition
        {{ $inCart ? 'border-blue-400 ring-2 ring-blue-300' : 'border-gray-100' }}">

        <!-- IMAGE -->
        <div class="relative w-56 xl:w-64 2xl:w-72 aspect-square overflow-hidden bg-gray-100 flex-shrink-0">
            @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}"
                     class="w-full h-full object-cover transition duration-500 hover:scale-105">
            @else
                <img src="{{ asset('img/default.png') }}" class="w-full h-full object-cover transition duration-500 hover:scale-105">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>

            <!-- STATUS BADGE -->
            <div class="absolute top-3 right-3">
                <span class="inline-block px-3 py-1.5 text-xs font-bold rounded-full backdrop-blur shadow-sm
                    {{ $barang->status == 'tersedia' ? 'bg-green-100 text-green-900 border-2 border-green-400' : 'bg-gray-100 text-gray-900 border-2 border-gray-400' }}">
                    {{ $barang->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}
                </span>
            </div>

            <!-- CART BADGE -->
            @if($inCart)
            <div class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                ✓ Dipilih
            </div>
            @endif

            <!-- STOCK BADGE -->>
            <div class="absolute bottom-3 left-3 text-xs font-bold px-3 py-1.5 rounded-full border-2 backdrop-blur shadow-sm
                {{ $barang->stok <= 3 ? 'bg-red-100 text-red-900 border-red-400' : 'bg-orange-100 text-orange-900 border-orange-400' }}">
                stok: {{ $barang->stok }}{{ $barang->stok <= 3 ? ' ⚠️' : '' }}
            </div>
        </div>

        <!-- CONTENT -->
        <div class="flex-1 px-6 py-5 flex flex-col gap-3">
            <h3 class="text-xl font-extrabold text-gray-900 tracking-tight leading-snug line-clamp-2">
                {{ strtoupper($barang->nama_barang) }}
            </h3>

            <div class="flex gap-4">
                <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                    <p class="text-[11px] text-gray-500 font-semibold mb-1">Kondisi</p>
                    <p class="text-sm font-bold text-gray-900">{{ ucfirst($barang->kondisi ?? 'Baik') }}</p>
                </div>
                <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                    <p class="text-[11px] text-gray-500 font-semibold mb-1">Max. Pinjam</p>
                    <p class="text-sm font-bold text-gray-900">{{ $barang->minimal_peminjaman ?? '-' }} Hari</p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                <p class="text-[11px] text-gray-500 font-semibold mb-1">Deskripsi</p>
                <p class="text-sm text-gray-700 leading-relaxed line-clamp-2">{{ $barang->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="mt-auto flex items-center gap-2 flex-wrap">
                <a href="{{ route('peminjam.barang.show', $barang->id) }}"
                   class="px-4 py-2.5 rounded-xl border-2 border-gray-300 text-gray-700 text-sm font-bold hover:bg-gray-50 transition">
                    Detail
                </a>

                @if($barang->status === 'tersedia' && $barang->stok > 0)
                    @if($inCart)
                        {{-- Hapus dari cart --}}
                        <form action="{{ route('peminjam.cart.remove', $barang->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2.5 rounded-xl bg-red-50 border-2 border-red-400 text-red-700 text-sm font-bold hover:bg-red-100 transition">
                                ✕ Hapus
                            </button>
                        </form>
                    @else
                        {{-- Tambah ke cart --}}
                        <button onclick="openQtyModal({{ $barang->id }}, '{{ addslashes($barang->nama_barang) }}', {{ $barang->stok }})"
                                class="px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 transition shadow-[0_4px_12px_rgba(37,99,235,0.3)]">
                            + Pilih
                        </button>
                    @endif
                @else
                    <span class="px-4 py-2.5 rounded-xl bg-gray-100 text-gray-400 text-sm font-bold cursor-not-allowed">Tidak Tersedia</span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- TABLE VIEW -->
<div id="view-table" class="hidden">
    <div class="bg-white rounded-[18px] border border-gray-200 shadow-[0_4px_16px_rgba(0,0,0,0.07)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[600px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide w-10">#</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Nama Barang</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Kondisi</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Stok</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Status</th>
                        <th class="px-4 py-3 w-36 text-right text-xs font-bold text-gray-500 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($barangs as $i => $barang)
                    @php $inCart = isset($cart[$barang->id]); @endphp
                    <tr class="hover:bg-gray-50 transition {{ $inCart ? 'bg-blue-50' : '' }}">
                        <td class="px-4 py-3 text-xs text-gray-400 font-medium">{{ $i + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="relative w-10 h-10 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                    @if($barang->foto)
                                        <img src="{{ asset('storage/' . $barang->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('img/default.png') }}" class="w-full h-full object-cover">
                                    @endif
                                    @if($inCart)
                                        <div class="absolute inset-0 bg-blue-600/70 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-bold text-gray-900">{{ $barang->nama_barang }}</span>
                                    @if($inCart)
                                        <span class="ml-2 inline-block px-1.5 py-0.5 bg-blue-100 text-blue-700 text-[10px] font-bold rounded">
                                            {{ $cart[$barang->id]['jumlah'] }} unit dipilih
                                        </span>
                                    @endif
                                </div>
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
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('peminjam.barang.show', $barang->id) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-gray-300 text-gray-600 text-xs font-bold hover:bg-gray-50 transition">
                                    Detail
                                </a>
                                @if($barang->status === 'tersedia' && $barang->stok > 0)
                                    @if($inCart)
                                        <form action="{{ route('peminjam.cart.remove', $barang->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-red-300 text-red-600 text-xs font-bold hover:bg-red-50 transition">
                                                ✕
                                            </button>
                                        </form>
                                    @else
                                        <button onclick="openQtyModal({{ $barang->id }}, '{{ addslashes($barang->nama_barang) }}', {{ $barang->stok }})"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-bold hover:bg-blue-700 transition">
                                            + Pilih
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">{{ $barangs->links() }}</div>

@else
<div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
    <svg class="mx-auto h-20 w-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
    </svg>
    @if(request('search'))
        <h3 class="text-lg font-bold text-gray-900 mb-2">Barang Tidak Ditemukan</h3>
        <p class="text-sm text-gray-600 mb-4">Pencarian "<span class="font-semibold">{{ request('search') }}</span>" tidak menemukan hasil</p>
        <a href="{{ route('peminjam.barang.index') }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
            Lihat Semua Barang
        </a>
    @else
        <h3 class="text-lg font-bold text-gray-900 mb-2">Barang Tidak Tersedia</h3>
        <p class="text-sm text-gray-600">Saat ini belum ada barang yang dapat dipinjam</p>
    @endif
</div>
@endif

<!-- ── MODAL PILIH JUMLAH ─────────────────────────────────── -->
<div id="qty-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeQtyModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 z-10">
        <button onclick="closeQtyModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <h3 class="text-lg font-bold text-gray-900 mb-1">Pilih Jumlah</h3>
        <p id="modal-nama" class="text-sm text-gray-500 mb-5"></p>

        <form id="cart-form" action="{{ route('peminjam.cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="barang_id" id="modal-barang-id">

            <div class="mb-5">
                <label class="block text-xs font-semibold text-gray-600 mb-2">Jumlah (maks: <span id="modal-stok"></span>)</label>
                <div class="flex items-center gap-3">
                    <button type="button" onclick="changeQty(-1)"
                            class="w-10 h-10 rounded-xl border-2 border-gray-300 text-gray-600 font-bold text-lg hover:bg-gray-100 flex items-center justify-center transition">−</button>
                    <input type="number" name="jumlah" id="modal-qty" value="1" min="1"
                           class="flex-1 text-center text-xl font-bold border-2 border-gray-300 rounded-xl py-2 focus:border-blue-500 focus:ring-0">
                    <button type="button" onclick="changeQty(1)"
                            class="w-10 h-10 rounded-xl border-2 border-gray-300 text-gray-600 font-bold text-lg hover:bg-gray-100 flex items-center justify-center transition">+</button>
                </div>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-[0_4px_14px_rgba(37,99,235,0.35)]">
                Tambahkan ke Daftar Pinjam
            </button>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
.line-clamp-2 { display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden; }
.line-clamp-3 { display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden; }
.view-btn { color:#6B7280;background:#fff; }
.view-btn.active { color:#1D4ED8;background:#EFF6FF; }
</style>
@endpush

@push('scripts')
<script>
let modalMaxStok = 1;

function openQtyModal(id, nama, stok) {
    modalMaxStok = stok;
    document.getElementById('modal-barang-id').value = id;
    document.getElementById('modal-nama').textContent = nama;
    document.getElementById('modal-stok').textContent = stok;
    document.getElementById('modal-qty').value = 1;
    document.getElementById('modal-qty').max = stok;
    document.getElementById('qty-modal').classList.remove('hidden');
}

function closeQtyModal() {
    document.getElementById('qty-modal').classList.add('hidden');
}

function changeQty(delta) {
    const input = document.getElementById('modal-qty');
    const val = Math.min(Math.max(1, parseInt(input.value || 1) + delta), modalMaxStok);
    input.value = val;
}

function setView(type) {
    const cardView = document.getElementById('view-card');
    const tableView = document.getElementById('view-table');
    const btnCard = document.getElementById('btn-card');
    const btnTable = document.getElementById('btn-table');
    if (type === 'card') {
        cardView.classList.remove('hidden'); tableView.classList.add('hidden');
        btnCard.classList.add('active'); btnTable.classList.remove('active');
    } else {
        cardView.classList.add('hidden'); tableView.classList.remove('hidden');
        btnTable.classList.add('active'); btnCard.classList.remove('active');
    }
    try { localStorage.setItem('barang-view', type); } catch(e) {}
}

document.addEventListener('DOMContentLoaded', function () {
    try { const saved = localStorage.getItem('barang-view'); if (saved === 'table') setView('table'); } catch(e) {}
});
</script>
@endpush