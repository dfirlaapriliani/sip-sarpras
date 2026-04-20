<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 10px; color: #1f2937; background: #fff; }

        /* Header */
        .header { background: linear-gradient(135deg, #1D4ED8, #3B82F6); color: white; padding: 20px 24px; margin-bottom: 16px; border-radius: 0 0 12px 12px; }
        .header-top { display: flex; justify-content: space-between; align-items: flex-start; }
        .header h1 { font-size: 18px; font-weight: 700; letter-spacing: 0.5px; }
        .header p { font-size: 9px; opacity: 0.85; margin-top: 3px; }
        .header .meta { text-align: right; font-size: 9px; opacity: 0.85; }
        .logo-box { width: 44px; height: 44px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 10px; }

        /* Filter badge */
        .filter-bar { background: #F0F9FF; border: 1px solid #BAE6FD; border-radius: 8px; padding: 8px 14px; margin-bottom: 14px; font-size: 9px; color: #0369A1; }
        .filter-bar strong { font-weight: 700; }

        /* Stat boxes */
        .stats { display: flex; gap: 8px; margin-bottom: 14px; }
        .stat-box { flex: 1; border-radius: 8px; padding: 10px; text-align: center; border: 1px solid; }
        .stat-box .num { font-size: 18px; font-weight: 700; display: block; }
        .stat-box .lbl { font-size: 8px; font-weight: 600; display: block; margin-top: 2px; }
        .s-blue   { background: #EFF6FF; border-color: #BFDBFE; color: #1D4ED8; }
        .s-orange { background: #FFF7ED; border-color: #FED7AA; color: #C2410C; }
        .s-green  { background: #F0FDF4; border-color: #BBF7D0; color: #166534; }
        .s-red    { background: #FEF2F2; border-color: #FECACA; color: #991B1B; }
        .s-yellow { background: #FFFBEB; border-color: #FDE68A; color: #92400E; }
        .s-gray   { background: #F9FAFB; border-color: #E5E7EB; color: #374151; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #1D4ED8; color: white; }
        thead th { padding: 8px 10px; text-align: left; font-size: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        thead th.center { text-align: center; }
        tbody tr { border-bottom: 1px solid #F3F4F6; }
        tbody tr:nth-child(even) { background: #F8FAFC; }
        tbody tr:hover { background: #F0F9FF; }
        tbody td { padding: 7px 10px; vertical-align: middle; font-size: 9px; }
        tbody td.center { text-align: center; }

        /* Status badges */
        .badge { display: inline-block; padding: 2px 8px; border-radius: 9999px; font-size: 8px; font-weight: 700; }
        .badge-menunggu     { background: #FEF3C7; color: #92400E; }
        .badge-disetujui    { background: #DBEAFE; color: #1E40AF; }
        .badge-dipinjam     { background: #FFEDD5; color: #C2410C; }
        .badge-dikembalikan { background: #DCFCE7; color: #166534; }
        .badge-ditolak      { background: #FEE2E2; color: #991B1B; }

        .terlambat { color: #DC2626; font-weight: 700; }
        .peminjam-name { font-weight: 700; color: #111827; }
        .peminjam-email { font-size: 8px; color: #9CA3AF; }
        .kode { font-family: monospace; background: #F3F4F6; padding: 1px 5px; border-radius: 4px; font-weight: 700; }
        .barang-item { margin-bottom: 2px; }
        .qty { background: #FED7AA; color: #9A3412; font-size: 7px; font-weight: 700; padding: 0px 4px; border-radius: 4px; }

        /* Footer */
        .footer { margin-top: 20px; text-align: center; font-size: 8px; color: #9CA3AF; border-top: 1px solid #E5E7EB; padding-top: 10px; }

        /* Page break */
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="header-top">
            <div>
                <div class="logo-box">📋</div>
                <h1>LAPORAN PEMINJAMAN BARANG</h1>
                <p>SIP-SARPRAS — Sistem Informasi Peminjaman Sarana Prasarana</p>
            </div>
            <div class="meta">
                <p><strong>Dicetak:</strong> {{ now()->format('d M Y, H:i') }} WIB</p>
                <p><strong>Oleh:</strong> {{ auth()->user()->name }}</p>
                <p style="margin-top:6px;"><strong>Total Data:</strong> {{ $peminjamans->count() }} record</p>
            </div>
        </div>
    </div>

    <!-- Filter Info -->
    <div class="filter-bar">
        <strong>Filter aktif:</strong> {{ $filters }}
    </div>

    <!-- Stats -->
    @php
        $statCounts = [
            'total'        => $peminjamans->count(),
            'dipinjam'     => $peminjamans->where('status','dipinjam')->count(),
            'dikembalikan' => $peminjamans->where('status','dikembalikan')->count(),
            'ditolak'      => $peminjamans->where('status','ditolak')->count(),
            'menunggu'     => $peminjamans->where('status','menunggu')->count(),
            'disetujui'    => $peminjamans->where('status','disetujui')->count(),
        ];
    @endphp
    <div class="stats">
        <div class="stat-box s-blue"><span class="num">{{ $statCounts['total'] }}</span><span class="lbl">Total</span></div>
        <div class="stat-box s-yellow"><span class="num">{{ $statCounts['menunggu'] }}</span><span class="lbl">Menunggu</span></div>
        <div class="stat-box s-blue"><span class="num">{{ $statCounts['disetujui'] }}</span><span class="lbl">Disetujui</span></div>
        <div class="stat-box s-orange"><span class="num">{{ $statCounts['dipinjam'] }}</span><span class="lbl">Dipinjam</span></div>
        <div class="stat-box s-green"><span class="num">{{ $statCounts['dikembalikan'] }}</span><span class="lbl">Dikembalikan</span></div>
        <div class="stat-box s-red"><span class="num">{{ $statCounts['ditolak'] }}</span><span class="lbl">Ditolak</span></div>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th style="width:24px">No</th>
                <th>Kode</th>
                <th>Peminjam</th>
                <th>Barang</th>
                <th>Keperluan</th>
                <th class="center">Tgl Pinjam</th>
                <th class="center">Batas Kembali</th>
                <th class="center">Tgl Dikembalikan</th>
                <th class="center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $i => $p)
            @php
                $terlambat = in_array($p->status, ['dipinjam']) && $p->tanggal_kembali < now()->toDateString();
            @endphp
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td><span class="kode">{{ $p->kode_peminjaman }}</span></td>
                <td>
                    <div class="peminjam-name">{{ $p->peminjam->name ?? '-' }}</div>
                    <div class="peminjam-email">{{ $p->peminjam->email ?? '' }}</div>
                </td>
                <td>
                    @foreach($p->items as $item)
                    <div class="barang-item">
                        {{ $item->barang->nama_barang ?? '-' }}
                        <span class="qty">×{{ $item->jumlah }}</span>
                    </div>
                    @endforeach
                </td>
                <td>{{ Str::limit($p->keperluan ?? '-', 40) }}</td>
                <td class="center">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y') }}</td>
                <td class="center {{ $terlambat ? 'terlambat' : '' }}">
                    {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') }}
                    @if($terlambat) ⚠@endif
                </td>
                <td class="center">
                    {{ $p->tanggal_dikembalikan ? \Carbon\Carbon::parse($p->tanggal_dikembalikan)->format('d/m/Y') : '—' }}
                </td>
                <td class="center">
                    <span class="badge badge-{{ $p->status }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="center" style="padding:20px;color:#9CA3AF;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem SIP-SARPRAS pada {{ now()->format('d M Y H:i') }} WIB</p>
        <p style="margin-top:3px;">Filter: {{ $filters }}</p>
    </div>

</body>
</html>