<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Penduduk;

echo "=== CHECKING PENDUDUK DATA ===\n\n";

$total = Penduduk::count();
echo "Total Penduduk in database: $total\n";

$hidup = Penduduk::where('status_hidup', 'Hidup')->count();
echo "Penduduk with status_hidup = 'Hidup': $hidup\n";

$null = Penduduk::whereNull('status_hidup')->count();
echo "Penduduk with status_hidup = NULL: $null\n";

$meninggal = Penduduk::where('status_hidup', 'Meninggal')->count();
echo "Penduduk with status_hidup = 'Meninggal': $meninggal\n";

echo "\n=== ALL PENDUDUK RECORDS ===\n";
$all = Penduduk::all();
foreach ($all as $p) {
    echo "NIK: {$p->nik} | Nama: {$p->nama_lengkap} | Status Hidup: " . ($p->status_hidup ?? 'NULL') . "\n";
}
