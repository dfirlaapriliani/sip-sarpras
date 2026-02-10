// database/migrations/xxxx_xx_xx_add_nama_role_to_roles_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('nama_role')->nullable()->after('kode_role');
        });
        
        // Insert data sekalian
        DB::table('roles')->insert([
            ['id_role' => 1, 'kode_role' => 'ADM-001', 'nama_role' => 'Admin'],
            ['id_role' => 2, 'kode_role' => 'PTG-001', 'nama_role' => 'Petugas'],
            ['id_role' => 3, 'kode_role' => 'PMJ-001', 'nama_role' => 'Peminjam'],
        ]);
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('nama_role');
        });
    }
};