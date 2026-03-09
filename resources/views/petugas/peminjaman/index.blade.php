@extends('layout_petugas.petugas')

@section('title', 'Manajemen Peminjaman')
@section('page-title', 'Manajemen Peminjaman')

@section('content')

@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="mb-4 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-medium">
        ✓ {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-4 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-medium">
        ⚠ {{ session('error') }}
    </div>
@endif

<!-- STATS -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
    @foreach([
        ['label' => 'Semua',        'key' => 'semua',        'color' => 'gray'],
        ['label' => 'Menunggu',     'key' => 'menunggu',     'color' => 'yellow'],
        ['label' => 'Disetujui',    'key' => 'disetujui',    'color' => 'blue'],
        ['label' => 'Dipinjam',     'key' => 'dipinjam',     'color' => 'indigo'],
        ['label' => 'Dikembalikan', 'key' => 'dikembalikan', 'color' => 'green'],
        ['label' => 'Ditolak',      'key' => 'ditolak',      'color' => 'red'],
    ] as $s)
    @php
        $colorStat = [
            'gray'   => 'bg-gray-50 border-gray-200 text-gray-700',
            'yellow' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
            'blue'   => 'bg-blue-50 border-blue-200 text-blue-800',
            'indigo' => 'bg-indigo-50 border-indigo-200 text-indigo-800',
            'green'  => 'bg-green-50 border-green-200 text-green-800',
            'red'    => 'bg-red-50 border-red-200 text-red-800',
        ][$s['color']];
        $isActive = $status === $s['key'];
    @endphp
    <a href="{{ route('petugas.peminjaman.index', ['status' => $s['key'], 'search' => $search]) }}"
       class="rounded-xl border p-3 text-center transition hover:shadow-md {{ $colorStat }} {{ $isActive ? 'ring-2 ring-offset-1 ring-current font-extrabold' : '' }}">
        <p class="text-2xl font-black">{{ $counts[$s['key']] }}</p>
        <p class="text-xs font-semibold mt-0.5">{{ $s['label'] }}</p>
    </a>
    @endforeach
</div>

<!-- SEARCH & FILTER -->
<div class="flex flex-col sm:flex-row gap-3 mb-5">
    <form method="GET" action="{{ route('petugas.peminjaman.index') }}" class="flex gap-2 flex-1">
        <input type="hidden" name="status" value="{{ $status }}">
        <input type="text" name="search" placeholder="Cari kode atau nama peminjam..."
               value="{{ $search }}"
               class="flex-1 text-sm rounded-xl border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-2.5">
        <button type="submit" class="px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition">Cari</button>
        @if($search)
            <a href="{{ route('petugas.peminjaman.index', ['status' => $status]) }}"
               class="px-3 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm hover:bg-gray-200">✕</a>
        @endif
    </form>
</div>

<!-- TABLE -->
@if($peminjamans->count() > 0)
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm min-w-[700px]">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="text-left px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Kode</th>
                    <th class="text-left px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Peminjam</th>
                    <th class="text-left px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Barang</th>
                    <th class="text-left px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Tanggal</th>
                    <th class="text-left px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Status</th>
                    <th class="px-5 py-3 w-28"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($peminjamans as $p)
                @php
                    $badgeMap = [
                        'menunggu'     => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                        'disetujui'    => 'bg-blue-100 text-blue-800 border-blue-300',
                        'dipinjam'     => 'bg-indigo-100 text-indigo-800 border-indigo-300',
                        'dikembalikan' => 'bg-green-100 text-green-800 border-green-300',
                        'ditolak'      => 'bg-red-100 text-red-800 border-red-300',
                    ];
                    $badge = $badgeMap[$p->status] ?? 'bg-gray-100 text-gray-700 border-gray-300';
                @endphp
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3">
                        <span class="font-mono text-xs font-bold text-gray-700">{{ $p->kode_peminjaman }}</span>
                    </td>
                    <td class="px-5 py-3">
                        <p class="font-semibold text-gray-900">{{ $p->peminjam?->name ?? '-' }}</p>
                        <p class="text-xs text-gray-400">{{ $p->created_at->diffForHumans() }}</p>
                    </td>
                    <td class="px-5 py-3">
                        <span class="font-medium text-gray-700">{{ $p->items->count() }} barang</span>
                        <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">
                            {{ $p->items->take(2)->map(fn($i) => $i->barang?->nama_barang ?? '?')->implode(', ') }}
                            @if($p->items->count() > 2) +{{ $p->items->count() - 2 }} @endif
                        </p>
                    </td>
                    <td class="px-5 py-3">
                        <p class="text-xs text-gray-700">{{ $p->tanggal_pinjam->format('d M Y') }}</p>
                        <p class="text-xs text-gray-400">s/d {{ $p->tanggal_kembali->format('d M Y') }}</p>
                    </td>
                    <td class="px-5 py-3">
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">
                            {{ $p->status_label }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-right">
                        <a href="{{ route('petugas.peminjaman.show', $p->id) }}"
                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border-2 border-blue-600 text-blue-700 text-xs font-bold hover:bg-blue-600 hover:text-white transition">
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

<div class="mt-5">{{ $peminjamans->links() }}</div>

@else
<div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
    <svg class="mx-auto h-14 w-14 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
    </svg>
    <h3 class="font-bold text-gray-900 mb-1">Tidak Ada Data</h3>
    <p class="text-sm text-gray-500">Tidak ada peminjaman dengan filter ini.</p>
</div>
@endif

@endsection