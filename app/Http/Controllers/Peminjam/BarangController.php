<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('category')
            ->where('status', 'tersedia')
            ->where('stok', '>', 0);

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $barangs    = $query->orderBy('nama_barang')->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->withCount(['barangs' => function($q) {
            $q->where('status', 'tersedia')->where('stok', '>', 0);
        }])->get();

        $cart = session('cart', []);

        return view('peminjam.barang.index', compact('barangs', 'categories', 'cart'));
    }

    public function show($id)
    {
        $barang = Barang::with('category')->findOrFail($id);
        $cart   = session('cart', []);
        return view('peminjam.barang.show', compact('barang', 'cart'));
    }

    public function cartAdd(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah'    => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        $cart   = session('cart', []);

        if ($request->jumlah > $barang->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia (' . $barang->stok . ').');
        }

        $cart[$barang->id] = [
            'barang_id'   => $barang->id,
            'nama_barang' => $barang->nama_barang,
            'jumlah'      => $request->jumlah,
            'stok'        => $barang->stok,
            'foto'        => $barang->foto,
        ];

        session(['cart' => $cart]);
        return back()->with('success', '"' . $barang->nama_barang . '" ditambahkan ke daftar pinjam.');
    }

    public function cartRemove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Barang dihapus dari daftar.');
    }

    public function cartClear()
    {
        session()->forget('cart');
        return back()->with('success', 'Daftar pinjam dikosongkan.');
    }
}