<?php

use App\Models\Penduduk;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DEBUG PENDUDUK DATA ===\n\n";

$total = Penduduk::count();
echo "Total Penduduk: $total\n\n";

$penduduks = Penduduk::all();
foreach ($penduduks as $p) {
    $status = $p->status_hidup ?? 'NULL';
    echo "- {$p->nama_lengkap}: status_hidup = '{$status}'\n";
}

echo "\n=== QUERY TESTS ===\n";
echo "Where status_hidup = 'Hidup': " . Penduduk::where('status_hidup', 'Hidup')->count() . "\n";
echo "Where status_hidup IS NULL: " . Penduduk::whereNull('status_hidup')->count() . "\n";
echo "Where status_hidup = 'Hidup' OR NULL: " . Penduduk::where(function ($query) {
    $query->where('status_hidup', 'Hidup')->orWhereNull('status_hidup');
})->count() . "\n";
