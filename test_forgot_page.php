<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;

echo "=== TESTING FORGOT PASSWORD PAGE ===\n\n";

// 1. Verify DB is clean
echo "1. Checking database state:\n";
$tokens = DB::table('password_reset_tokens')->count();
echo "   Tokens in DB: $tokens\n";
if ($tokens === 0) {
    echo "   ✓ Database is clean - no old tokens\n";
} else {
    echo "   ✗ WARNING: Still has $tokens tokens\n";
}

// 2. Call controller method
echo "\n2. Testing showRequestForm() method:\n";
$controller = new AuthController();
try {
    $view = $controller->showRequestForm();
    echo "   ✓ Method executed successfully\n";
    echo "   View name: " . $view->getName() . "\n";
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

// 3. Check logs for errors
echo "\n3. Recent logs:\n";
$logs = shell_exec('powershell -Command "Get-Content storage/logs/laravel.log -Tail 20 | Select-String -Pattern \"(error|warning|Error|Forgot)\""');
if (empty(trim($logs))) {
    echo "   ✓ No errors or warnings in logs\n";
} else {
    echo "   Found:\n";
    echo $logs;
}

echo "\n=== TEST COMPLETE ===\n";
echo "✓ Forgot password page should display clean with no errors\n";
echo "✓ Browser: Clear cookies first, then refresh page\n";
?>
