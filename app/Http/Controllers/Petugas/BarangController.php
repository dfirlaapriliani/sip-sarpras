<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Category;
use App\Models\PeminjamanItem;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('category')->orderBy('nama_barang');

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $barangs    = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        $aktifItems = PeminjamanItem::with(['peminjaman.peminjam'])
            ->whereHas('peminjaman', fn($q) => $q->whereIn('status', ['disetujui', 'dipinjam']))
            ->get()
            ->groupBy('barang_id');

        return view('petugas.barang.index', compact('barangs', 'categories', 'aktifItems'));
    }

    public function show($id)
    {
        $barang = Barang::with('category')->findOrFail($id);

        $aktifPeminjaman = PeminjamanItem::with(['peminjaman.peminjam'])
            ->where('barang_id', $id)
            ->whereHas('peminjaman', fn($q) => $q->whereIn('status', ['disetujui', 'dipinjam']))
            ->get();

        $riwayat = PeminjamanItem::with(['peminjaman.peminjam'])
            ->where('barang_id', $id)
            ->whereHas('peminjaman', fn($q) => $q->whereIn('status', ['dikembalikan', 'ditolak']))
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $totalDipinjam = PeminjamanItem::where('barang_id', $id)
            ->whereHas('peminjaman', fn($q) => $q->whereIn('status', ['disetujui', 'dipinjam']))
            ->sum('jumlah');

        $totalPernah = PeminjamanItem::where('barang_id', $id)
            ->whereHas('peminjaman', fn($q) => $q->where('status', 'dikembalikan'))
            ->count();

        return view('petugas.barang.show', compact('barang', 'aktifPeminjaman', 'riwayat', 'totalDipinjam', 'totalPernah'));
    }
}