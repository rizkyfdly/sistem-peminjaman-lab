<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            $table->date('tanggal_deadline')
                  ->nullable()
                  ->after('jam_pinjam');

            $table->time('jam_deadline')
                  ->nullable()
                  ->after('tanggal_deadline');

        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            $table->dropColumn([
                'tanggal_deadline',
                'jam_deadline'
            ]);

        });
    }
};