<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== COMPREHENSIVE TOKEN DEBUG ===\n\n";

// 1. Check all tokens in DB
echo "1. ALL TOKENS IN DATABASE:\n";
$tokens = DB::table('password_reset_tokens')->get();
echo "   Total tokens: " . $tokens->count() . "\n";
foreach ($tokens as $t) {
    echo "   - Email: {$t->email}\n";
    echo "     Token: {$t->token}\n";
    echo "     Length: " . strlen($t->token) . "\n";
    echo "     Created: {$t->created_at}\n";
    echo "     Age: " . abs(now()->diffInMinutes(\Carbon\Carbon::parse($t->created_at))) . " minutes\n\n";
}

// 2. Check recent log entries
echo "2. RECENT LOG ENTRIES:\n";
$log_file = 'storage/logs/laravel.log';
if (file_exists($log_file)) {
    $lines = array_reverse(explode("\n", file_get_contents($log_file)));
    $count = 0;
    foreach ($lines as $line) {
        if ($count >= 50) break;
        if (strpos($line, 'RESET') !== false || strpos($line, 'Token') !== false || strpos($line, 'showResetForm') !== false) {
            echo "   " . trim($line) . "\n";
            $count++;
        }
    }
}

// 3. Test token query
if ($tokens->count() > 0) {
    echo "\n3. TESTING TOKEN QUERY:\n";
    $latest_token = $tokens->first();
    echo "   Using latest token: {$latest_token->token}\n";
    
    // Test 1: Direct query
    $test1 = DB::table('password_reset_tokens')
        ->where('token', $latest_token->token)
        ->first();
    echo "   Query result: " . ($test1 ? 'FOUND' : 'NOT FOUND') . "\n";
    
    // Test 2: Check data type
    echo "   Token type: " . gettype($latest_token->token) . "\n";
    echo "   Token length: " . strlen($latest_token->token) . "\n";
    echo "   Token bytes: " . bin2hex($latest_token->token) . "\n";
}

echo "\n=== DEBUG COMPLETE ===\n";
?>
