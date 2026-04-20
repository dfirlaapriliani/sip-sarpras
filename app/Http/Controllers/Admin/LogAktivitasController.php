<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $filter  = $request->input('filter', 'semua');   // semua | peminjam | petugas
        $status  = $request->input('status', 'semua');
        $search  = $request->input('search');
        $dari    = $request->input('dari');
        $sampai  = $request->input('sampai');

        $query = Peminjaman::with([
            'peminjam.role',
            'petugas.role',
            'items.barang',
        ])->orderByDesc('updated_at');

        // Filter status
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        // Filter tanggal
        if ($dari) {
            $query->whereDate('created_at', '>=', $dari);
        }
        if ($sampai) {
            $query->whereDate('created_at', '<=', $sampai);
        }

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_peminjaman', 'like', "%$search%")
                  ->orWhereHas('peminjam', fn($q2) => $q2->where('name', 'like', "%$search%"))
                  ->orWhereHas('petugas',  fn($q2) => $q2->where('name', 'like', "%$search%"))
                  ->orWhere('keperluan',   'like', "%$search%");
            });
        }

        // Filter actor (peminjam / petugas)
        if ($filter === 'peminjam') {
            // hanya tampilkan aktivitas yg dipicu peminjam (pengajuan / pembatalan)
            $query->whereIn('status', ['menunggu', 'ditolak'])
                  ->whereNull('petugas_id');
        } elseif ($filter === 'petugas') {
            // hanya tampilkan aktivitas yg sudah ditangani petugas
            $query->whereNotNull('petugas_id');
        }

        $logs = $query->paginate(20)->withQueryString();

        // Statistik ringkas
        $stats = [
            'total'        => Peminjaman::count(),
            'menunggu'     => Peminjaman::where('status', 'menunggu')->count(),
            'disetujui'    => Peminjaman::where('status', 'disetujui')->count(),
            'dipinjam'     => Peminjaman::where('status', 'dipinjam')->count(),
            'dikembalikan' => Peminjaman::where('status', 'dikembalikan')->count(),
            'ditolak'      => Peminjaman::where('status', 'ditolak')->count(),
        ];

        // Daftar petugas aktif untuk filter
        $petugasList = User::whereHas('role', fn($q) => $q->where('kode_role', 'like', 'PTG%'))
            ->orderBy('name')
            ->get();

        return view('admin.log-aktivitas.index', compact(
            'logs', 'stats', 'filter', 'status', 'search', 'dari', 'sampai', 'petugasList'
        ));
    }
}