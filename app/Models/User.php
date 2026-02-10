<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // RELASI ROLE - INI YANG PENTING!
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }
    
    // HELPER ROLE CHECK
    public function isAdmin()
    {
        return $this->role && str_starts_with($this->role->kode_role ?? '', 'ADM');
    }
    
    public function isPetugas()
    {
        return $this->role && str_starts_with($this->role->kode_role ?? '', 'PTG');
    }
    
    public function isPeminjam()
    {
        return $this->role && str_starts_with($this->role->kode_role ?? '', 'PMJ');
    }
}