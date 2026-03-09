<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'icon',
        'url',
        'dibaca',
    ];

    protected $casts = [
        'dibaca' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Buat notifikasi baru untuk user tertentu.
     */
    public static function kirim(int $userId, string $judul, string $pesan, string $icon = 'info', string $url = null): void
    {
        self::create([
            'user_id' => $userId,
            'judul'   => $judul,
            'pesan'   => $pesan,
            'icon'    => $icon,
            'url'     => $url,
            'dibaca'  => false,
        ]);
    }
}