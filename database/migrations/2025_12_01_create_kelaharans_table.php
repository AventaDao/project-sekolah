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
        Schema::create('kelaharans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penduduk_id');
            $table->string('nomor_akta')->nullable();
            $table->date('tanggal_daftar')->nullable();
            $table->enum('penolong', ['Dokter', 'Bidan', 'Perawat', 'Dukun', 'Keluarga', 'Lainnya'])->nullable();
            $table->enum('tempat', ['Rumah Sakit', 'Klinik', 'Puskesmas', 'Rumah', 'Lainnya'])->nullable();
            $table->float('berat')->nullable(); // dalam kg
            $table->float('panjang')->nullable(); // dalam cm
            $table->timestamps();

            // Foreign key
            $table->foreign('penduduk_id')->references('id')->on('penduduks')->onDelete('cascade');
            
            // Index
            $table->index('penduduk_id');
            $table->index('tanggal_daftar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelaharans');
    }
};
