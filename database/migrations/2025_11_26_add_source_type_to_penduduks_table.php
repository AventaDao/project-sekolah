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
        Schema::table('penduduks', function (Blueprint $table) {
            // Tambahkan field untuk membedakan sumber data
            // 'manual' = data kelahiran/kematian yang diinput manual admin
            // 'registrasi' = user yang baru register
            $table->enum('source_type', ['manual', 'registrasi'])->default('registrasi')->after('status_hidup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn('source_type');
        });
    }
};
