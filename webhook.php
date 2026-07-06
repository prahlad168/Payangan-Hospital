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
