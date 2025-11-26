<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

echo "=== FULL FLOW TEST ===\n\n";

// Step 1: Clear old tokens
echo "Step 1: Clear old tokens\n";
DB::table('password_reset_tokens')->truncate();
echo "✓ Cleared\n\n";

// Step 2: Simulate forgot-password request
echo "Step 2: Send reset link\n";
$request = new Request();
$request->merge(['email' => 'cpsherecpsdisini@gmail.com']);

$controller = new AuthController();
try {
    $response = $controller->sendResetLink($request);
    echo "✓ Reset link sent\n";
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}

// Step 3: Get token from DB
echo "\nStep 3: Retrieve token from database\n";
$token_record = DB::table('password_reset_tokens')
    ->where('email', 'cpsherecpsdisini@gmail.com')
    ->first();

if (!$token_record) {
    echo "✗ Token not found in DB!\n";
    exit(1);
}

$token = $token_record->token;
echo "✓ Token retrieved: " . substr($token, 0, 20) . "...\n";
echo "  Full token: $token\n";
echo "  Length: " . strlen($token) . "\n";

// Step 4: Simulate accessing /password-reset/{token}
echo "\nStep 4: Access reset form with token\n";
try {
    $view = $controller->showResetForm($token);
    
    // Check if it's a view or redirect
    if (method_exists($view, 'render')) {
        echo "✓ SUCCESS! View returned\n";
        echo "  View name: " . get_class($view->view) . "\n";
    } else {
        echo "✗ ERROR: Got redirect instead of view\n";
        echo "  Redirect: " . $view->getTargetUrl() . "\n";
    }
} catch (\Exception $e) {
    echo "✗ Exception: " . $e->getMessage() . "\n";
    exit(1);
}

// Step 5: Check logs
echo "\nStep 5: Check recent logs\n";
$log_content = file_get_contents('storage/logs/laravel.log');
$lines = array_reverse(explode("\n", $log_content));
$found_success = false;
foreach ($lines as $line) {
    if (strpos($line, 'ALL CHECKS PASSED') !== false) {
        echo "✓ FOUND SUCCESS LOG\n";
        $found_success = true;
        break;
    }
    if (strpos($line, 'RESET FORM ACCESSED') !== false) {
        echo "✓ Found form access log\n";
    }
}

if ($found_success) {
    echo "✓ All checks passed in logs!\n";
} else {
    echo "⚠ Success log not found\n";
}

echo "\n=== TEST COMPLETE ===\n";
echo "If all steps show ✓, password reset is working correctly!\n";
?>
