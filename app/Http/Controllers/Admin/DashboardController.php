<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $stats = [
                'total_barang'     => Barang::count(),
                'total_peminjaman' => Peminjaman::count(),
                'total_users'      => User::count(),
            ];

            $peminjaman_counts = [
                'menunggu'     => Peminjaman::where('status', 'menunggu')->count(),
                'disetujui'    => Peminjaman::where('status', 'disetujui')->count(),
                'dipinjam'     => Peminjaman::where('status', 'dipinjam')->count(),
                'dikembalikan' => Peminjaman::where('status', 'dikembalikan')->count(),
                'ditolak'      => Peminjaman::where('status', 'ditolak')->count(),
            ];

            return view('admin.dashboard', compact('stats', 'peminjaman_counts'));
        }

        if ($user->isPetugas()) {
            return view('dashboard.petugas');
        }

        if ($user->isPeminjam()) {
            return view('dashboard.peminjam');
        }

        abort(403, 'Access denied');
    }

    // Endpoint AJAX untuk auto-refresh setiap 30 detik
    public function stats()
    {
        return response()->json([
            'total_barang'     => Barang::count(),
            'total_peminjaman' => Peminjaman::count(),
            'total_users'      => User::count(),
            'menunggu'         => Peminjaman::where('status', 'menunggu')->count(),
            'disetujui'        => Peminjaman::where('status', 'disetujui')->count(),
            'dipinjam'         => Peminjaman::where('status', 'dipinjam')->count(),
            'dikembalikan'     => Peminjaman::where('status', 'dikembalikan')->count(),
            'ditolak'          => Peminjaman::where('status', 'ditolak')->count(),
        ]);
    }
}