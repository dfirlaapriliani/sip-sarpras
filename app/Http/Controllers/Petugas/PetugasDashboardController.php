<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_barang'    => Barang::count(),
            'barang_tersedia' => Barang::where('status', 'tersedia')->count(),
            'sedang_dipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
            'total_peminjam'  => User::whereHas('role', fn($q) => $q->where('kode_role', 'like', 'PMJ%'))->count(),
        ];

        return view('petugas.dashboard', compact('stats'));
    }

    // Endpoint AJAX auto-refresh
    public function stats()
    {
        return response()->json([
            'total_barang'    => Barang::count(),
            'barang_tersedia' => Barang::where('status', 'tersedia')->count(),
            'sedang_dipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
            'total_peminjam'  => User::whereHas('role', fn($q) => $q->where('kode_role', 'like', 'PMJ%'))->count(),
        ]);
    }
}