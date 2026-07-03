<?php
// Webhook untuk auto-pull dan deploy dari GitHub

// Git pull
$output = shell_exec('cd /home/payangan/public_html && git pull 2>&1');

// Download deploy.php jika perlu
$deploy_url = 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/deploy.php';
$deploy_content = @file_get_contents($deploy_url);
if ($deploy_content !== false) {
    file_put_contents('/home/payangan/public_html/deploy.php', $deploy_content);
    $deploy_output = "deploy.php updated";
} else {
    $deploy_output = "deploy.php update failed";
}

// Log hasil
file_put_contents('/home/payangan/public_html/webhook.log', date('Y-m-d H:i:s') . " - Pull: $output | Deploy: $deploy_output\n", FILE_APPEND);

echo "OK: $output | $deploy_output";
