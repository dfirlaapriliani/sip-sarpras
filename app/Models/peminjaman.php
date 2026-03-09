<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Eksplisit karena Laravel salah pluralize jadi 'peminjamen'
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'petugas_id',
        'kode_peminjaman',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'keperluan',
        'catatan_peminjam',
        'catatan_petugas',
        'status',
    ];

    protected $casts = [
        'tanggal_pinjam'       => 'date',
        'tanggal_kembali'      => 'date',
        'tanggal_dikembalikan' => 'date',
    ];

    /* ─── Relations ─────────────────────────────────── */

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function items()
    {
        return $this->hasMany(PeminjamanItem::class);
    }

    /* ─── Helpers ───────────────────────────────────── */

    public static function generateKode(): string
    {
        $prefix = 'PJM-' . now()->format('Ymd') . '-';
        $last   = self::where('kode_peminjaman', 'like', $prefix . '%')
                      ->orderByDesc('id')
                      ->value('kode_peminjaman');

        $seq = $last ? (int) substr($last, -3) + 1 : 1;
        return $prefix . str_pad($seq, 3, '0', STR_PAD_LEFT);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu'     => 'Menunggu',
            'disetujui'    => 'Disetujui',
            'dipinjam'     => 'Dipinjam',
            'dikembalikan' => 'Dikembalikan',
            'ditolak'      => 'Ditolak',
            default        => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'menunggu'     => 'yellow',
            'disetujui'    => 'blue',
            'dipinjam'     => 'indigo',
            'dikembalikan' => 'green',
            'ditolak'      => 'red',
            default        => 'gray',
        };
    }
}