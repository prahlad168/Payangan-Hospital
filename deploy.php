<?php
/**
 * Direct Deploy Script - RS Payangan Hospital
 * Downloads dokter.html from GitHub to hosting
 */
header('Content-Type: text/plain; charset=utf-8');

// Config
$github_raw = 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/dokter.html';
$target_file = __DIR__ . '/dokter.html';

// Download dokter.html
$content = @file_get_contents($github_raw);

if ($content !== false) {
    $result = file_put_contents($target_file, $content);
    if ($result !== false) {
        echo "SUCCESS: dokter.html updated (" . strlen($content) . " bytes)\n";
        echo "Time: " . date('Y-m-d H:i:s') . "\n";
    } else {
        echo "ERROR: Failed to write file\n";
    }
} else {
    echo "ERROR: Failed to download from GitHub\n";
}
