@extends('layout_petugas.petugas')

@section('title', 'Detail Barang')
@section('page-title', 'Detail Barang')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Back -->
    <a href="{{ route('petugas.barang.index') }}"
       class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium transition">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <!-- ═══ BARANG INFO CARD ═══ -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">

            <!-- Foto -->
            <div class="bg-gray-50 flex items-center justify-center p-8 lg:border-r border-gray-100">
                @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}"
                         class="max-w-full max-h-72 object-contain rounded-xl shadow">
                @else
                    <div class="w-48 h-48 bg-gray-200 rounded-xl flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Info -->
            <div class="lg:col-span-2 p-6 lg:p-8 flex flex-col gap-5">
                <div class="flex items-start justify-between gap-3">
                    <h1 class="text-2xl font-extrabold text-gray-900">{{ $barang->nama_barang }}</h1>
                    <span class="flex-shrink-0 px-3 py-1.5 text-sm font-bold rounded-full
                        {{ $barang->status == 'tersedia' ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-red-100 text-red-700 border border-red-300' }}">
                        {{ $barang->status == 'tersedia' ? '✓ Tersedia' : '✕ Habis' }}
                    </span>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-blue-50 rounded-xl p-4 text-center border border-blue-100">
                        <p class="text-xs text-blue-500 font-semibold mb-1">Stok Saat Ini</p>
                        <p class="text-3xl font-extrabold {{ $barang->stok <= 0 ? 'text-red-600' : ($barang->stok <= 3 ? 'text-yellow-600' : 'text-blue-700') }}">
                            {{ $barang->stok }}
                        </p>
                        @if($barang->stok <= 0)
                            <p class="text-[10px] text-red-500 font-semibold mt-1">Habis</p>
                        @elseif($barang->stok <= 3)
                            <p class="text-[10px] text-yellow-600 font-semibold mt-1">⚠ Menipis</p>
                        @else
                            <p class="text-[10px] text-blue-500 font-semibold mt-1">Aman</p>
                        @endif
                    </div>
                    <div class="bg-orange-50 rounded-xl p-4 text-center border border-orange-100">
                        <p class="text-xs text-orange-500 font-semibold mb-1">Sedang Dipinjam</p>
                        <p class="text-3xl font-extrabold text-orange-600">{{ $totalDipinjam }}</p>
                        <p class="text-[10px] text-orange-400 font-semibold mt-1">unit</p>
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 text-center border border-green-100">
                        <p class="text-xs text-green-500 font-semibold mb-1">Total Dikembalikan</p>
                        <p class="text-3xl font-extrabold text-green-600">{{ $totalPernah }}</p>
                        <p class="text-[10px] text-green-400 font-semibold mt-1">kali</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 text-center border border-gray-200">
                        <p class="text-xs text-gray-500 font-semibold mb-1">Max Pinjam</p>
                        <p class="text-3xl font-extrabold text-gray-700">{{ $barang->minimal_peminjaman ?? '—' }}</p>
                        <p class="text-[10px] text-gray-400 font-semibold mt-1">hari</p>
                    </div>
                </div>

                <!-- Detail Info -->
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Kondisi</span>
                        <span class="font-semibold text-gray-900">{{ ucfirst($barang->kondisi ?? 'Baik') }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Ditambahkan</span>
                        <span class="font-semibold text-gray-900">{{ $barang->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                @if($barang->deskripsi)
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <p class="text-xs font-bold text-gray-500 uppercase mb-1">Deskripsi</p>
                    <p class="text-sm text-gray-700 leading-relaxed">{{ $barang->deskripsi }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ═══ PEMINJAMAN AKTIF ═══ -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-gray-900">Peminjaman Aktif</h2>
                    <p class="text-xs text-gray-500">Barang yang sedang / sudah disetujui tapi belum dikembalikan</p>
                </div>
            </div>
            <span class="px-3 py-1 bg-orange-100 text-orange-700 text-sm font-bold rounded-full">
                {{ $aktifPeminjaman->count() }} transaksi
            </span>
        </div>

        @if($aktifPeminjaman->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[640px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-500 uppercase">Peminjam</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Jumlah</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Status</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Tgl Pinjam</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Batas Kembali</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Keterangan</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($aktifPeminjaman as $item)
                    @php
                        $p = $item->peminjaman;
                        $terlambat = $p->tanggal_kembali < now()->toDateString() && $p->status === 'dipinjam';
                        $hariSisa  = now()->diffInDays($p->tanggal_kembali, false);
                        $statusMap = [
                            'disetujui' => ['label' => 'Disetujui — Belum Diambil', 'class' => 'bg-blue-100 text-blue-700'],
                            'dipinjam'  => ['label' => 'Sedang Dipinjam', 'class' => 'bg-orange-100 text-orange-700'],
                        ];
                        $st = $statusMap[$p->status] ?? ['label' => $p->status, 'class' => 'bg-gray-100 text-gray-700'];
                    @endphp
                    <tr class="hover:bg-gray-50 transition {{ $terlambat ? 'bg-red-50/40' : '' }}">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($p->peminjam->name ?? '?', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm">{{ $p->peminjam->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $p->kode_peminjaman }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-block px-2.5 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded-full">
                                {{ $item->jumlah }} unit
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full {{ $st['class'] }}">
                                {{ $st['label'] }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center text-xs text-gray-600 font-medium">
                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                        </td>
                        <td class="px-5 py-3 text-center">
                            <span class="text-xs font-bold {{ $terlambat ? 'text-red-600' : ($hariSisa <= 2 ? 'text-yellow-600' : 'text-gray-700') }}">
                                {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            @if($terlambat)
                                <span class="inline-block px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-full">
                                    ⚠ Terlambat {{ abs($hariSisa) }}h
                                </span>
                            @elseif($hariSisa <= 2 && $p->status === 'dipinjam')
                                <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">
                                    ⏳ {{ $hariSisa }}h lagi
                                </span>
                            @elseif($p->status === 'disetujui')
                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                                    Menunggu diambil
                                </span>
                            @else
                                <span class="text-xs text-gray-400">Tepat waktu</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('petugas.peminjaman.show', $p->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border-2 border-blue-600 text-blue-700 text-xs font-bold hover:bg-blue-600 hover:text-white transition">
                                Lihat →
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-10 text-center text-gray-400">
            <p class="text-4xl mb-2">📦</p>
            <p class="text-sm">Tidak ada peminjaman aktif untuk barang ini</p>
        </div>
        @endif
    </div>

    <!-- ═══ RIWAYAT PEMINJAMAN ═══ -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-gray-900">Riwayat Peminjaman</h2>
                <p class="text-xs text-gray-500">10 peminjaman terakhir yang sudah selesai/ditolak</p>
            </div>
        </div>

        @if($riwayat->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[580px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-5 py-3 text-xs font-bold text-gray-500 uppercase">Peminjam</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Jumlah</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Status Akhir</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Tgl Pinjam</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Tgl Kembali</th>
                        <th class="text-center px-5 py-3 text-xs font-bold text-gray-500 uppercase">Kondisi</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($riwayat as $item)
                    @php $p = $item->peminjaman; @endphp
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gray-400 flex items-center justify-center text-white text-[10px] font-bold">
                                    {{ strtoupper(substr($p->peminjam->name ?? '?', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 text-xs">{{ $p->peminjam->name ?? '-' }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $p->kode_peminjaman }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-center text-xs font-bold text-gray-700">{{ $item->jumlah }} unit</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full
                                {{ $p->status === 'dikembalikan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $p->status === 'dikembalikan' ? '✓ Dikembalikan' : '✕ Ditolak' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center text-xs text-gray-600">
                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                        </td>
                        <td class="px-5 py-3 text-center text-xs text-gray-600">
                            {{ $p->tanggal_dikembalikan ? \Carbon\Carbon::parse($p->tanggal_dikembalikan)->format('d M Y') : '—' }}
                        </td>
                        <td class="px-5 py-3 text-center text-xs text-gray-600">
                            {{ $item->kondisi_kembali ?? '—' }}
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('petugas.peminjaman.show', $p->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-300 text-gray-600 text-xs font-semibold hover:bg-gray-100 transition">
                                Lihat
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-10 text-center text-gray-400">
            <p class="text-4xl mb-2">📋</p>
            <p class="text-sm">Belum ada riwayat peminjaman</p>
        </div>
        @endif
    </div>

</div>
@endsection