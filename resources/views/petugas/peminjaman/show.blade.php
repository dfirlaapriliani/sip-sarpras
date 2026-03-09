@extends('layout_petugas.petugas')

@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('content')

<div class="max-w-3xl mx-auto">

    <a href="{{ route('petugas.peminjaman.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 mb-6 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar
    </a>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
             class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-medium">
            ✓ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-medium">
            ⚠ {{ session('error') }}
        </div>
    @endif

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

    <!-- STATUS HEADER -->
    <div class="rounded-2xl border p-5 mb-5 {{ $c[1] }}">
        <div class="flex items-start justify-between gap-3">
            <div>
                <p class="text-xs font-semibold text-gray-500 mb-1">Kode Peminjaman</p>
                <p class="font-mono font-black text-gray-900 text-xl">{{ $peminjaman->kode_peminjaman }}</p>
                <p class="text-xs text-gray-500 mt-1">Diajukan {{ $peminjaman->created_at->format('d M Y, H:i') }}</p>
            </div>
            <span class="inline-block px-4 py-2 text-sm font-bold rounded-xl border {{ $c[0] }}">
                {{ $peminjaman->status_label }}
            </span>
        </div>
    </div>

    <!-- INFO PEMINJAM -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-5">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-900">Informasi Peminjam</h3>
        </div>
        <div class="px-5 py-4 grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-xs text-gray-500 mb-0.5">Nama</p>
                <p class="font-bold text-gray-900">{{ $peminjaman->peminjam?->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-0.5">Email</p>
                <p class="font-medium text-gray-700">{{ $peminjaman->peminjam?->email ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-0.5">Tanggal Pinjam</p>
                <p class="font-semibold text-gray-900">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-0.5">Tanggal Kembali</p>
                <p class="font-semibold text-gray-900">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</p>
            </div>
            @if($peminjaman->tanggal_dikembalikan)
            <div>
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
                <p class="text-xs text-gray-500 mb-0.5">Catatan Peminjam</p>
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

    <!-- BARANG -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-5">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-900">Barang yang Dipinjam</h3>
            <span class="text-sm text-gray-500">{{ $peminjaman->items->count() }} item</span>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach($peminjaman->items as $item)
            <div class="flex items-center gap-4 px-5 py-4" id="item-row-{{ $item->id }}">
                <div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                    @if($item->barang?->foto)
                        <img src="{{ asset('storage/' . $item->barang->foto) }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('img/default.png') }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="flex-1">
                    <p class="font-bold text-gray-900 text-sm">{{ $item->barang?->nama_barang ?? 'Barang dihapus' }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">
                        Stok saat ini: {{ $item->barang?->stok ?? '-' }} |
                        Kondisi: {{ $item->barang?->kondisi ?? 'Baik' }}
                    </p>
                    @if($item->kondisi_kembali)
                        <p class="text-xs text-blue-600 mt-0.5">Dikembalikan: {{ $item->kondisi_kembali }}</p>
                    @endif
                </div>
                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 text-sm font-bold rounded-lg">
                    × {{ $item->jumlah }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ─── ACTION PANELS ────────────────────────────────── -->

    {{-- MENUNGGU: Approve / Reject --}}
    @if($peminjaman->status === 'menunggu')
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <!-- APPROVE -->
        <div class="bg-green-50 border border-green-200 rounded-2xl p-5">
            <h4 class="font-bold text-green-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Setujui Permohonan
            </h4>
            <form action="{{ route('petugas.peminjaman.approve', $peminjaman->id) }}" method="POST">
                @csrf
                <textarea name="catatan_petugas" rows="2" placeholder="Catatan persetujuan (opsional)..."
                          class="w-full text-sm rounded-xl border-green-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 px-3 py-2 resize-none mb-3"></textarea>
                <button type="submit"
                        onclick="return confirm('Setujui permohonan ini? Stok barang akan dikurangi.')"
                        class="w-full py-2.5 bg-green-600 text-white font-bold text-sm rounded-xl hover:bg-green-700 transition">
                    ✓ Setujui
                </button>
            </form>
        </div>

        <!-- REJECT -->
        <div class="bg-red-50 border border-red-200 rounded-2xl p-5">
            <h4 class="font-bold text-red-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Tolak Permohonan
            </h4>
            <form action="{{ route('petugas.peminjaman.reject', $peminjaman->id) }}" method="POST">
                @csrf
                <textarea name="catatan_petugas" rows="2" placeholder="Alasan penolakan (wajib)..."
                          required
                          class="w-full text-sm rounded-xl border-red-300 focus:border-red-500 focus:ring-1 focus:ring-red-500 px-3 py-2 resize-none mb-3"></textarea>
                <button type="submit"
                        onclick="return confirm('Tolak permohonan ini?')"
                        class="w-full py-2.5 bg-red-600 text-white font-bold text-sm rounded-xl hover:bg-red-700 transition">
                    ✕ Tolak
                </button>
            </form>
        </div>
    </div>
    @endif

    {{-- DISETUJUI: Konfirmasi Pengambilan --}}
    @if($peminjaman->status === 'disetujui')
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5">
        <h4 class="font-bold text-blue-800 mb-2 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
            </svg>
            Konfirmasi Pengambilan Barang
        </h4>
        <p class="text-sm text-blue-700 mb-4">Klik tombol di bawah setelah peminjam mengambil barang secara langsung.</p>
        <form action="{{ route('petugas.peminjaman.pickup', $peminjaman->id) }}" method="POST">
            @csrf
            <button type="submit"
                    onclick="return confirm('Konfirmasi bahwa barang sudah diambil?')"
                    class="px-6 py-2.5 bg-blue-600 text-white font-bold text-sm rounded-xl hover:bg-blue-700 transition">
                Barang Sudah Diambil
            </button>
        </form>
    </div>
    @endif

    {{-- DIPINJAM: Konfirmasi Pengembalian --}}
    @if($peminjaman->status === 'dipinjam')
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 bg-indigo-50 border-b border-indigo-200">
            <h4 class="font-bold text-indigo-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                </svg>
                Konfirmasi Pengembalian
            </h4>
        </div>
        <div class="px-5 py-5">
            <form action="{{ route('petugas.peminjaman.return', $peminjaman->id) }}" method="POST">
                @csrf

                <!-- Kondisi per barang -->
                <div class="mb-5 space-y-3">
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wide">Kondisi Barang Dikembalikan</p>
                    @foreach($peminjaman->items as $item)
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-700 w-40 flex-shrink-0 line-clamp-1">
                            {{ $item->barang?->nama_barang ?? '-' }} (×{{ $item->jumlah }})
                        </span>
                        <select name="kondisi_kembali[{{ $item->id }}]"
                                class="flex-1 text-sm rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 py-2">
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                            <option value="Hilang">Hilang</option>
                        </select>
                    </div>
                    @endforeach
                </div>

                <div class="mb-5">
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1.5">Catatan Petugas</label>
                    <textarea name="catatan_petugas" rows="2" placeholder="Catatan pengembalian (opsional)..."
                              class="w-full text-sm rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3 py-2 resize-none">{{ $peminjaman->catatan_petugas }}</textarea>
                </div>

                <button type="submit"
                        onclick="return confirm('Konfirmasi pengembalian barang? Stok akan dikembalikan.')"
                        class="w-full py-3 bg-indigo-600 text-white font-bold text-sm rounded-xl hover:bg-indigo-700 transition shadow-md">
                    ✓ Konfirmasi Pengembalian
                </button>
            </form>
        </div>
    </div>
    @endif

</div>

@endsection