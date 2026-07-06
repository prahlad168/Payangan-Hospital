<?php
/**
 * Webhook Auto-Deploy for Payangan Hospital
 * Triggered by GitHub push events
 */

// Security: Verify GitHub signature (optional)
$secret = 'your_webhook_secret'; // Set this in GitHub webhook settings
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$payload = file_get_contents('php://input');

if (!empty($secret) && !hash_equals('sha256=' . hash_hmac('sha256', $payload, $secret), $signature)) {
    http_response_code(403);
    die('Invalid signature');
}

// Log incoming request
$logFile = __DIR__ . '/webhook.log';
$timestamp = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

$logEntry = "[$timestamp] IP: $ip | Payload received\n";
file_put_contents($logFile, $logEntry, FILE_APPEND);

// Git pull
$output = shell_exec('cd /home/payangan/public_html && git pull 2>&1');

// Log result
$logResult = "[$timestamp] Git pull: $output\n";
file_put_contents($logFile, $logResult, FILE_APPEND);

echo "OK: " . trim($output);
