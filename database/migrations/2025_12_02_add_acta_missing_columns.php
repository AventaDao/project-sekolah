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
        // Add the missing acta columns
        if (!Schema::hasColumn('pengajuan_surats', 'fc_akta_kelahiran_ibu_acta')) {
            Schema::table('pengajuan_surats', function (Blueprint $table) {
                $table->text('fc_akta_kelahiran_ibu_acta')->nullable()->after('sptjm_acta');
            });
        }
        
        if (!Schema::hasColumn('pengajuan_surats', 'fc_akta_kelahiran_ayah_acta')) {
            Schema::table('pengajuan_surats', function (Blueprint $table) {
                $table->text('fc_akta_kelahiran_ayah_acta')->nullable()->after('fc_akta_kelahiran_ibu_acta');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_surats', 'fc_akta_kelahiran_ibu_acta')) {
                $table->dropColumn('fc_akta_kelahiran_ibu_acta');
            }
            if (Schema::hasColumn('pengajuan_surats', 'fc_akta_kelahiran_ayah_acta')) {
                $table->dropColumn('fc_akta_kelahiran_ayah_acta');
            }
        });
    }
};
