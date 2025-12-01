<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'Surat Kematian' to the enum
        DB::statement("ALTER TABLE pengajuan_surats MODIFY jenis_surat ENUM('Surat KUA', 'Surat Keterangan Tidak Mampu', 'Surat Domisili', 'Surat Keterangan Tanah', 'SKCK', 'Surat Permohonan Bantuan', 'Surat Kematian')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'Surat Kematian' from the enum
        DB::statement("ALTER TABLE pengajuan_surats MODIFY jenis_surat ENUM('Surat KUA', 'Surat Keterangan Tidak Mampu', 'Surat Domisili', 'Surat Keterangan Tanah', 'SKCK', 'Surat Permohonan Bantuan')");
    }
};
