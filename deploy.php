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
    'index.html' => 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/index.html',
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


    <style>
        /* ========== LOGO SHIMMER & GLOW ANIMATION ========== */
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes glow {
            0%, 100% { 
                filter: drop-shadow(0 0 8px rgba(244, 196, 48, 0.6));
            }
            50% { 
                filter: drop-shadow(0 0 20px rgba(244, 196, 48, 0.9)) drop-shadow(0 0 35px rgba(244, 196, 48, 0.5));
            }
        }
        .logo-shimmer-wrap {
            position: relative;
            display: inline-block;
        }
        .logo-shimmer-wrap::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent 0%,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.4) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
            pointer-events: none;
            z-index: 10;
            border-radius: inherit;
        }
        .logo-shimmer-wrap img {
            position: relative;
            z-index: 1;
            animation: glow 2s ease-in-out infinite;
        }
        /* ========== END LOGO ANIMATION ========== */
    </style>
