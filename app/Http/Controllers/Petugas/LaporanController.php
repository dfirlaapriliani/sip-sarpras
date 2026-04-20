<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Ambil query builder dengan filter yang sama untuk halaman & export.
     */
    private function buildQuery(Request $request)
    {
        $query = Peminjaman::with(['peminjam', 'items.barang', 'petugas'])
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($sub) use ($q) {
                $sub->where('kode_peminjaman', 'like', "%$q%")
                    ->orWhereHas('peminjam', fn($u) => $u->where('name', 'like', "%$q%"));
            });
        }

        return $query;
    }

    /**
     * Halaman laporan utama.
     */
    public function index(Request $request)
    {
        $peminjamans = $this->buildQuery($request)->paginate(15)->withQueryString();

        // Summary stats (tidak ter-filter, selalu total keseluruhan)
        $stats = [
            'total'        => Peminjaman::count(),
            'menunggu'     => Peminjaman::where('status', 'menunggu')->count(),
            'disetujui'    => Peminjaman::where('status', 'disetujui')->count(),
            'dipinjam'     => Peminjaman::where('status', 'dipinjam')->count(),
            'dikembalikan' => Peminjaman::where('status', 'dikembalikan')->count(),
            'ditolak'      => Peminjaman::where('status', 'ditolak')->count(),
        ];

        return view('petugas.laporan.index', compact('peminjamans', 'stats'));
    }

    /**
     * Export PDF menggunakan DomPDF (bawaaan Laravel via barryvdh/laravel-dompdf).
     */
    public function exportPdf(Request $request)
    {
        $peminjamans = $this->buildQuery($request)->get();
        $filters     = $this->getFilterLabel($request);

        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('a4', 'landscape');
        $pdf->loadView('petugas.laporan.pdf', compact('peminjamans', 'filters'));

        $filename = 'laporan-peminjaman-' . now()->format('Ymd-His') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Export Excel menggunakan PhpSpreadsheet.
     */
    public function exportExcel(Request $request)
    {
        $peminjamans = $this->buildQuery($request)->get();
        $filters     = $this->getFilterLabel($request);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Peminjaman');

        // ── Styles helper
        $boldStyle = ['font' => ['bold' => true]];
        $centerAlign = ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]];
        $fillBlue  = ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1D4ED8']]];
        $textWhite = ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']]];

        // ── Title
        $sheet->mergeCells('A1:J1');
        $sheet->setCellValue('A1', 'LAPORAN PEMINJAMAN BARANG');
        $sheet->getStyle('A1')->applyFromArray(array_merge($boldStyle, $centerAlign, [
            'font' => ['bold' => true, 'size' => 14],
        ]));

        $sheet->mergeCells('A2:J2');
        $sheet->setCellValue('A2', 'Filter: ' . $filters);
        $sheet->getStyle('A2')->applyFromArray(array_merge($centerAlign, ['font' => ['size' => 10, 'color' => ['rgb' => '6B7280']]]));

        $sheet->mergeCells('A3:J3');
        $sheet->setCellValue('A3', 'Dicetak: ' . now()->format('d M Y H:i'));
        $sheet->getStyle('A3')->applyFromArray(array_merge($centerAlign, ['font' => ['size' => 10, 'color' => ['rgb' => '6B7280']]]));

        // ── Header row
        $headers = ['No', 'Kode', 'Peminjam', 'Barang (qty)', 'Keperluan', 'Tgl Pinjam', 'Tgl Kembali', 'Tgl Dikembalikan', 'Status', 'Catatan Petugas'];
        $col = 'A';
        foreach ($headers as $h) {
            $sheet->setCellValue($col . '5', $h);
            $sheet->getStyle($col . '5')->applyFromArray(array_merge($boldStyle, $centerAlign, $fillBlue, $textWhite));
            $col++;
        }

        // ── Data rows
        $row = 6;
        foreach ($peminjamans as $i => $p) {
            $barangList = $p->items->map(fn($item) => ($item->barang?->nama_barang ?? '[dihapus]') . ' (' . $item->jumlah . ')')->implode(', ');
            $statusLabel = [
                'menunggu'     => 'Menunggu',
                'disetujui'    => 'Disetujui',
                'dipinjam'     => 'Dipinjam',
                'dikembalikan' => 'Dikembalikan',
                'ditolak'      => 'Ditolak',
            ][$p->status] ?? $p->status;

            $rowData = [
                $i + 1,
                $p->kode_peminjaman,
                $p->peminjam->name ?? '-',
                $barangList,
                $p->keperluan ?? '-',
                Carbon::parse($p->tanggal_pinjam)->format('d/m/Y'),
                Carbon::parse($p->tanggal_kembali)->format('d/m/Y'),
                $p->tanggal_dikembalikan ? Carbon::parse($p->tanggal_dikembalikan)->format('d/m/Y') : '-',
                $statusLabel,
                $p->catatan_petugas ?? '-',
            ];

            $col = 'A';
            foreach ($rowData as $val) {
                $sheet->setCellValue($col . $row, $val);
                $col++;
            }

            // Stripe rows
            if ($i % 2 === 0) {
                $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray([
                    'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F8FAFC']],
                ]);
            }

            // Status color
            $statusColors = [
                'menunggu'     => 'FEF3C7',
                'disetujui'    => 'DBEAFE',
                'dipinjam'     => 'FFEDD5',
                'dikembalikan' => 'DCFCE7',
                'ditolak'      => 'FEE2E2',
            ];
            if (isset($statusColors[$p->status])) {
                $sheet->getStyle('I' . $row)->applyFromArray([
                    'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => $statusColors[$p->status]]],
                    'font' => ['bold' => true],
                ]);
            }

            $row++;
        }

        // ── Auto width
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ── Border semua data
        if ($row > 6) {
            $sheet->getStyle('A5:J' . ($row - 1))->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => 'E5E7EB']]],
            ]);
        }

        // ── Output
        $writer   = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'laporan-peminjaman-' . now()->format('Ymd-His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    private function getFilterLabel(Request $request): string
    {
        $parts = [];
        if ($request->filled('status'))        $parts[] = 'Status: ' . ucfirst($request->status);
        if ($request->filled('tanggal_mulai')) $parts[] = 'Dari: ' . Carbon::parse($request->tanggal_mulai)->format('d M Y');
        if ($request->filled('tanggal_selesai')) $parts[] = 'Sampai: ' . Carbon::parse($request->tanggal_selesai)->format('d M Y');
        if ($request->filled('search'))        $parts[] = 'Pencarian: ' . $request->search;
        return $parts ? implode(' | ', $parts) : 'Semua Data';
    }
}