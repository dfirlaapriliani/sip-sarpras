<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // ✅ TAMBAHIN INI

class Role extends Model
{
    protected $primaryKey = 'id_role';

    protected $fillable = [
        'nama_role'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id_role');
    }
}
