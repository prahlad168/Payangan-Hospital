<?php
/**
 * Authentication Helper - RS Payangan Hospital
 * 
 * Include this file in all protected pages
 */

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['user_id']) && isset($_SESSION['role']);
}

/**
 * Get current user info
 */
function get_current_user() {
    if (!is_logged_in()) {
        return null;
    }
    return [
        'user_id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'nama' => $_SESSION['nama'] ?? null,
        'email' => $_SESSION['email'] ?? null,
        'role' => $_SESSION['role'] ?? null,
        'login_time' => $_SESSION['login_time'] ?? null
    ];
}

/**
 * Check user role
 */
function has_role($roles) {
    if (!is_logged_in()) {
        return false;
    }
    $user_role = $_SESSION['role'] ?? '';
    return in_array($user_role, (array)$roles);
}

/**
 * Require authentication - redirect to login if not logged in
 */
function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
    
    // Check session timeout (1 hour)
    if (isset($_SESSION['last_activity'])) {
        $timeout = 3600; // 1 hour
        if (time() - $_SESSION['last_activity'] > $timeout) {
            session_destroy();
            header('Location: login.php?timeout=1');
            exit;
        }
    }
    
    // Update last activity
    $_SESSION['last_activity'] = time();
}

/**
 * Require specific role(s) - redirect to login if unauthorized
 */
function require_role($roles) {
    require_login();
    
    if (!has_role($roles)) {
        http_response_code(403);
        die('
        <!DOCTYPE html>
        <html>
        <head>
            <title>Akses Ditolak</title>
            <style>
                body { font-family: Arial, sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; background: #f8f9fa; }
                .error-box { background: white; padding: 40px; border-radius: 12px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
                .error-box h1 { color: #dc2626; }
                .error-box a { color: #1a5f5a; text-decoration: none; }
            </style>
        
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

</head>
        <body>
            <div class="error-box">
                <h1>⛔ Akses Ditolak</h1>
                <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
                <p>Silakan <a href="dashboard.php">kembali ke dashboard</a>.</p>
            </div>
        </body>
        </html>');
    }
}

/**
 * Log activity
 */
function log_activity($action, $module = '', $detail = '') {
    // In production, save to database
    $log = sprintf(
        "[%s] User: %s | Role: %s | Action: %s | Module: %s | Detail: %s\n",
        date('Y-m-d H:i:s'),
        $_SESSION['username'] ?? 'unknown',
        $_SESSION['role'] ?? 'unknown',
        $action,
        $module,
        $detail
    );
    
    // Append to log file
    $log_file = __DIR__ . '/../logs/activity.log';
    if (!is_dir(dirname($log_file))) {
        mkdir(dirname($log_file), 0755, true);
    }
    file_put_contents($log_file, $log, FILE_APPEND);
}

/**
 * Get role display name
 */
function get_role_display($role) {
    $roles = [
        'direktur' => 'Direktur',
        'admin' => 'Administrator',
        'karyawan' => 'Karyawan'
    ];
    return $roles[$role] ?? ucfirst($role);
}

/**
 * Get role badge color
 */
function get_role_badge_color($role) {
    $colors = [
        'direktur' => '#c9a86c', // Gold
        'admin' => '#1a5f5a',     // Primary
        'karyawan' => '#6c757d'   // Gray
    ];
    return $colors[$role] ?? '#6c757d';
}
