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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('activity_type'); // login, logout, register, profile_update, pengajuan_surat_create, etc
            $table->text('description')->nullable();
            $table->unsignedBigInteger('related_id')->nullable(); // ID dari resource yang berkaitan
            $table->string('related_type')->nullable(); // Tipe resource (PengajuanSurat, etc)
            $table->string('ip_address')->nullable();
            $table->timestamps();

            // Index untuk performa query
            $table->index('user_id');
            $table->index('activity_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
