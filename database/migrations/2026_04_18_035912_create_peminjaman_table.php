<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            $table->string('kode_transaksi')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->date('tanggal_pinjam');
            $table->time('jam_pinjam');

            $table->date('tanggal_kembali')->nullable();
            $table->time('jam_kembali')->nullable();

            $table->string('status'); // diajukan, disetujui, dipinjam, dikembalikan
            $table->string('kondisi_kembali')->nullable();

            $table->integer('denda')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};