<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    /**
     * Tandai satu notifikasi sebagai dibaca + redirect ke URL-nya.
     */
    public function baca($id)
    {
        $notif = Notifikasi::where('user_id', auth()->id())->findOrFail($id);
        $notif->update(['dibaca' => true]);

        return redirect($notif->url ?? route('peminjam.dashboard'));
    }

    /**
     * Tandai semua notifikasi sebagai dibaca.
     */
    public function bacaSemua()
    {
        Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}