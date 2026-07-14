<?php
/**
 * Full Deploy Script - RS Payangan Hospital
 * Downloads ALL files from GitHub to hosting
 * Usage: https://payanganhospital.gianyarkab.go.id/deploy.php
 */
header('Content-Type: text/plain; charset=utf-8');

// Security: Only allow from localhost or specific IP
$allowed_ips = ['127.0.0.1', '::1', 'localhost'];
$client_ip = $_SERVER['REMOTE_ADDR'] ?? '';

// Uncomment below to restrict access
// if (!in_array($client_ip, $allowed_ips)) {
//     http_response_code(403);
//     die('Access denied');
// }

echo "===========================================\n";
echo "   RS PAYANGAN HOSPITAL - FULL DEPLOY\n";
echo "===========================================\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";
echo "Client IP: $client_ip\n\n";

// GitHub raw base URL
$github_raw = 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main';
$github_api = 'https://api.github.com/repos/prahlad168/Payangan-Hospital/contents';

// All files to deploy
$files = [
    // HTML Pages
    'index.html',
    'about.html',
    'dokter.html',
    'igd.html',
    'kontak.html',
    'antrean.html',
    'preview.html',
    'chat.html',
    
    // Progress folder
    'progress/index.html',
    
    // RS Admin
    'rs-admin/login.php',
    'rs-admin/logout.php',
    'rs-admin/dashboard.php',
    'rs-admin/dokter.php',
    'rs-admin/poli.php',
    'rs-admin/pasien.php',
    'rs-admin/kamar.php',
    'rs-admin/antrean.php',
    'rs-admin/igd.php',
    'rs-admin/users.php',
    'rs-admin/api/dokter.php',
    'rs-admin/api/antrean.php',
    'rs-admin/api/chat.php',
    'rs-admin/includes/auth.php',
    'rs-admin/includes/header.php',
    'rs-admin/includes/footer.php',
    'rs-admin/config/database.php',
    'rs-admin/config/schema.sql',
    
    // CSS
    'css/design-system.css',
    'css/premium-upgrade.css',
    
    // JS
    'js/premium-ui.js',
    'js/mahacare-ai.js',
    
    // API
    'api/chat-log.php',
    'api/daily-report.php',
    
    // Webhook
    'webhook.php',
    
    // Progress pages
    'progress/director-report-login.html',
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
