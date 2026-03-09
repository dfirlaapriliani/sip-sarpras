<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // peminjam
            $table->foreignId('petugas_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('kode_peminjaman')->unique(); // e.g. PJM-20240101-001
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->date('tanggal_dikembalikan')->nullable();
            $table->text('keperluan')->nullable();
            $table->text('catatan_peminjam')->nullable();
            $table->text('catatan_petugas')->nullable();
            $table->enum('status', [
                'menunggu',    // baru diajukan, menunggu konfirmasi petugas
                'disetujui',   // disetujui petugas, barang bisa diambil
                'dipinjam',    // barang sudah diambil
                'dikembalikan',// barang sudah dikembalikan
                'ditolak',     // ditolak petugas
            ])->default('menunggu');
            $table->timestamps();
        });

        Schema::create('peminjaman_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->string('kondisi_kembali')->nullable(); // catatan kondisi saat dikembalikan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_items');
        Schema::dropIfExists('peminjamans');
    }
};