<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class PeminjamController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalPeminjaman = Peminjaman::where('user_id', $userId)->count();
        $sedangDipinjam  = Peminjaman::where('user_id', $userId)->where('status', 'dipinjam')->count();
        $selesai         = Peminjaman::where('user_id', $userId)->where('status', 'dikembalikan')->count();
        $ditolak         = Peminjaman::where('user_id', $userId)->where('status', 'ditolak')->count();
        $bulanIni        = Peminjaman::where('user_id', $userId)
                            ->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();

        return view('peminjam.dashboard', compact(
            'totalPeminjaman',
            'sedangDipinjam',
            'selesai',
            'ditolak',
            'bulanIni'
        ));
    }
}