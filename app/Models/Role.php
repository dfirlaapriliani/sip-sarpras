<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $primaryKey = 'id_role';
    public $timestamps = false;

    protected $fillable = [
        'nama_role',
        'kode_role'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id_role');
    }

    public static function generateKodeRole(string $prefix)
    {
        $last = self::where('kode_role', 'LIKE', $prefix.'%')
            ->orderBy('kode_role', 'desc')
            ->first();

        if (!$last) {
            return $prefix . '001';
        }

        $number = (int) substr($last->kode_role, 3);
        $next = str_pad($number + 1, 3, '0', STR_PAD_LEFT);

        return $prefix . $next;
    }
}
