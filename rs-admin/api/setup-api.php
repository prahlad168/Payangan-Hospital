<?php
/**
 * RS Payangan Hospital - Setup API
 * =================================
 * 
 * API untuk cek status instalasi dan validasi konfigurasi
 * 
 * Endpoints:
 * GET  /api/setup-api.php?action=status    - Check installation status
 * GET  /api/setup-api.php?action=config   - Get current config
 * POST /api/setup-api.php?action=test-db   - Test database connection
 * 
 * Created by: OpenHands AI Agent
 * Date: 2026-07-21
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include database config
$db_config_path = __DIR__ . '/../config/database.php';
if (file_exists($db_config_path)) {
    require_once $db_config_path;
} else {
    $db_config = null;
}

$response = ['success' => false, 'data' => null, 'message' => ''];

$action = $_GET['action'] ?? 'status';

switch ($action) {
    case 'status':
        // Check installation status
        $status = [
            'database_configured' => isset($db_config) && defined('DB_HOST'),
            'database_file_exists' => file_exists($db_config_path),
            'tables_exist' => false,
            'users_exist' => false,
            'can_connect' => false
        ];
        
        if ($status['database_configured']) {
            try {
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $status['can_connect'] = !$conn->connect_error;
                
                // Check tables
                $result = $conn->query("SHOW TABLES");
                $tables = $result->fetch_all(MYSQLI_ASSOC);
                $status['tables_count'] = count($tables);
                $status['tables_exist'] = count($tables) > 0;
                
                // Check users
                $result = $conn->query("SELECT COUNT(*) as count FROM users");
                $user_count = $result->fetch_assoc();
                $status['users_count'] = $user_count['count'];
                $status['users_exist'] = $user_count['count'] > 0;
                
                // Check if passwords are set
                $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE LENGTH(password) > 50");
                $hash_count = $result->fetch_assoc();
                $status['passwords_set'] = $hash_count['count'] > 0;
                
                $conn->close();
            } catch (Exception $e) {
                $status['error'] = $e->getMessage();
            }
        }
        
        $response['success'] = true;
        $response['data'] = $status;
        $response['message'] = $status['tables_exist'] && $status['users_exist'] 
            ? '✅ RS Admin sudah terinstalasi!' 
            : '⚠️ RS Admin belum sepenuhnya terinstalasi';
        break;
        
    case 'config':
        // Get current configuration (without password)
        $response['success'] = true;
        $response['data'] = [
            'db_host' => defined('DB_HOST') ? DB_HOST : null,
            'db_user' => defined('DB_USER') ? DB_USER : null,
            'db_name' => defined('DB_NAME') ? DB_NAME : null,
            'db_configured' => defined('DB_HOST')
        ];
        $response['message'] = 'Konfigurasi database';
        break;
        
    case 'test-db':
        // Test database connection
        $host = $_POST['host'] ?? (defined('DB_HOST') ? DB_HOST : 'localhost');
        $user = $_POST['user'] ?? (defined('DB_USER') ? DB_USER : '');
        $pass = $_POST['pass'] ?? (defined('DB_PASS') ? DB_PASS : '');
        $name = $_POST['name'] ?? (defined('DB_NAME') ? DB_NAME : '');
        
        try {
            $conn = new mysqli($host, $user, $pass, $name);
            if ($conn->connect_error) {
                throw new Exception($conn->connect_error);
            }
            
            // Test query
            $conn->query("SELECT 1");
            
            $response['success'] = true;
            $response['message'] = '✅ Koneksi database berhasil!';
            $conn->close();
        } catch (Exception $e) {
            $response['success'] = false;
            $response['message'] = '❌ Koneksi gagal: ' . $e->getMessage();
        }
        break;
        
    case 'info':
        // Get system info
        $response['success'] = true;
        $response['data'] = [
            'php_version' => PHP_VERSION,
            'mysql_version' => extension_loaded('mysqli') ? 'Available' : 'Not available',
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown',
            'rs_admin_path' => __DIR__ . '/..',
            'install_file_exists' => file_exists(__DIR__ . '/../install.php'),
            'setup_password_exists' => file_exists(__DIR__ . '/../setup-password.php')
        ];
        $response['message'] = 'System Information';
        break;
        
    default:
        $response['message'] = 'Unknown action. Available: status, config, test-db, info';
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
