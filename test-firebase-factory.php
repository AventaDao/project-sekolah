<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';

// Boot the application
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

try {
    \Illuminate\Support\Facades\Log::channel('firebase')->info('Firebase logging test with factory', [
        'timestamp' => now()->toIso8601String(),
        'test_type' => 'factory_implementation'
    ]);
    echo "✅ Log sent successfully!\n";
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n";
    echo $e->getTraceAsString() . "\n";
}
