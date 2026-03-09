<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of available items (with checklist support).
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
            ->withQueryString();

        // Ambil cart dari session untuk highlight barang yang sudah dipilih
        $cart = session('cart', []);

        return view('peminjam.barang.index', compact('barangs', 'cart'));
    }

    /**
     * Display the specified item detail.
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        $cart   = session('cart', []);

        return view('peminjam.barang.show', compact('barang', 'cart'));
    }

    /* ─── Cart (session-based) ─────────────────────────────── */

    /**
     * Tambah / update barang di cart session.
     */
    public function cartAdd(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah'    => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah > $barang->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia (' . $barang->stok . ').');
        }

        $cart = session('cart', []);
        $cart[$barang->id] = [
            'barang_id'   => $barang->id,
            'nama_barang' => $barang->nama_barang,
            'foto'        => $barang->foto,
            'stok'        => $barang->stok,
            'jumlah'      => (int) $request->jumlah,
        ];
        session(['cart' => $cart]);

        return back()->with('success', '"' . $barang->nama_barang . '" ditambahkan ke daftar pinjam.');
    }

    /**
     * Hapus satu barang dari cart.
     */
    public function cartRemove($barangId)
    {
        $cart = session('cart', []);
        unset($cart[$barangId]);
        session(['cart' => $cart]);

        return back()->with('success', 'Barang dihapus dari daftar pinjam.');
    }

    /**
     * Kosongkan seluruh cart.
     */
    public function cartClear()
    {
        session()->forget('cart');
        return back()->with('success', 'Daftar pinjam dikosongkan.');
    }
}