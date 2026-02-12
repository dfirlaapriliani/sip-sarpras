<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Disp lay a listing of available items.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $barangs = Barang::where('stok', '>', 0)
            ->where('status', 'tersedia')
            ->when($search, function ($query, $search) {
                $query->where('nama_barang', 'like', '%' . $search . '%');
            })
            ->orderBy('nama_barang', 'asc')
            ->paginate(12)
            ->withQueryString(); // agar link pagination tetap bawa ?search=...

        return view('peminjam.barang.index', compact('barangs'));
    }

    /**
     * Display the specified item detail.
     */
    public function show($id)
    {
        // Ambil detail barang tanpa relasi kategori
        $barang = Barang::findOrFail($id);

        return view('peminjam.barang.show', compact('barang'));
    }
}