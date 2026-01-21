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
        // Set all existing users as verified to prevent lockout
        // This only affects users created before this migration
        DB::table('users')
            ->whereNull('is_verified')
            ->orWhere('is_verified', false)
            ->update(['is_verified' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed - we don't want to unverify users
    }
};
