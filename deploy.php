<?php
/**
 * Direct Deploy Script - RS Payangan Hospital
 * Downloads all premium design files from GitHub to hosting
 */
header('Content-Type: text/plain; charset=utf-8');

// GitHub raw base URL
$github_raw = 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main';

// Files to download
$files = [
    'index.html',
    'preview.html',
    'css/design-system.css',
    'css/premium-upgrade.css',
    'js/premium-ui.js',
    'js/mahacare-ai.js',
    'api/chat-log.php',
    'api/daily-report.php',
];

$success = 0;
$failed = 0;

foreach ($files as $file) {
    $url = $github_raw . '/' . $file;
    $target = __DIR__ . '/' . $file;
    
    // Create directory if not exists
    $dir = dirname($target);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    // Download file
    $content = @file_get_contents($url);
    
    if ($content !== false) {
        $result = file_put_contents($target, $content);
        if ($result !== false) {
            echo "✅ $file (" . strlen($content) . " bytes)\n";
            $success++;
        } else {
            echo "❌ Failed to write: $file\n";
            $failed++;
        }
    } else {
        echo "❌ Failed to download: $file\n";
        $failed++;
    }
}

echo "\n";
echo "Deploy Summary:\n";
echo "✅ Success: $success\n";
echo "❌ Failed: $failed\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";

if ($failed === 0) {
    echo "\n🎉 All files deployed successfully!\n";
}
