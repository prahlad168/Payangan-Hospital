<?php
/**
 * Konfigurasi Database RS Payangan Hospital
 * 
 * Backend Configuration
 */

// Konfigurasi Database (MySQL)
define('DB_HOST', 'localhost');
define('DB_USER', 'payangan_rs');        // Ganti dengan username MySQL Anda
define('DB_PASS', 'your_password_here');  // Ganti dengan password MySQL Anda
define('DB_NAME', 'payangan_hospital');

// Konfigurasi Aplikasi
define('APP_NAME', 'RS Payangan Hospital');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'https://payanganhospital.gianyarkab.go.id/rs-admin');

// Konfigurasi Session
define('SESSION_TIMEOUT', 3600); // 1 jam
define('SESSION_NAME', 'RS_SESSION');

// Konfigurasi Role
define('ROLE_DIREKTUR', 'direktur');
define('ROLE_ADMIN', 'admin');
define('ROLE_KARYAWAN', 'karyawan');

// Timezone
date_default_timezone_set('Asia/Makassar'); // WITA (UTC+8)

// Koneksi Database
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($this->connection->connect_error) {
            die("Koneksi gagal: " . $this->connection->connect_error);
        }
        
        $this->connection->set_charset("utf8mb4");
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}

// Helper function untuk query
function db_query($sql) {
    $db = Database::getInstance();
    return $db->getConnection()->query($sql);
}

// Helper function untuk escape string
function db_escape($string) {
    $db = Database::getInstance();
    return $db->getConnection()->real_escape_string($string);
}

// Helper function untuk get single row
function db_fetch_one($sql) {
    $result = db_query($sql);
    return $result->fetch_assoc();
}

// Helper function untuk get all rows
function db_fetch_all($sql) {
    $result = db_query($sql);
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

// JSON Response Helper
function json_response($success, $data = null, $message = '') {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'data' => $data,
        'message' => $message,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    exit;
}

// Auth Check Helper
function require_auth() {
    session_start();
    
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            json_response(false, null, 'Unauthorized. Silakan login.');
        }
        header('Location: login.php');
        exit;
    }
    
    // Check session timeout
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
        session_destroy();
        header('Location: login.php?timeout=1');
        exit;
    }
    
    $_SESSION['last_activity'] = time();
}

// Role Check Helper
function require_role($roles) {
    require_auth();
    
    if (!in_array($_SESSION['role'], (array)$roles)) {
        http_response_code(403);
        die('Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}


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
