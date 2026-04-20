<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Helpers\NotifPetugas;
use App\Models\Peminjaman;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'semua');
        $search = $request->input('search');

        $query = Peminjaman::with('peminjam', 'items.barang')
            ->orderByDesc('created_at');

        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_peminjaman', 'like', "%$search%")
                  ->orWhereHas('peminjam', fn($q2) => $q2->where('name', 'like', "%$search%"));
            });
        }

        $peminjamans = $query->paginate(15)->withQueryString();

        $counts = [
            'semua'        => Peminjaman::count(),
            'menunggu'     => Peminjaman::where('status', 'menunggu')->count(),
            'disetujui'    => Peminjaman::where('status', 'disetujui')->count(),
            'dipinjam'     => Peminjaman::where('status', 'dipinjam')->count(),
            'dikembalikan' => Peminjaman::where('status', 'dikembalikan')->count(),
            'ditolak'      => Peminjaman::where('status', 'ditolak')->count(),
        ];

        return view('petugas.peminjaman.index', compact('peminjamans', 'counts', 'status', 'search'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('peminjam', 'items.barang', 'petugas')
            ->findOrFail($id);

        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan_petugas' => 'nullable|string|max:500',
        ]);

        $peminjaman = Peminjaman::where('status', 'menunggu')
            ->with('items.barang')
            ->findOrFail($id);

        foreach ($peminjaman->items as $item) {
            if ($item->barang->stok < $item->jumlah) {
                return back()->with('error', 'Stok "' . $item->barang->nama_barang . '" tidak mencukupi.');
            }
        }

        DB::transaction(function () use ($peminjaman, $request) {
            foreach ($peminjaman->items as $item) {
                $barang        = $item->barang;
                $barang->stok -= $item->jumlah;
                if ($barang->stok <= 0) {
                    $barang->status = 'tidak tersedia';
                }
                $barang->save();
            }

            $peminjaman->update([
                'status'          => 'disetujui',
                'petugas_id'      => auth()->id(),
                'catatan_petugas' => $request->catatan_petugas,
            ]);
        });

        // Notif ke peminjam
        Notifikasi::kirim(
            $peminjaman->user_id,
            '✅ Peminjaman Disetujui!',
            'Permohonan ' . $peminjaman->kode_peminjaman . ' telah disetujui. Silakan ambil barang ke petugas.',
            'success',
            route('peminjam.peminjaman.show', $peminjaman->id)
        );

        return back()->with('success', 'Permohonan berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_petugas' => 'required|string|max:500',
        ]);

        $peminjaman = Peminjaman::where('status', 'menunggu')->findOrFail($id);

        $peminjaman->update([
            'status'          => 'ditolak',
            'petugas_id'      => auth()->id(),
            'catatan_petugas' => $request->catatan_petugas,
        ]);

        // Notif ke peminjam
        Notifikasi::kirim(
            $peminjaman->user_id,
            '❌ Peminjaman Ditolak',
            'Permohonan ' . $peminjaman->kode_peminjaman . ' ditolak. Alasan: ' . $request->catatan_petugas,
            'danger',
            route('peminjam.peminjaman.show', $peminjaman->id)
        );

        return back()->with('success', 'Permohonan berhasil ditolak.');
    }

    public function confirmPickup($id)
    {
        $peminjaman = Peminjaman::where('status', 'disetujui')->findOrFail($id);
        $peminjaman->update(['status' => 'dipinjam']);

        // Notif ke peminjam
        Notifikasi::kirim(
            $peminjaman->user_id,
            '📦 Barang Sudah Diambil',
            'Barang untuk peminjaman ' . $peminjaman->kode_peminjaman . ' telah dikonfirmasi diambil. Jangan lupa kembalikan tepat waktu!',
            'info',
            route('peminjam.peminjaman.show', $peminjaman->id)
        );

        return back()->with('success', 'Status diubah: barang sudah diambil oleh peminjam.');
    }

    public function confirmReturn(Request $request, $id)
    {
        $request->validate([
            'catatan_petugas'   => 'nullable|string|max:500',
            'kondisi_kembali'   => 'nullable|array',
            'kondisi_kembali.*' => 'nullable|string|max:255',
        ]);

        $peminjaman = Peminjaman::where('status', 'dipinjam')
            ->with('items.barang', 'peminjam')
            ->findOrFail($id);

        DB::transaction(function () use ($peminjaman, $request) {
            foreach ($peminjaman->items as $item) {
                $kondisi = $request->input("kondisi_kembali.{$item->id}");
                $item->update(['kondisi_kembali' => $kondisi]);

                $barang        = $item->barang;
                $barang->stok += $item->jumlah;
                if ($barang->stok > 0 && $barang->status === 'tidak tersedia') {
                    $barang->status = 'tersedia';
                }
                $barang->save();
            }

            $peminjaman->update([
                'status'               => 'dikembalikan',
                'tanggal_dikembalikan' => now()->toDateString(),
                'catatan_petugas'      => $request->catatan_petugas ?? $peminjaman->catatan_petugas,
            ]);
        });

        // Notif ke peminjam
        Notifikasi::kirim(
            $peminjaman->user_id,
            '🎉 Pengembalian Dikonfirmasi',
            'Pengembalian barang untuk peminjaman ' . $peminjaman->kode_peminjaman . ' telah dikonfirmasi. Terima kasih!',
            'success',
            route('peminjam.peminjaman.show', $peminjaman->id)
        );

        // Notif ke semua petugas — barang sudah kembali
        NotifPetugas::kirimSemua(
            '🏁 Barang Dikembalikan',
            ($peminjaman->peminjam->name ?? 'Peminjam') . ' mengembalikan barang untuk ' . $peminjaman->kode_peminjaman . '.',
            'success',
            route('petugas.peminjaman.show', $peminjaman->id)
        );

        return back()->with('success', 'Pengembalian barang berhasil dikonfirmasi.');
    }
}