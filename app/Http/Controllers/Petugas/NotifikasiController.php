<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    // Ambil notifikasi untuk dropdown (AJAX)
    public function index()
    {
        // Auto-generate notif keterlambatan yang belum ada
        $this->checkKeterlambatan();

        $notifikasi = Notifikasi::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->take(15)
            ->get();

        $unread = $notifikasi->where('dibaca', false)->count();

        return response()->json([
            'notifikasi' => $notifikasi->map(fn($n) => [
                'id'         => $n->id,
                'judul'      => $n->judul,
                'pesan'      => $n->pesan,
                'icon'       => $n->icon,
                'url'        => $n->url,
                'dibaca'     => $n->dibaca,
                'waktu'      => $n->created_at->diffForHumans(),
            ]),
            'unread' => $unread,
        ]);
    }

    // Tandai satu notifikasi sebagai dibaca
    public function baca($id)
    {
        $notif = Notifikasi::where('user_id', auth()->id())->findOrFail($id);
        $notif->update(['dibaca' => true]);

        return response()->json(['ok' => true]);
    }

    // Tandai semua sebagai dibaca
    public function bacaSemua()
    {
        Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return response()->json(['ok' => true]);
    }

    // Cek peminjaman terlambat & buat notif jika belum ada
    private function checkKeterlambatan(): void
    {
        $terlambat = Peminjaman::where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', Carbon::today())
            ->with('peminjam')
            ->get();

        foreach ($terlambat as $p) {
            $keterlambatanHari = Carbon::today()->diffInDays($p->tanggal_kembali);
            $key = 'terlambat-' . $p->id . '-' . Carbon::today()->format('Ymd');

            // Cek apakah notif hari ini sudah ada (pakai pesan sebagai penanda)
            $sudahAda = Notifikasi::where('user_id', auth()->id())
                ->where('judul', 'like', '%' . $p->kode_peminjaman . '%')
                ->whereDate('created_at', Carbon::today())
                ->exists();

            if (!$sudahAda) {
                Notifikasi::kirim(
                    auth()->id(),
                    '⚠️ Terlambat: ' . $p->kode_peminjaman,
                    ($p->peminjam->name ?? 'Peminjam') . ' terlambat mengembalikan barang ' . $keterlambatanHari . ' hari.',
                    'warning',
                    route('petugas.peminjaman.show', $p->id)
                );
            }
        }
    }
}