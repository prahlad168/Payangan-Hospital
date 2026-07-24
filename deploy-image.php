<?php
/**
 * Single Image Deploy - RS Payangan Hospital
 * Downloads specific image from GitHub
 */
header('Content-Type: text/plain; charset=utf-8');

echo "===========================================\n";
echo "   IMAGE DEPLOY - RS PAYANGAN HOSPITAL\n";
echo "===========================================\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n\n";

// Target image
$target_file = 'img/dokter/dr-made-mulya-cintyadewi-satriawan-spa.jpg';
$github_url = 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/' . $target_file;
$local_path = __DIR__ . '/' . $target_file;

echo "Downloading: $github_url\n";
echo "Target: $local_path\n\n";

// Create directory if not exists
$dir = dirname($local_path);
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
    echo "Created directory: $dir\n";
}

// Download file
$content = @file_get_contents($github_url);

if ($content !== false && strlen($content) > 0) {
    $result = file_put_contents($local_path, $content);
    if ($result !== false) {
        echo "✅ SUCCESS!\n";
        echo "File size: " . strlen($content) . " bytes\n";
        echo "Saved to: $local_path\n";
    } else {
        echo "❌ FAILED: Could not write file\n";
    }
} else {
    echo "❌ FAILED: Could not download file\n";
    echo "Error: " . error_get_last()['message'] . "\n";
}

echo "\nTime: " . date('Y-m-d H:i:s') . "\n";
