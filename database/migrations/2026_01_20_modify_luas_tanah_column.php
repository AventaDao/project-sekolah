<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Mengubah tipe data kolom luas_tanah dari decimal(8, 2) menjadi decimal(12, 2)
     * untuk menampung nilai hingga 9,999,999,999.99 m²
     */
    public function up(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            // Ubah kolom luas_tanah menjadi decimal dengan kapasitas lebih besar
            $table->decimal('luas_tanah', 12, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            // Kembalikan ke ukuran asli jika rollback
            $table->decimal('luas_tanah', 8, 2)->nullable()->change();
        });
    }
};
