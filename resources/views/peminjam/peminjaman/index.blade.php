@extends('layout_peminjam.peminjam')

@section('title', 'Riwayat Peminjaman')
@section('page-title', 'Riwayat Peminjaman')

@section('content')

@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="mb-4 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-medium">
        ✓ {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-900">Riwayat Peminjaman</h2>
        <p class="text-xs text-gray-500 mt-1">Semua permohonan yang pernah kamu ajukan</p>
    </div>
    <a href="{{ route('peminjam.barang.index') }}"
       class="px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition shadow-md">
        + Pinjam Barang
    </a>
</div>

@if($peminjamans->count() > 0)
<div class="space-y-4">
    @foreach($peminjamans as $p)
    @php
        $color = $p->status_color;
        $colorMap = [
            'yellow' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
            'blue'   => 'bg-blue-100 text-blue-800 border-blue-300',
            'indigo' => 'bg-indigo-100 text-indigo-800 border-indigo-300',
            'green'  => 'bg-green-100 text-green-800 border-green-300',
            'red'    => 'bg-red-100 text-red-800 border-red-300',
            'gray'   => 'bg-gray-100 text-gray-700 border-gray-300',
        ];
        $badge = $colorMap[$color] ?? $colorMap['gray'];
    @endphp
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition">
        <div class="px-5 py-4 flex flex-col sm:flex-row sm:items-center gap-3">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="font-mono text-xs font-bold text-gray-500">{{ $p->kode_peminjaman }}</span>
                    <span class="inline-block px-2.5 py-0.5 text-xs font-bold rounded-full border {{ $badge }}">
                        {{ $p->status_label }}
                    </span>
                </div>
                <p class="font-bold text-gray-900 text-sm mb-2">
                    {{ $p->items->count() }} barang dipinjam
                    <span class="text-gray-400 font-normal">—</span>
                    {{ implode(', ', $p->items->take(2)->map(fn($i) => $i->barang->nama_barang ?? '-')->toArray()) }}
                    @if($p->items->count() > 2) <span class="text-gray-400 text-xs">+{{ $p->items->count() - 2 }} lainnya</span> @endif
                </p>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span>📅 {{ $p->tanggal_pinjam->format('d M Y') }} — {{ $p->tanggal_kembali->format('d M Y') }}</span>
                    <span>🕐 Diajukan {{ $p->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('peminjam.peminjaman.show', $p->id) }}"
                   class="px-4 py-2 rounded-xl border-2 border-blue-600 text-blue-700 text-xs font-bold hover:bg-blue-600 hover:text-white transition">
                    Lihat Detail
                </a>
                @if($p->status === 'menunggu')
                <form action="{{ route('peminjam.peminjaman.cancel', $p->id) }}" method="POST"
                      onsubmit="return confirm('Batalkan permohonan ini?')">
                    @csrf @method('PATCH')
                    <button type="submit" class="px-4 py-2 rounded-xl border-2 border-red-300 text-red-600 text-xs font-bold hover:bg-red-50 transition">
                        Batalkan
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">{{ $peminjamans->links() }}</div>

@else
<div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
    <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
    </svg>
    <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Peminjaman</h3>
    <p class="text-sm text-gray-500 mb-5">Kamu belum pernah mengajukan peminjaman barang.</p>
    <a href="{{ route('peminjam.barang.index') }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition">
        Lihat Katalog Barang
    </a>
</div>
@endif

@endsection