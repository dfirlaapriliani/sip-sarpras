<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'nama_barang',
        'stok',
        'kondisi',
        'status',
        'minimal_peminjaman',
        'deskripsi'
    ];

    protected $casts = [
        'stok' => 'integer',
        'minimal_peminjaman' => 'integer',
    ];
}