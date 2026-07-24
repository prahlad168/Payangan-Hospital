<?php
/**
 * Progress Report Deploy Script - RS Payangan Hospital
 * Downloads laporan files from GitHub to hosting
 */
header('Content-Type: text/plain; charset=utf-8');

$github_repo = 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/progress/';
$local_dir = __DIR__ . '/';
$report_file = 'laporan-mingguan-LKE-2026-07-11.md';

echo "=== RS Payangan Hospital - Progress Report Deploy ===\n";
echo "Time: " . date('Y-m-d H:i:s') . " WIB\n\n";

// Download laporan mingguan
$source = $github_repo . $report_file;
$target = $local_dir . $report_file;

echo "Downloading: $report_file\n";
$content = @file_get_contents($source);

if ($content !== false) {
    $result = file_put_contents($target, $content);
    if ($result !== false) {
        echo "✅ SUCCESS: $report_file updated (" . strlen($content) . " bytes)\n";
    } else {
        echo "❌ ERROR: Failed to write file\n";
    }
} else {
    echo "❌ ERROR: Failed to download from GitHub\n";
}

// Also update index.html if exists
$index_source = $github_repo . 'index.html';
$index_target = $local_dir . 'index.html';

if (@file_exists($index_source)) {
    echo "\nUpdating: index.html\n";
    $index_content = @file_get_contents($index_source);
    if ($index_content !== false) {
        @file_put_contents($index_target, $index_content);
        echo "✅ SUCCESS: index.html updated\n";
    }
}

echo "\n=== Deploy Complete ===\n";
echo "URL: https://payanganhospital.gianyarkab.go.id/progress/\n";
