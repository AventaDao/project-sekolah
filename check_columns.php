<?php
$host = 'localhost';
$db = 'aplikasi_desa';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$result = $pdo->query("DESCRIBE pengajuan_surats");
$columns = $result->fetchAll(PDO::FETCH_COLUMN, 0);

echo "Columns containing 'acta' or 'kk':\n";
foreach ($columns as $col) {
    if (stripos($col, 'acta') !== false || (stripos($col, 'kk') !== false && stripos($col, 'fc_') === 0)) {
        echo "  - $col\n";
    }
}

echo "\nAll columns:\n";
foreach ($columns as $col) {
    echo "  - $col\n";
}
?>
