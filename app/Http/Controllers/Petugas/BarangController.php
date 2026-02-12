<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $barangs = $query->orderBy('nama_barang', 'asc')->paginate(12)->withQueryString();

        return view('petugas.barang.index', compact('barangs'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        return view('petugas.barang.show', compact('barang'));
    }
}