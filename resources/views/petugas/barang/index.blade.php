@extends('layout_petugas.petugas')

@section('title', 'Kelola Barang')
@section('page-title', 'Kelola Barang')

@section('content')
<div class="max-w-7xl mx-auto">

<!-- HEADER -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-900">Inventaris Barang</h2>
        <p class="text-xs text-gray-500 mt-1">
            @if(request('search'))
                Hasil untuk "<span class="font-semibold">{{ request('search') }}</span>"
            @else
                {{ $barangs->total() }} barang terdaftar
            @endif
        </p>
    </div>

    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto">
        <!-- Search -->
        <form method="GET" action="{{ route('petugas.barang.index') }}" class="flex gap-2 flex-1 sm:flex-initial flex-wrap">
            <input type="text" name="search" placeholder="Cari barang..."
                   value="{{ request('search') }}"
                   class="flex-1 sm:w-44 text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-2.5">
            <select name="category_id" class="text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2.5">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="status" class="text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2.5">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak tersedia" {{ request('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
            <button type="submit" class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition">Cari</button>
            @if(request('search') || request('status') || request('category_id'))
                <a href="{{ route('petugas.barang.index') }}" class="px-3 py-2.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm font-medium">✕</a>
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

<!-- ═══ CARD VIEW ═══ -->
<div id="view-card" class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    @foreach($barangs as $barang)
    @php
        $itemsAktif = $aktifItems->get($barang->id, collect());
        $jumlahDipinjam = $itemsAktif->sum('jumlah');
        $stokRiil = $barang->stok; // stok di DB sudah dikurangi saat approve
        $adaTerlambat = $itemsAktif->filter(function($item) {
            return $item->peminjaman->tanggal_kembali < now()->toDateString()
                && $item->peminjaman->status === 'dipinjam';
        })->count() > 0;
    @endphp
    <div class="bg-white rounded-[24px] shadow-[0_8px_30px_rgba(0,0,0,0.07)] border {{ $adaTerlambat ? 'border-red-300' : 'border-gray-100' }} overflow-hidden flex flex-row w-full">

        <!-- IMAGE -->
        <div class="relative w-48 xl:w-56 flex-shrink-0 overflow-hidden bg-gray-100">
            @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('img/default.png') }}" class="w-full h-full object-cover">
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>

            <!-- Stok Badge -->
            <div class="absolute bottom-3 left-3 text-xs font-bold px-3 py-1.5 rounded-full border-2 backdrop-blur shadow-sm
                {{ $stokRiil <= 0 ? 'bg-red-100 text-red-900 border-red-500' : ($stokRiil <= 3 ? 'bg-yellow-100 text-yellow-900 border-yellow-400' : 'bg-green-100 text-green-900 border-green-400') }}">
                Stok: {{ $stokRiil }}
            </div>

            <!-- Status Badge -->
            <div class="absolute top-3 right-3">
                <span class="inline-block px-2.5 py-1 text-xs font-bold rounded-full backdrop-blur shadow-sm
                    {{ $barang->status == 'tersedia' ? 'bg-green-100 text-green-900 border-2 border-green-400' : 'bg-red-100 text-red-900 border-2 border-red-400' }}">
                    {{ $barang->status == 'tersedia' ? 'Tersedia' : 'Habis' }}
                </span>
            </div>

            @if($adaTerlambat)
            <div class="absolute top-3 left-3">
                <span class="inline-block px-2 py-1 text-xs font-bold rounded-full bg-red-500 text-white shadow animate-pulse">
                    ⚠ Terlambat
                </span>
            </div>
            @endif
        </div>

        <!-- CONTENT -->
        <div class="flex-1 px-5 py-4 flex flex-col gap-3 min-w-0">
            <div>
                <h3 class="text-base font-extrabold text-gray-900 leading-snug line-clamp-2">{{ strtoupper($barang->nama_barang) }}</h3>
                <div class="flex items-center gap-2 mt-1">
                    @if($barang->category)
                        <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-full">{{ $barang->category->name }}</span>
                    @endif
                    <p class="text-xs text-gray-400">Max pinjam: {{ $barang->minimal_peminjaman ?? '-' }} hari</p>
                </div>
            </div>

            <!-- Stat Row -->
            <div class="grid grid-cols-3 gap-2">
                <div class="bg-blue-50 rounded-xl px-3 py-2 text-center border border-blue-100">
                    <p class="text-[10px] text-blue-500 font-semibold">Stok Tersisa</p>
                    <p class="text-lg font-extrabold {{ $stokRiil <= 0 ? 'text-red-600' : ($stokRiil <= 3 ? 'text-yellow-600' : 'text-blue-700') }}">{{ $stokRiil }}</p>
                </div>
                <div class="bg-orange-50 rounded-xl px-3 py-2 text-center border border-orange-100">
                    <p class="text-[10px] text-orange-500 font-semibold">Sedang Dipinjam</p>
                    <p class="text-lg font-extrabold text-orange-700">{{ $jumlahDipinjam }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl px-3 py-2 text-center border border-gray-200">
                    <p class="text-[10px] text-gray-500 font-semibold">Peminjam Aktif</p>
                    <p class="text-lg font-extrabold text-gray-700">{{ $itemsAktif->count() }}</p>
                </div>
            </div>

            <!-- Peminjam Aktif Preview -->
            @if($itemsAktif->count() > 0)
            <div class="bg-gray-50 rounded-xl p-3 border border-gray-200">
                <p class="text-[10px] font-bold text-gray-500 uppercase mb-2">Sedang Dipinjam Oleh:</p>
                <div class="space-y-1.5">
                    @foreach($itemsAktif->take(2) as $item)
                    @php
                        $terlambat = $item->peminjaman->tanggal_kembali < now()->toDateString()
                                  && $item->peminjaman->status === 'dipinjam';
                        $statusLabel = match($item->peminjaman->status) {
                            'disetujui' => ['text' => 'Disetujui', 'class' => 'bg-blue-100 text-blue-700'],
                            'dipinjam'  => ['text' => 'Dipinjam', 'class' => 'bg-orange-100 text-orange-700'],
                            default     => ['text' => $item->peminjaman->status, 'class' => 'bg-gray-100 text-gray-700'],
                        };
                    @endphp
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center text-white text-[9px] font-bold flex-shrink-0">
                                {{ strtoupper(substr($item->peminjaman->peminjam->name ?? '?', 0, 1)) }}
                            </div>
                            <span class="text-xs font-semibold text-gray-800 truncate">{{ $item->peminjaman->peminjam->name ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-semibold {{ $statusLabel['class'] }}">
                                {{ $statusLabel['text'] }}
                            </span>
                            <span class="text-[10px] {{ $terlambat ? 'text-red-600 font-bold' : 'text-gray-400' }}">
                                {{ $terlambat ? '⚠ '.\Carbon\Carbon::parse($item->peminjaman->tanggal_kembali)->diffForHumans().' terlambat' : \Carbon\Carbon::parse($item->peminjaman->tanggal_kembali)->format('d M') }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @if($itemsAktif->count() > 2)
                        <p class="text-[10px] text-gray-400 text-center">+{{ $itemsAktif->count() - 2 }} lainnya</p>
                    @endif
                </div>
            </div>
            @else
            <div class="bg-gray-50 rounded-xl p-3 border border-dashed border-gray-300 text-center">
                <p class="text-xs text-gray-400">Tidak ada peminjaman aktif</p>
            </div>
            @endif

            <!-- Action -->
            <a href="{{ route('petugas.barang.show', $barang->id) }}"
               class="mt-auto inline-block w-fit px-5 py-2.5 rounded-xl bg-blue-600 text-white text-xs font-bold hover:bg-blue-700 transition shadow-md">
                Lihat Detail Lengkap →
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- ═══ TABLE VIEW ═══ -->
<div id="view-table" class="hidden">
    <div class="bg-white rounded-[18px] border border-gray-200 shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[700px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Barang</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Stok</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Dipinjam</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Peminjam Aktif</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Status</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Terlambat</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($barangs as $barang)
                    @php
                        $itemsAktif     = $aktifItems->get($barang->id, collect());
                        $jumlahDipinjam = $itemsAktif->sum('jumlah');
                        $adaTerlambat   = $itemsAktif->filter(function($item) {
                            return $item->peminjaman->tanggal_kembali < now()->toDateString()
                                && $item->peminjaman->status === 'dipinjam';
                        })->count() > 0;
                    @endphp
                    <tr class="hover:bg-gray-50 transition {{ $adaTerlambat ? 'bg-red-50/30' : '' }}">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                    @if($barang->foto)
                                        <img src="{{ asset('storage/' . $barang->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('img/default.png') }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">{{ $barang->nama_barang }}</p>
                                    <p class="text-xs text-gray-400">Max {{ $barang->minimal_peminjaman ?? '-' }} hari</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full
                                {{ $barang->stok <= 0 ? 'bg-red-100 text-red-700' : ($barang->stok <= 3 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                {{ $barang->stok }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-orange-100 text-orange-700">
                                {{ $jumlahDipinjam }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($itemsAktif->count() > 0)
                                <div class="flex -space-x-2 justify-center">
                                    @foreach($itemsAktif->take(3) as $item)
                                    <div class="w-7 h-7 rounded-full bg-blue-500 border-2 border-white flex items-center justify-center text-white text-[9px] font-bold"
                                         title="{{ $item->peminjaman->peminjam->name ?? '-' }}">
                                        {{ strtoupper(substr($item->peminjaman->peminjam->name ?? '?', 0, 1)) }}
                                    </div>
                                    @endforeach
                                    @if($itemsAktif->count() > 3)
                                        <div class="w-7 h-7 rounded-full bg-gray-400 border-2 border-white flex items-center justify-center text-white text-[9px] font-bold">
                                            +{{ $itemsAktif->count() - 3 }}
                                        </div>
                                    @endif
                                </div>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full border
                                {{ $barang->status == 'tersedia' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200' }}">
                                {{ $barang->status == 'tersedia' ? 'Tersedia' : 'Habis' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($adaTerlambat)
                                <span class="inline-block px-2 py-1 text-xs font-bold rounded-full bg-red-500 text-white animate-pulse">⚠ Ya</span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('petugas.barang.show', $barang->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border-2 border-blue-600 text-blue-700 text-xs font-bold hover:bg-blue-600 hover:text-white transition">
                                Detail
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
<div class="mt-6">{{ $barangs->links() }}</div>

@else
<div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
    <svg class="mx-auto h-20 w-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
    </svg>
    <h3 class="text-lg font-bold text-gray-900 mb-2">Barang Tidak Ditemukan</h3>
    <a href="{{ route('petugas.barang.index') }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium mt-2">Lihat Semua</a>
</div>
@endif

</div>
@endsection

@push('styles')
<style>
.line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.view-btn { color: #6B7280; background: #fff; }
.view-btn.active { color: #1D4ED8; background: #EFF6FF; }
</style>
@endpush

@push('scripts')
<script>
function setView(type) {
    document.getElementById('view-card').classList.toggle('hidden', type !== 'card');
    document.getElementById('view-table').classList.toggle('hidden', type !== 'table');
    document.getElementById('btn-card').classList.toggle('active', type === 'card');
    document.getElementById('btn-table').classList.toggle('active', type === 'table');
    try { localStorage.setItem('barang-view', type); } catch(e) {}
}
document.addEventListener('DOMContentLoaded', function () {
    try { const s = localStorage.getItem('barang-view'); if (s === 'table') setView('table'); } catch(e) {}
});
</script>
@endpush