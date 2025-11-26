<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tokens = DB::table('password_reset_tokens')->get();
echo "Total tokens: " . $tokens->count() . "\n\n";

foreach($tokens as $t) {
    echo "Email: " . $t->email . "\n";
    echo "Token: " . $t->token . "\n";
    echo "Created: " . $t->created_at . "\n";
    echo "---\n";
}

// Delete all
echo "\nDeleting all tokens...\n";
DB::table('password_reset_tokens')->truncate();
echo "Done!\n";
?>
