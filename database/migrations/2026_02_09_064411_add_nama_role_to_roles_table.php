<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            if (!Schema::hasColumn('roles', 'nama_role')) {
                $table->string('nama_role')->nullable()->after('kode_role');
            }
        });
        
        // Insert data sekalian (cek dulu biar gak duplicate)
        if (DB::table('roles')->count() == 0) {
            DB::table('roles')->insert([
                ['id_role' => 1, 'kode_role' => 'ADM-001', 'nama_role' => 'Admin'],
                ['id_role' => 2, 'kode_role' => 'PTG-001', 'nama_role' => 'Petugas'],
                ['id_role' => 3, 'kode_role' => 'PMJ-001', 'nama_role' => 'Peminjam'],
            ]);
        }
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('nama_role');
        });
    }
};