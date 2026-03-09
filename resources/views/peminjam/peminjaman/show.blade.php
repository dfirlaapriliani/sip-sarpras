@extends('layout_peminjam.peminjam')

@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('content')

<div class="max-w-2xl mx-auto">

    <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 mb-6 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Riwayat
    </a>

    @php
        $colorMap = [
            'yellow' => ['bg-yellow-100 text-yellow-800 border-yellow-300', 'bg-yellow-50 border-yellow-200'],
            'blue'   => ['bg-blue-100 text-blue-800 border-blue-300', 'bg-blue-50 border-blue-200'],
            'indigo' => ['bg-indigo-100 text-indigo-800 border-indigo-300', 'bg-indigo-50 border-indigo-200'],
            'green'  => ['bg-green-100 text-green-800 border-green-300', 'bg-green-50 border-green-200'],
            'red'    => ['bg-red-100 text-red-800 border-red-300', 'bg-red-50 border-red-200'],
            'gray'   => ['bg-gray-100 text-gray-700 border-gray-300', 'bg-gray-50 border-gray-200'],
        ];
        $c = $colorMap[$peminjaman->status_color] ?? $colorMap['gray'];
    @endphp

    <!-- STATUS CARD -->
    <div class="rounded-2xl border p-5 mb-5 {{ $c[1] }}">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 mb-1">Kode Peminjaman</p>
                <p class="font-mono font-bold text-gray-900 text-lg">{{ $peminjaman->kode_peminjaman }}</p>
            </div>
            <span class="inline-block px-3 py-1.5 text-sm font-bold rounded-full border {{ $c[0] }}">
                {{ $peminjaman->status_label }}
            </span>
        </div>
        <div class="mt-3 grid grid-cols-2 gap-3 text-xs">
            <div>
                <p class="text-gray-500">Diajukan</p>
                <p class="font-semibold text-gray-800">{{ $peminjaman->created_at->format('d M Y, H:i') }}</p>
            </div>
            @if($peminjaman->petugas)
            <div>
                <p class="text-gray-500">Diproses oleh</p>
                <p class="font-semibold text-gray-800">{{ $peminjaman->petugas->name }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- BARANG -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-5">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-900">Barang yang Dipinjam</h3>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach($peminjaman->items as $item)
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                    @if($item->barang?->foto)
                        <img src="{{ asset('storage/' . $item->barang->foto) }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('img/default.png') }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="flex-1">
                    <p class="font-bold text-gray-900 text-sm">{{ $item->barang?->nama_barang ?? 'Barang dihapus' }}</p>
                    @if($item->kondisi_kembali)
                        <p class="text-xs text-gray-500 mt-0.5">Kondisi dikembalikan: {{ $item->kondisi_kembali }}</p>
                    @endif
                </div>
                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 text-sm font-bold rounded-lg">
                    × {{ $item->jumlah }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- INFO -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-5">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-900">Informasi Peminjaman</h3>
        </div>
        <div class="px-5 py-4 grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-xs text-gray-500 mb-0.5">Tanggal Pinjam</p>
                <p class="font-semibold text-gray-900">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-0.5">Tanggal Kembali</p>
                <p class="font-semibold text-gray-900">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</p>
            </div>
            @if($peminjaman->tanggal_dikembalikan)
            <div class="col-span-2">
                <p class="text-xs text-gray-500 mb-0.5">Tanggal Dikembalikan</p>
                <p class="font-semibold text-green-700">{{ $peminjaman->tanggal_dikembalikan->format('d M Y') }}</p>
            </div>
            @endif
            <div class="col-span-2">
                <p class="text-xs text-gray-500 mb-0.5">Keperluan</p>
                <p class="font-medium text-gray-800">{{ $peminjaman->keperluan }}</p>
            </div>
            @if($peminjaman->catatan_peminjam)
            <div class="col-span-2">
                <p class="text-xs text-gray-500 mb-0.5">Catatanmu</p>
                <p class="font-medium text-gray-800">{{ $peminjaman->catatan_peminjam }}</p>
            </div>
            @endif
            @if($peminjaman->catatan_petugas)
            <div class="col-span-2">
                <p class="text-xs text-gray-500 mb-0.5">Catatan Petugas</p>
                <p class="font-medium text-gray-800">{{ $peminjaman->catatan_petugas }}</p>
            </div>
            @endif
        </div>
    </div>

    @if($peminjaman->status === 'menunggu')
    <form action="{{ route('peminjam.peminjaman.cancel', $peminjaman->id) }}" method="POST"
          onsubmit="return confirm('Yakin ingin membatalkan permohonan ini?')">
        @csrf @method('PATCH')
        <button type="submit" class="w-full py-3 rounded-xl border-2 border-red-400 text-red-600 font-bold text-sm hover:bg-red-50 transition">
            Batalkan Permohonan
        </button>
    </form>
    @endif

</div>

@endsection