<?php
/**
 * Authentication Helper - RS Payangan Hospital
 * 
 * Include this file in all protected pages
 */

// Start session with browser-only, HTTPS-only cookies.
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
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
function rs_get_current_user() {
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
        require_once __DIR__ . '/access-denied.html';
        exit;
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
