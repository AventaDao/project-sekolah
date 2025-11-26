<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== FRESH START - CLEAR & VERIFY ===\n\n";

// 1. Clear all old tokens
echo "1. Clearing all old password reset tokens...\n";
$count = DB::table('password_reset_tokens')->count();
DB::table('password_reset_tokens')->truncate();
echo "   ✓ Cleared $count old tokens\n\n";

// 2. Verify empty
echo "2. Verifying database is empty...\n";
$remaining = DB::table('password_reset_tokens')->count();
echo "   Remaining tokens: $remaining\n";
if ($remaining === 0) {
    echo "   ✓ Database clean!\n";
} else {
    echo "   ✗ Still has tokens!\n";
}

echo "\n3. System ready for fresh test:\n";
echo "   ✓ Go to: http://localhost:8000/forgot-password\n";
echo "   ✓ Should NOT show any error\n";
echo "   ✓ Submit email to generate new token\n";

echo "\n=== READY ===\n";
?>
