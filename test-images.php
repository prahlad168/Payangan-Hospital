<?php
/**
 * Test Image Deployment - RS Payangan Hospital
 * Checks if images are properly deployed
 */
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Images - RS Payangan</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #1a1a2e; color: #fff; }
        h1 { color: #0d7377; }
        .test-box { background: #16213e; padding: 15px; margin: 10px 0; border-radius: 10px; }
        .success { border-left: 4px solid #0f0; }
        .failed { border-left: 4px solid #f00; }
        img { max-width: 150px; border-radius: 10px; margin: 10px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
    </style>
</head>
<body>
    <h1>🖼️ Test Image Deployment</h1>
    <p>Checking if dokter images are properly deployed on hosting...</p>
    
    <div class="grid">
    <?php
    $test_images = [
        'img/dokter/dr-made-mulya-cintyadewi-satriawan-spa.jpg',
        'img/dokter/dr-i-gusti-putu-hery-sikesa-sppd.png',
        'img/dokter/dr-gede-agus-hendra-sujana-spog.png',
        'img/logo-official.png',
        'img/director.png',
    ];
    
    foreach ($test_images as $img) {
        $exists = file_exists(__DIR__ . '/' . $img);
        $size = $exists ? filesize(__DIR__ . '/' . $img) : 0;
        echo '<div class="test-box ' . ($exists ? 'success' : 'failed') . '">';
        echo '<strong>' . $img . '</strong><br>';
        echo 'Status: ' . ($exists ? '✅ Found' : '❌ Not Found') . '<br>';
        if ($exists) {
            echo 'Size: ' . number_format($size) . ' bytes<br>';
            echo '<img src="' . $img . '" alt="test">';
        }
        echo '</div>';
    }
    ?>
    </div>
    
    <h2>Directory Check</h2>
    <?php
    $dirs = ['img', 'img/dokter'];
    foreach ($dirs as $dir) {
        echo '<p>';
        echo $dir . ': ';
        if (is_dir(__DIR__ . '/' . $dir)) {
            $files = array_slice(scandir(__DIR__ . '/' . $dir), 0, 10);
            echo '✅ Exists (' . count($files) . ' items visible)<br>';
            echo 'Files: ' . implode(', ', $files);
        } else {
            echo '❌ Not Found';
        }
        echo '</p>';
    }
    ?>
</body>
</html>
