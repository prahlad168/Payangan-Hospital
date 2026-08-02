<?php
/**
 * Deploy ALL Files from GitHub to Hosting
 * Downloads complete repository as zip and extracts to public_html
 * Usage: https://payanganhospital.gianyarkab.go.id/deploy-all.php
 */
header('Content-Type: text/plain; charset=utf-8');
set_time_limit(300);
ini_set('memory_limit', '512M');

echo "===========================================\n";
echo "   RS PAYANGAN HOSPITAL - DEPLOY ALL\n";
echo "===========================================\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n\n";

$zip_url = 'https://github.com/prahlad168/Payangan-Hospital/archive/refs/heads/main.zip';
$zip_file = __DIR__ . '/repo-update.zip';
$extract_dir = __DIR__ . '/repo-extract';
$repo_dir = $extract_dir . '/Payangan-Hospital-main';

// Step 1: Download zip
echo "📥 Downloading repository zip from GitHub...\n";
$zip_data = @file_get_contents($zip_url);

if ($zip_data === false) {
    echo "❌ Failed to download zip from GitHub\n";
    echo "   URL: $zip_url\n";
    exit(1);
}

echo "✅ Downloaded " . strlen($zip_data) . " bytes\n\n";

// Step 2: Save zip
echo "💾 Saving zip file...\n";
if (file_put_contents($zip_file, $zip_data) === false) {
    echo "❌ Failed to save zip file\n";
    exit(1);
}
echo "✅ Saved to: $zip_file\n\n";

// Step 3: Extract zip
echo "📦 Extracting zip...\n";

// Clean up old extraction
if (is_dir($extract_dir)) {
    echo "🧹 Cleaning old extraction...\n";
    deleteDir($extract_dir);
}

if (!class_exists('ZipArchive')) {
    echo "❌ ZipArchive class not available on this server\n";
    echo "   Trying fallback method...\n";
    
    // Fallback: use system unzip if available
    $cmd = "unzip -o " . escapeshellarg($zip_file) . " -d " . escapeshellarg($extract_dir) . " 2>&1";
    exec($cmd, $output, $return_var);
    
    if ($return_var !== 0) {
        echo "❌ Fallback unzip also failed\n";
        echo "   Output: " . implode("\n", $output) . "\n";
        exit(1);
    }
} else {
    $zip = new ZipArchive();
    if ($zip->open($zip_file) === TRUE) {
        if (!$zip->extractTo($extract_dir)) {
            echo "❌ Failed to extract zip\n";
            $zip->close();
            exit(1);
        }
        $zip->close();
    } else {
        echo "❌ Cannot open zip file\n";
        exit(1);
    }
}

echo "✅ Extracted to: $extract_dir\n\n";

// Step 4: Copy files to public_html
echo "🔄 Copying files to public_html...\n";
if (!is_dir($repo_dir)) {
    echo "❌ Extracted repo directory not found: $repo_dir\n";
    exit(1);
}

$success = 0;
$failed = 0;
$skipped = 0;

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($repo_dir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($iterator as $item) {
    $relative_path = substr($item->getPathname(), strlen($repo_dir) + 1);
    $target_path = __DIR__ . '/' . $relative_path;
    
    if ($item->isDir()) {
        if (!is_dir($target_path)) {
            mkdir($target_path, 0755, true);
            echo "📁 Created dir: $relative_path\n";
            $success++;
        } else {
            $skipped++;
        }
    } else {
        $dir = dirname($target_path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        if (copy($item->getPathname(), $target_path)) {
            echo "✅ $relative_path\n";
            $success++;
        } else {
            echo "❌ Failed: $relative_path\n";
            $failed++;
        }
    }
}

// Step 5: Cleanup
echo "\n🧹 Cleaning up temporary files...\n";
deleteDir($extract_dir);
@unlink($zip_file);

// Summary
echo "\n===========================================\n";
echo "Deploy Summary:\n";
echo "✅ Success: $success\n";
echo "⏭️  Skipped: $skipped\n";
echo "❌ Failed: $failed\n";
echo "===========================================\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";

if ($failed === 0) {
    echo "\n🎉 All files deployed successfully!\n";
    echo "🌐 Website: https://payanganhospital.gianyarkab.go.id/\n";
} else {
    echo "\n⚠️  Some files failed to deploy. Check errors above.\n";
}

function deleteDir($dir) {
    if (!is_dir($dir)) {
        @unlink($dir);
        return;
    }
    
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . '/' . $item;
        if (is_dir($path)) {
            deleteDir($path);
        } else {
            @unlink($path);
        }
    }
    @rmdir($dir);
}
?>