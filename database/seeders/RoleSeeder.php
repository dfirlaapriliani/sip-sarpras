<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {

    Role::updateOrCreate(
        ['kode_role' => 'ADM001'],
        ['nama_role' => 'Admin']
    );

    Role::updateOrCreate(
        ['kode_role' => 'PTG001'],
        ['nama_role' => 'Petugas']
    );

    Role::updateOrCreate(
        ['kode_role' => 'PMJ001'],
        ['nama_role' => 'Peminjam']
    );

        
        }
}
