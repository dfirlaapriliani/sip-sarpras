<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\PeminjamanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function create()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('peminjam.barang.index')
                ->with('error', 'Pilih barang terlebih dahulu.');
        }

        return view('peminjam.peminjaman.create', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam'   => 'required|date|after_or_equal:today',
            'tanggal_kembali'  => 'required|date|after:tanggal_pinjam',
            'keperluan'        => 'required|string|max:500',
            'catatan_peminjam' => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('peminjam.barang.index')
                ->with('error', 'Daftar pinjam kosong.');
        }

        $tanggalPinjam  = \Carbon\Carbon::parse($request->tanggal_pinjam);
        $tanggalKembali = \Carbon\Carbon::parse($request->tanggal_kembali);
        $durasiHari     = $tanggalPinjam->diffInDays($tanggalKembali);

        // Validasi stok + max hari per barang
        foreach ($cart as $item) {
            $barang = Barang::find($item['barang_id']);

            if (!$barang || $barang->stok < $item['jumlah'] || $barang->status !== 'tersedia') {
                return back()->with('error', 'Stok barang "' . $item['nama_barang'] . '" tidak mencukupi atau sudah tidak tersedia.');
            }

            // Validasi batas maksimal hari peminjaman
            if ($barang->minimal_peminjaman && $durasiHari > $barang->minimal_peminjaman) {
                return back()->with('error',
                    'Durasi peminjaman "' . $barang->nama_barang . '" melebihi batas maksimal ' .
                    $barang->minimal_peminjaman . ' hari. Kamu memilih ' . $durasiHari . ' hari.'
                )->withInput();
            }
        }

        DB::transaction(function () use ($request, $cart) {
            $peminjaman = Peminjaman::create([
                'user_id'          => auth()->id(),
                'kode_peminjaman'  => Peminjaman::generateKode(),
                'tanggal_pinjam'   => $request->tanggal_pinjam,
                'tanggal_kembali'  => $request->tanggal_kembali,
                'keperluan'        => $request->keperluan,
                'catatan_peminjam' => $request->catatan_peminjam,
                'status'           => 'menunggu',
            ]);

            foreach ($cart as $item) {
                PeminjamanItem::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_id'     => $item['barang_id'],
                    'jumlah'        => $item['jumlah'],
                ]);
            }

            session()->forget('cart');
        });

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success', 'Permohonan peminjaman berhasil diajukan! Tunggu konfirmasi petugas.');
    }

    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', auth()->id())
            ->with('items.barang')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
            ->with('items.barang', 'petugas')
            ->findOrFail($id);

        return view('peminjam.peminjaman.show', compact('peminjaman'));
    }

    public function cancel($id)
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'menunggu')
            ->findOrFail($id);

        $peminjaman->update(['status' => 'ditolak']);

        return back()->with('success', 'Permohonan berhasil dibatalkan.');
    }
}