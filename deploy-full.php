<?php
/**
 * Full Deploy Script with Images - RS Payangan Hospital
 * Downloads ALL files including images from GitHub to hosting
 * Usage: https://payanganhospital.gianyarkab.go.id/deploy-full.php
 */
header('Content-Type: text/plain; charset=utf-8');

echo "===========================================\n";
echo "   RS PAYANGAN HOSPITAL - FULL DEPLOY\n";
echo "   Including ALL Images\n";
echo "===========================================\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n\n";

// GitHub URLs
$github_raw = 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main';
$github_api = 'https://api.github.com/repos/prahlad168/Payangan-Hospital/contents';

$success = 0;
$failed = 0;

// Deploy directory recursively
function deployDir($path, $github_raw, $github_api, &$success, &$failed) {
    $api_url = $github_api . '/' . $path;
    $json = @file_get_contents($api_url);
    
    if (!$json) {
        echo "❌ Cannot read directory: $path\n";
        $failed++;
        return;
    }
    
    $items = json_decode($json, true) ?: [];
    
    foreach ($items as $item) {
        $item_path = $item['path'];
        $local_path = __DIR__ . '/' . $item_path;
        
        if ($item['type'] === 'file') {
            $content = @file_get_contents($item['download_url']);
            if ($content !== false) {
                $dir = dirname($local_path);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                file_put_contents($local_path, $content);
                echo "✅ $item_path\n";
                $success++;
            } else {
                echo "❌ Failed: $item_path\n";
                $failed++;
            }
        } elseif ($item['type'] === 'dir') {
            if (!is_dir($local_path)) {
                mkdir($local_path, 0755, true);
            }
            deployDir($item_path, $github_raw, $github_api, $success, $failed);
        }
    }
}

// Deploy main folders with images
echo "--- Deploying img/ folder (including dokter images) ---\n";
deployDir('img', $github_raw, $github_api, $success, $failed);

echo "\n--- Deploying other folders ---\n";

// Deploy other essential files
$files = [
    'index.html', 'about.html', 'dokter.html', 'igd.html', 'kontak.html',
    'antrean.html', 'preview.html', 'chat.html', 'webhook.php', 'deploy.php',
    'deploy-full.php', 'deploy-image.php',
    'progress/index.html', 'progress/director-report-login.html',
    'css/design-system.css', 'css/premium-upgrade.css', 'css/brand.css',
    'js/premium-ui.js', 'js/mahacare-ai.js',
    'api/chat-log.php', 'api/daily-report.php',
];

foreach ($files as $file) {
    $url = $github_raw . '/' . $file;
    $target = __DIR__ . '/' . $file;
    
    $content = @file_get_contents($url);
    if ($content !== false) {
        $dir = dirname($target);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($target, $content);
        echo "✅ $file\n";
        $success++;
    }
}

// Deploy RS Admin
echo "\n--- Deploying rs-admin/ ---\n";
deployDir('rs-admin', $github_raw, $github_api, $success, $failed);

echo "\n===========================================\n";
echo "Deploy Summary:\n";
echo "✅ Success: $success\n";
echo "❌ Failed: $failed\n";
echo "===========================================\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";

if ($failed === 0) {
    echo "\n🎉 All files deployed successfully!\n";
}
