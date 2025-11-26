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
            // Check if source_type column doesn't exist, then add it
            if (!Schema::hasColumn('penduduks', 'source_type')) {
                $table->enum('source_type', ['manual', 'registrasi'])->default('registrasi')->after('status_hidup');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            if (Schema::hasColumn('penduduks', 'source_type')) {
                $table->dropColumn('source_type');
            }
        });
    }
};
