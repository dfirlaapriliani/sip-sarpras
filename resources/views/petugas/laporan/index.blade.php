@extends('layout_petugas.petugas')

@section('title', 'Laporan Peminjaman')
@section('page-title', 'Laporan Peminjaman')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- ═══ STAT CARDS ═══ -->
    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-4">
        @php
        $statCards = [
            ['label' => 'Total',         'val' => $stats['total'],        'color' => 'blue',   'emoji' => '📋'],
            ['label' => 'Menunggu',      'val' => $stats['menunggu'],     'color' => 'yellow',  'emoji' => '⏳'],
            ['label' => 'Disetujui',     'val' => $stats['disetujui'],    'color' => 'blue',   'emoji' => '✅'],
            ['label' => 'Dipinjam',      'val' => $stats['dipinjam'],     'color' => 'orange', 'emoji' => '📦'],
            ['label' => 'Dikembalikan',  'val' => $stats['dikembalikan'], 'color' => 'green',  'emoji' => '🎉'],
            ['label' => 'Ditolak',       'val' => $stats['ditolak'],      'color' => 'red',    'emoji' => '❌'],
        ];
        $colorMap = [
            'blue'   => ['bg' => 'bg-blue-50',   'text' => 'text-blue-700',   'border' => 'border-blue-200'],
            'yellow' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'border' => 'border-yellow-200'],
            'orange' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-700', 'border' => 'border-orange-200'],
            'green'  => ['bg' => 'bg-green-50',  'text' => 'text-green-700',  'border' => 'border-green-200'],
            'red'    => ['bg' => 'bg-red-50',    'text' => 'text-red-700',    'border' => 'border-red-200'],
        ];
        @endphp

        @foreach($statCards as $card)
        @php $c = $colorMap[$card['color']] ?? $colorMap['blue']; @endphp
        <div class="bg-white rounded-2xl border {{ $c['border'] }} shadow-sm p-4 flex flex-col items-center text-center gap-1">
            <span class="text-2xl">{{ $card['emoji'] }}</span>
            <p class="text-xs text-gray-500 font-semibold">{{ $card['label'] }}</p>
            <p class="text-3xl font-extrabold {{ $c['text'] }}">{{ $card['val'] }}</p>
        </div>
        @endforeach
    </div>

    <!-- ═══ FILTER + EXPORT ═══ -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <form method="GET" action="{{ route('petugas.laporan.index') }}" id="filterForm">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">

                <!-- Search -->
                <div class="lg:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Cari Peminjam / Kode</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Nama peminjam atau kode peminjaman..."
                               class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Status</label>
                    <select name="status" class="w-full text-sm rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2.5">
                        <option value="">Semua Status</option>
                        @foreach(['menunggu','disetujui','dipinjam','dikembalikan','ditolak'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Quick Date Presets -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Periode Cepat</label>
                    <select id="quickDate" class="w-full text-sm rounded-xl border border-gray-200 focus:border-blue-500 px-3 py-2.5" onchange="applyQuickDate(this.value)">
                        <option value="">Pilih Periode...</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">7 Hari Terakhir</option>
                        <option value="month">Bulan Ini</option>
                        <option value="last_month">Bulan Lalu</option>
                        <option value="year">Tahun Ini</option>
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Dari Tanggal</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                           value="{{ request('tanggal_mulai') }}"
                           class="w-full text-sm rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2.5">
                </div>

                <!-- Tanggal Selesai -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Sampai Tanggal</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                           value="{{ request('tanggal_selesai') }}"
                           class="w-full text-sm rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2.5">
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-gray-100">
                <div class="flex gap-2">
                    <button type="submit"
                            class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-md shadow-blue-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        Terapkan Filter
                    </button>
                    @if(request()->hasAny(['search','status','tanggal_mulai','tanggal_selesai']))
                    <a href="{{ route('petugas.laporan.index') }}"
                       class="flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reset
                    </a>
                    @endif
                </div>

                <!-- Export Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('petugas.laporan.export-pdf', request()->query()) }}"
                       target="_blank"
                       class="flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white rounded-xl text-sm font-bold hover:bg-red-700 transition shadow-md shadow-red-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Export PDF
                    </a>
                    <a href="{{ route('petugas.laporan.export-excel', request()->query()) }}"
                       class="flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white rounded-xl text-sm font-bold hover:bg-green-700 transition shadow-md shadow-green-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export Excel
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ═══ TABEL DATA ═══ -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-bold text-gray-900">Data Peminjaman</h2>
                <p class="text-xs text-gray-500 mt-0.5">Total {{ $peminjamans->total() }} data ditemukan</p>
            </div>
            @if(request()->hasAny(['search','status','tanggal_mulai','tanggal_selesai']))
            <div class="flex flex-wrap gap-2">
                @if(request('status'))
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Status: {{ ucfirst(request('status')) }}</span>
                @endif
                @if(request('tanggal_mulai') || request('tanggal_selesai'))
                    <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">
                        📅 {{ request('tanggal_mulai') ? \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d M Y') : '...' }}
                        —
                        {{ request('tanggal_selesai') ? \Carbon\Carbon::parse(request('tanggal_selesai'))->format('d M Y') : '...' }}
                    </span>
                @endif
                @if(request('search'))
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">🔍 "{{ request('search') }}"</span>
                @endif
            </div>
            @endif
        </div>

        @if($peminjamans->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[900px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide w-8">No</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Kode</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Peminjam</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Barang</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Keperluan</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Tgl Pinjam</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Batas Kembali</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Status</th>
                        <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($peminjamans as $i => $p)
                    @php
                        $terlambat = in_array($p->status, ['dipinjam']) && $p->tanggal_kembali < now()->toDateString();
                        $statusConfig = [
                            'menunggu'     => ['class' => 'bg-yellow-100 text-yellow-700 border-yellow-200',  'label' => '⏳ Menunggu'],
                            'disetujui'    => ['class' => 'bg-blue-100 text-blue-700 border-blue-200',        'label' => '✅ Disetujui'],
                            'dipinjam'     => ['class' => 'bg-orange-100 text-orange-700 border-orange-200',  'label' => '📦 Dipinjam'],
                            'dikembalikan' => ['class' => 'bg-green-100 text-green-700 border-green-200',     'label' => '🎉 Dikembalikan'],
                            'ditolak'      => ['class' => 'bg-red-100 text-red-700 border-red-200',           'label' => '❌ Ditolak'],
                        ];
                        $st = $statusConfig[$p->status] ?? ['class' => 'bg-gray-100 text-gray-700 border-gray-200', 'label' => $p->status];
                    @endphp
                    <tr class="hover:bg-gray-50/70 transition {{ $terlambat ? 'bg-red-50/30' : '' }}">
                        <td class="px-4 py-3.5 text-xs text-gray-400 font-medium">{{ $peminjamans->firstItem() + $i }}</td>
                        <td class="px-4 py-3.5">
                            <span class="text-xs font-mono font-bold text-gray-700 bg-gray-100 px-2 py-1 rounded">{{ $p->kode_peminjaman }}</span>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($p->peminjam->name ?? '?', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm leading-tight">{{ $p->peminjam->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $p->peminjam->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="space-y-1">
                                @foreach($p->items->take(2) as $item)
                                <div class="flex items-center gap-1.5">
                                    <span class="text-xs font-semibold text-gray-800 leading-tight">{{ $item->barang->nama_barang ?? '-' }}</span>
                                    <span class="text-[10px] bg-orange-100 text-orange-600 font-bold px-1.5 py-0.5 rounded-full">×{{ $item->jumlah }}</span>
                                </div>
                                @endforeach
                                @if($p->items->count() > 2)
                                    <span class="text-[10px] text-gray-400">+{{ $p->items->count() - 2 }} barang lain</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <p class="text-xs text-gray-600 line-clamp-2 max-w-[160px]">{{ $p->keperluan ?? '-' }}</p>
                        </td>
                        <td class="px-4 py-3.5 text-center text-xs text-gray-600 font-medium">
                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <span class="text-xs font-bold {{ $terlambat ? 'text-red-600' : 'text-gray-700' }}">
                                {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}
                            </span>
                            @if($terlambat)
                                <br><span class="text-[10px] text-red-500 font-bold">⚠ Terlambat</span>
                            @endif
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full border {{ $st['class'] }}">
                                {{ $st['label'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <a href="{{ route('petugas.peminjaman.show', $p->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border-2 border-blue-600 text-blue-700 text-xs font-bold hover:bg-blue-600 hover:text-white transition">
                                Detail
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $peminjamans->appends(request()->query())->links() }}
        </div>

        @else
        <div class="p-16 text-center">
            <div class="text-6xl mb-4">📋</div>
            <h3 class="text-lg font-bold text-gray-700 mb-2">Tidak Ada Data</h3>
            <p class="text-sm text-gray-400 mb-4">Tidak ada data peminjaman yang cocok dengan filter yang dipilih.</p>
            <a href="{{ route('petugas.laporan.index') }}" class="inline-block px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition">
                Reset Filter
            </a>
        </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
<script>
function applyQuickDate(value) {
    const today = new Date();
    let start = null, end = null;

    if (value === 'today') {
        start = end = formatDate(today);
    } else if (value === 'week') {
        const d = new Date(today);
        d.setDate(d.getDate() - 6);
        start = formatDate(d);
        end   = formatDate(today);
    } else if (value === 'month') {
        start = formatDate(new Date(today.getFullYear(), today.getMonth(), 1));
        end   = formatDate(today);
    } else if (value === 'last_month') {
        const first = new Date(today.getFullYear(), today.getMonth() - 1, 1);
        const last  = new Date(today.getFullYear(), today.getMonth(), 0);
        start = formatDate(first);
        end   = formatDate(last);
    } else if (value === 'year') {
        start = formatDate(new Date(today.getFullYear(), 0, 1));
        end   = formatDate(today);
    }

    if (start) document.getElementById('tanggal_mulai').value = start;
    if (end)   document.getElementById('tanggal_selesai').value = end;
}

function formatDate(d) {
    return d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
}
</script>
@endpush