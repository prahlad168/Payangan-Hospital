<?php
/**
 * Manual Deploy Script - Download files from GitHub
 * Access: https://payanganhospital.gianyarkab.go.id/deploy.php?key=DEPLOY_SECRET_KEY
 */

// Security: Change this to a random secret key
$secret_key = 'PAYANGAN_DEPLOY_2026';

// Check secret key
$provided_key = $_GET['key'] ?? '';
if ($provided_key !== $secret_key) {
    http_response_code(403);
    die('Access denied. Provide correct key parameter.');
}

// Define files to update from GitHub
$files = [
    'img/slider/slider-1.png' => 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/img/slider/slider-1.png',
    'img/slider/slider-2.png' => 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/img/slider/slider-2.png',
    'img/slider/slider-3.png' => 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/img/slider/slider-3.png',
    'img/slider/slider-4.png' => 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/img/slider/slider-4.png',
];

$base_path = __DIR__;
$results = [];

foreach ($files as $relative_path => $url) {
    $local_path = $base_path . '/' . $relative_path;
    $dir = dirname($local_path);
    
    // Create directory if not exists
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    // Download file
    $content = @file_get_contents($url);
    
    if ($content !== false) {
        file_put_contents($local_path, $content);
        $size = filesize($local_path);
        $results[] = "✅ $relative_path - {$size} bytes";
    } else {
        $results[] = "❌ $relative_path - FAILED to download";
    }
}

// Log results
$log = date('Y-m-d H:i:s') . " - Manual deploy\n" . implode("\n", $results) . "\n\n";
file_put_contents(__DIR__ . '/deploy.log', $log, FILE_APPEND);

echo "<h1>Deploy Results</h1>\n<pre>\n";
echo implode("\n", $results);
echo "\n</pre>\n";
echo "<p>Logged to deploy.log</p>\n";
echo "<p><a href='index.html'>← Back to Homepage</a></p>\n";
