<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'foto',
        'nama_barang',
        'stok',
        'kondisi',
        'status',
        'minimal_peminjaman',
        'deskripsi',
    ];

    protected $casts = [
        'stok'               => 'integer',
        'minimal_peminjaman' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}