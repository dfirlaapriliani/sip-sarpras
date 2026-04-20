<?php

namespace App\Helpers;

use App\Models\Notifikasi;
use App\Models\User;

class NotifPetugas
{
    /**
     * Kirim notifikasi ke semua petugas aktif.
     */
    public static function kirimSemua(string $judul, string $pesan, string $icon = 'info', string $url = null): void
    {
        $petugas = User::whereHas('role', fn($q) => $q->where('kode_role', 'like', 'PTG%'))->get();

        foreach ($petugas as $p) {
            Notifikasi::kirim($p->id, $judul, $pesan, $icon, $url);
        }
    }
}