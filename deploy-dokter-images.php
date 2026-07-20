<?php
/**
 * Deploy Dokter Images - RS Payangan Hospital
 * Downloads dokter images from GitHub to hosting
 * Usage: https://payanganhospital.gianyarkab.go.id/deploy-dokter-images.php
 */
header('Content-Type: text/plain; charset=utf-8');

echo "===========================================\n";
echo "   DEPLOYING DOKTER IMAGES\n";
echo "   RS PAYangan Hospital\n";
echo "===========================================\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n\n";

$github_raw = 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main';

// Create dokter directory
$dokter_dir = __DIR__ . '/img/dokter';
if (!is_dir($dokter_dir)) {
    mkdir($dokter_dir, 0755, true);
    echo "Created directory: img/dokter\n";
}

// List of dokter images from GitHub
$images = [
    'img/dokter/dr-angung-desy-spjp.png',
    'img/dokter/dr-made-mulya-cintyadewi-satriawan-spa.jpg',
    'img/dokter/dr-gede-agus-hendra-sujana-spog.png',
    'img/dokter/dr-gede-ketut-alit-satria-nugraha-spot.png',
    'img/dokter/dr-herry-juniada-sprad.png',
    'img/dokter/dr-i-gusti-putu-hery-sikesa-sppd.png',
    'img/dokter/dr-i-ketut-wahyu-tri-saputra-spot.png',
    'img/dokter/dr-i-made-brammartha-kusuma-spog.png',
    'img/dokter/dr-i-putu-swastika-kepakisan-spb.png',
    'img/dokter/dr-i-wayan-eka-arnawa-span-ti.png',
    'img/dokter/dr-i-wayan-suwarna-spb.png',
    'img/dokter/dr-ika-nurvidha-mahayanthi-mantra-spmk.png',
    'img/dokter/dr-kade-agus-sudha-naryana-spn.png',
    'img/dokter/dr-made-ayu-widyaningsih-spa.png',
    'img/dokter/dr-made-minarti-witarini-dewi-sppk.png',
    'img/dokter/dr-manik-dirgayunitri-span.png',
    'img/dokter/dr-ni-komang-dewi-mahayani-spn.png',
    'img/dokter/dr-ni-made-ayu-agustini-spa.png',
    'img/dokter/dr-pande-made-suwanpramana-spog.png',
    'img/dokter/dr-sang-ketut-widiana-sppd.png',
    'img/dokter/dr-sang-ketut-widiana-sppd.png',
    'img/dokter/dr-theresia-maharani-sari-nastiti-sppk.png',
    'img/dokter/dr-tjokorda-prima-dewi-pemayun-sppd.png',
    'img/dokter/direktur (2).png',
];

$success = 0;
$failed = 0;

foreach ($images as $img) {
    $url = $github_raw . '/' . $img;
    $target = __DIR__ . '/' . $img;
    $dir = dirname($target);
    
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    echo "Downloading: $img ... ";
    $content = @file_get_contents($url);
    
    if ($content !== false && strlen($content) > 1000) {
        file_put_contents($target, $content);
        $size = strlen($content);
        echo "✅ ($size bytes)\n";
        $success++;
    } else {
        echo "❌ FAILED\n";
        $failed++;
    }
}

echo "\n===========================================\n";
echo "Result: $success success, $failed failed\n";
echo "===========================================\n";

if ($success > 0) {
    echo "\n✅ Images deployed! Refresh dokter.html to see.\n";
}
