{{-- resources/views/admin/log-aktivitas/index.blade.php --}}
@extends('layout_admin.admin')

@section('title', 'Log Aktivitas')

@push('styles')
<style>
    .avatar-peminjam { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
    .avatar-petugas  { background: linear-gradient(135deg, #0ea5e9, #06b6d4); }
    .toggle-icon { transition: transform .2s; display: inline-block; }
    .toggle-icon.open { transform: rotate(180deg); }
</style>
@endpush

@section('content')

{{-- HEADER --}}
<div class="flex flex-wrap items-end justify-between gap-3 mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-800 flex items-center gap-2">
            📋 Log Aktivitas
        </h1>
        <p class="text-sm text-slate-500 mt-0.5">Rekam jejak semua aktivitas peminjam &amp; petugas</p>
    </div>
    <span class="text-xs font-semibold bg-slate-100 text-slate-500 px-3 py-1.5 rounded-full">
        {{ now()->translatedFormat('d F Y') }}
    </span>
</div>

{{-- STAT CARDS --}}
<div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-3 mb-6">
    @php
        $statItems = [
            ['label'=>'Total',        'key'=>'total',        'icon'=>'📦', 'border'=>'border-slate-300',  'bg'=>'bg-white'],
            ['label'=>'Menunggu',     'key'=>'menunggu',     'icon'=>'⏳', 'border'=>'border-yellow-300', 'bg'=>'bg-yellow-50'],
            ['label'=>'Disetujui',    'key'=>'disetujui',    'icon'=>'✅', 'border'=>'border-blue-300',   'bg'=>'bg-blue-50'],
            ['label'=>'Dipinjam',     'key'=>'dipinjam',     'icon'=>'🔑', 'border'=>'border-indigo-300', 'bg'=>'bg-indigo-50'],
            ['label'=>'Dikembalikan', 'key'=>'dikembalikan', 'icon'=>'🏁', 'border'=>'border-green-300',  'bg'=>'bg-green-50'],
            ['label'=>'Ditolak',      'key'=>'ditolak',      'icon'=>'❌', 'border'=>'border-red-300',    'bg'=>'bg-red-50'],
        ];
    @endphp
    @foreach($statItems as $s)
    <div class="flex items-center gap-3 p-3 rounded-xl border {{ $s['border'] }} {{ $s['bg'] }} shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-150">
        <span class="text-2xl leading-none">{{ $s['icon'] }}</span>
        <div>
            <div class="text-xl font-extrabold text-slate-800 leading-none">{{ number_format($stats[$s['key']]) }}</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">{{ $s['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- FILTER --}}
<form method="GET" action="{{ route('admin.log-aktivitas.index') }}"
      class="flex flex-wrap items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-3 mb-4 shadow-sm">

    <div class="relative flex-1 min-w-40">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm pointer-events-none">🔍</span>
        <input type="text" name="search" value="{{ $search }}"
               placeholder="Cari kode, peminjam…"
               class="w-full pl-8 pr-3 py-2 text-sm border border-slate-200 rounded-lg bg-slate-50 focus:outline-none focus:border-indigo-400 focus:bg-white transition">
    </div>

    <select name="filter" class="text-sm border border-slate-200 rounded-lg px-3 py-2 bg-slate-50 focus:outline-none focus:border-indigo-400 cursor-pointer">
        <option value="semua"    @selected($filter==='semua')>👥 Semua Aktor</option>
        <option value="peminjam" @selected($filter==='peminjam')>🙋 Peminjam</option>
        <option value="petugas"  @selected($filter==='petugas')>👷 Petugas</option>
    </select>

    <select name="status" class="text-sm border border-slate-200 rounded-lg px-3 py-2 bg-slate-50 focus:outline-none focus:border-indigo-400 cursor-pointer">
        <option value="semua"        @selected($status==='semua')>🔖 Semua Status</option>
        <option value="menunggu"     @selected($status==='menunggu')>⏳ Menunggu</option>
        <option value="disetujui"    @selected($status==='disetujui')>✅ Disetujui</option>
        <option value="dipinjam"     @selected($status==='dipinjam')>🔑 Dipinjam</option>
        <option value="dikembalikan" @selected($status==='dikembalikan')>🏁 Dikembalikan</option>
        <option value="ditolak"      @selected($status==='ditolak')>❌ Ditolak</option>
    </select>

    <input type="date" name="dari" value="{{ $dari }}"
           class="text-sm border border-slate-200 rounded-lg px-3 py-2 bg-slate-50 focus:outline-none focus:border-indigo-400">
    <span class="text-slate-300 hidden sm:inline">—</span>
    <input type="date" name="sampai" value="{{ $sampai }}"
           class="text-sm border border-slate-200 rounded-lg px-3 py-2 bg-slate-50 focus:outline-none focus:border-indigo-400">

    <button type="submit"
            class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold rounded-lg transition">
        Terapkan
    </button>
    @if($search || $filter !== 'semua' || $status !== 'semua' || $dari || $sampai)
    <a href="{{ route('admin.log-aktivitas.index') }}"
       class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-500 text-sm font-semibold rounded-lg transition">
        Reset
    </a>
    @endif
</form>

{{-- TABEL / CARD LIST --}}
<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
    @if($logs->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-slate-400">
            <span class="text-5xl mb-3">🗂️</span>
            <p class="text-sm">Tidak ada aktivitas yang cocok.</p>
        </div>
    @else

    {{-- Desktop table (hidden di mobile) --}}
    <div class="hidden lg:block">
        <table class="w-full text-sm text-left table-fixed">
            <thead>
                <tr class="bg-slate-50 border-b-2 border-slate-200 text-xs text-slate-500 uppercase tracking-wide font-bold">
                    <th class="px-4 py-3 w-8">#</th>
                    <th class="px-4 py-3 w-36">Kode</th>
                    <th class="px-4 py-3 w-44">Peminjam</th>
                    <th class="px-4 py-3 w-40">Barang</th>
                    <th class="px-4 py-3 w-36">Periode</th>
                    <th class="px-4 py-3 w-32">Status</th>
                    <th class="px-4 py-3">Aksi Petugas</th>
                    <th class="px-4 py-3 w-28">Waktu</th>
                    <th class="px-2 py-3 w-8"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $i => $log)
                @php
                    $badge = match($log->status) {
                        'menunggu'     => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'disetujui'    => 'bg-blue-100 text-blue-800 border-blue-200',
                        'dipinjam'     => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                        'dikembalikan' => 'bg-green-100 text-green-800 border-green-200',
                        'ditolak'      => 'bg-red-100 text-red-800 border-red-200',
                        default        => 'bg-slate-100 text-slate-600 border-slate-200',
                    };
                    $statusIcon = match($log->status) {
                        'menunggu'     => '⏳', 'disetujui' => '✅',
                        'dipinjam'     => '🔑', 'dikembalikan' => '🏁',
                        'ditolak'      => '❌', default => '•',
                    };
                    $aksiLabel = $log->petugas ? match($log->status) {
                        'disetujui'    => '✅ Menyetujui',
                        'dipinjam'     => '📦 Konfirmasi Ambil',
                        'dikembalikan' => '🏁 Konfirmasi Kembali',
                        'ditolak'      => '❌ Menolak',
                        default        => '• Menangani',
                    } : null;
                @endphp

                <tr class="border-b border-slate-100 hover:bg-slate-50/70 transition-colors cursor-pointer main-row"
                    data-target="det-{{ $log->id }}">

                    <td class="px-4 py-3 text-slate-400 font-bold text-xs">{{ $logs->firstItem() + $i }}</td>

                    <td class="px-4 py-3">
                        <span class="font-mono text-xs font-bold bg-slate-100 text-slate-600 px-2 py-1 rounded border border-slate-200">
                            {{ $log->kode_peminjaman }}
                        </span>
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full avatar-peminjam flex items-center justify-center text-white text-xs font-black flex-shrink-0">
                                {{ strtoupper(substr($log->peminjam->name ?? '?', 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="font-semibold text-slate-800 text-xs truncate">{{ $log->peminjam->name ?? '-' }}</div>
                                <div class="text-slate-400 text-xs truncate">{{ $log->peminjam->email ?? '' }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-1">
                            @foreach($log->items->take(2) as $item)
                                <span class="text-xs bg-slate-100 border border-slate-200 text-slate-600 px-1.5 py-0.5 rounded truncate max-w-[100px]">
                                    {{ Str::limit($item->barang->nama_barang ?? '-', 12) }} <b class="text-indigo-500">×{{ $item->jumlah }}</b>
                                </span>
                            @endforeach
                            @if($log->items->count() > 2)
                                <span class="text-xs bg-violet-100 border border-violet-200 text-violet-700 px-1.5 py-0.5 rounded">+{{ $log->items->count() - 2 }}</span>
                            @endif
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        <div class="text-xs font-semibold text-slate-700">{{ $log->tanggal_pinjam->format('d M Y') }}</div>
                        <div class="text-xs text-slate-400">→ {{ $log->tanggal_kembali->format('d M Y') }}</div>
                        @if($log->tanggal_dikembalikan)
                            <div class="text-xs text-green-600 font-semibold">✓ {{ $log->tanggal_dikembalikan->format('d M Y') }}</div>
                        @endif
                    </td>

                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-1 rounded-full border {{ $badge }}">
                            {{ $statusIcon }} {{ $log->status_label }}
                        </span>
                    </td>

                    <td class="px-4 py-3">
                        @if($log->petugas)
                            <div class="flex items-start gap-2">
                                <div class="w-7 h-7 rounded-full avatar-petugas flex items-center justify-center text-white text-xs font-black flex-shrink-0 mt-0.5">
                                    {{ strtoupper(substr($log->petugas->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-semibold text-slate-800 text-xs truncate">{{ $log->petugas->name }}</div>
                                    <div class="text-indigo-500 text-xs font-semibold">{{ $aksiLabel }}</div>
                                    @if($log->catatan_petugas)
                                        <div class="text-slate-400 text-xs italic truncate max-w-[160px]" title="{{ $log->catatan_petugas }}">
                                            💬 {{ $log->catatan_petugas }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <span class="text-xs text-slate-300 italic">— Belum ditangani</span>
                        @endif
                    </td>

                    <td class="px-4 py-3">
                        <div class="text-xs font-semibold text-slate-700">{{ $log->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-slate-400">{{ $log->created_at->format('H:i') }}</div>
                        <div class="text-xs text-slate-300">{{ $log->updated_at->diffForHumans() }}</div>
                    </td>

                    <td class="px-2 py-3 text-center">
                        <span class="toggle-icon text-slate-300 text-xs">▼</span>
                    </td>
                </tr>

                {{-- Detail Row --}}
                <tr id="det-{{ $log->id }}" class="hidden">
                    <td colspan="9" class="px-6 py-4 bg-slate-50 border-b border-slate-100">
                        <div class="flex flex-wrap gap-5 text-xs">
                            @if($log->catatan_peminjam)
                            <div>
                                <div class="font-bold text-slate-500 mb-1.5">📝 Catatan Peminjam</div>
                                <div class="bg-white border border-slate-200 rounded-lg px-3 py-2 text-slate-700 max-w-xs">{{ $log->catatan_peminjam }}</div>
                            </div>
                            @endif
                            <div>
                                <div class="font-bold text-slate-500 mb-1.5">📦 Detail Barang</div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($log->items as $item)
                                    <div class="bg-white border border-slate-200 rounded-lg px-3 py-2 flex flex-col gap-0.5">
                                        <span class="font-bold text-slate-700">{{ $item->barang->nama_barang ?? '-' }}</span>
                                        <span class="text-slate-500">Jumlah: <b>{{ $item->jumlah }}</b></span>
                                        @if($item->kondisi_kembali)
                                            <span class="bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded w-fit">{{ $item->kondisi_kembali }}</span>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @if($log->keperluan)
                            <div>
                                <div class="font-bold text-slate-500 mb-1.5">🎯 Keperluan</div>
                                <div class="bg-white border border-slate-200 rounded-lg px-3 py-2 text-slate-700 max-w-xs">{{ $log->keperluan }}</div>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile card list (hidden di lg ke atas) --}}
    <div class="lg:hidden divide-y divide-slate-100">
        @foreach($logs as $i => $log)
        @php
            $badge = match($log->status) {
                'menunggu'     => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                'disetujui'    => 'bg-blue-100 text-blue-800 border-blue-200',
                'dipinjam'     => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                'dikembalikan' => 'bg-green-100 text-green-800 border-green-200',
                'ditolak'      => 'bg-red-100 text-red-800 border-red-200',
                default        => 'bg-slate-100 text-slate-600 border-slate-200',
            };
            $statusIcon = match($log->status) {
                'menunggu'     => '⏳', 'disetujui' => '✅',
                'dipinjam'     => '🔑', 'dikembalikan' => '🏁',
                'ditolak'      => '❌', default => '•',
            };
        @endphp
        <div class="p-4">
            {{-- Top row --}}
            <div class="flex items-start justify-between gap-2 mb-2">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-full avatar-peminjam flex items-center justify-center text-white text-sm font-black flex-shrink-0">
                        {{ strtoupper(substr($log->peminjam->name ?? '?', 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-800 text-sm">{{ $log->peminjam->name ?? '-' }}</div>
                        <div class="font-mono text-xs text-slate-400">{{ $log->kode_peminjaman }}</div>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-1 rounded-full border flex-shrink-0 {{ $badge }}">
                    {{ $statusIcon }} {{ $log->status_label }}
                </span>
            </div>

            {{-- Barang --}}
            <div class="flex flex-wrap gap-1 mb-2">
                @foreach($log->items->take(3) as $item)
                    <span class="text-xs bg-slate-100 border border-slate-200 text-slate-600 px-2 py-0.5 rounded">
                        {{ Str::limit($item->barang->nama_barang ?? '-', 16) }} <b class="text-indigo-500">×{{ $item->jumlah }}</b>
                    </span>
                @endforeach
                @if($log->items->count() > 3)
                    <span class="text-xs bg-violet-100 border border-violet-200 text-violet-700 px-2 py-0.5 rounded">+{{ $log->items->count() - 3 }}</span>
                @endif
            </div>

            {{-- Periode + petugas --}}
            <div class="flex items-center justify-between text-xs text-slate-500">
                <span>{{ $log->tanggal_pinjam->format('d M') }} → {{ $log->tanggal_kembali->format('d M Y') }}</span>
                @if($log->petugas)
                    <div class="flex items-center gap-1">
                        <div class="w-5 h-5 rounded-full avatar-petugas flex items-center justify-center text-white text-xs font-black">
                            {{ strtoupper(substr($log->petugas->name, 0, 1)) }}
                        </div>
                        <span class="text-slate-500">{{ $log->petugas->name }}</span>
                    </div>
                @else
                    <span class="text-slate-300 italic">Belum ditangani</span>
                @endif
            </div>

            @if($log->keperluan)
                <div class="mt-1.5 text-xs text-slate-400 truncate">🎯 {{ $log->keperluan }}</div>
            @endif
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="px-4 py-3 border-t border-slate-100 flex justify-end">
        {{ $logs->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
document.querySelectorAll('.main-row').forEach(row => {
    row.addEventListener('click', () => {
        const det   = document.getElementById(row.dataset.target);
        const icon  = row.querySelector('.toggle-icon');
        det.classList.toggle('hidden');
        icon.classList.toggle('open');
    });
});
</script>
@endpush

@endsection