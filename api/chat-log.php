<?php
/**
 * ==========================================
 * MAHACARE AI - CHAT LOGGING API
 * RS Payangan Hospital
 * ==========================================
 * 
 * Logs all chat conversations to JSON file
 * For database integration, modify the saveChatLog function
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Security: Rate limiting
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$now = time();

// Simple rate limiting (10 requests per minute)
if (!isset($_SESSION['rate_limit'])) {
    $_SESSION['rate_limit'] = [];
}

// Clean old entries
$_SESSION['rate_limit'] = array_filter($_SESSION['rate_limit'], function($t) use ($now) {
    return $now - $t < 60;
});

if (count($_SESSION['rate_limit']) >= 10) {
    http_response_code(429);
    echo json_encode(['error' => 'Terlalu banyak request. Silakan coba beberapa saat lagi.']);
    exit;
}

$_SESSION['rate_limit'][] = $now;

// Input sanitization
function sanitize($input) {
    if (is_array($input)) {
        return array_map('sanitize', $input);
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Log directory
$logDir = __DIR__ . '/../logs/';
if (!file_exists($logDir)) {
    mkdir($logDir, 0755, true);
}

$logFile = $logDir . 'chat-' . date('Y-m-d') . '.json';

/**
 * Save chat log to file
 * For production, replace with database insertion
 */
function saveChatLog($data) {
    global $logFile;
    
    $log = [];
    if (file_exists($logFile)) {
        $log = json_decode(file_get_contents($logFile), true) ?? [];
    }
    
    $log[] = $data;
    
    file_put_contents($logFile, json_encode($log, JSON_PRETTY_PRINT));
}

/**
 * Get chat logs for admin
 */
function getChatLogs($date = null) {
    global $logDir;
    
    $targetDate = $date ?? date('Y-m-d');
    $file = $logDir . 'chat-' . $targetDate . '.json';
    
    if (!file_exists($file)) {
        return [];
    }
    
    return json_decode(file_get_contents($file), true) ?? [];
}

/**
 * Get chat statistics
 */
function getChatStats($date = null) {
    global $logDir;
    
    $targetDate = $date ?? date('Y-m-d');
    $file = $logDir . 'chat-' . $targetDate . '.json';
    
    $stats = [
        'date' => $targetDate,
        'total_conversations' => 0,
        'total_messages' => 0,
        'common_questions' => [],
        'satisfaction_scores' => [],
        'avg_duration' => 0,
        'peak_hours' => []
    ];
    
    if (!file_exists($file)) {
        return $stats;
    }
    
    $logs = json_decode(file_get_contents($file), true) ?? [];
    
    $sessions = [];
    $questions = [];
    $durations = [];
    $ratings = [];
    $hours = array_fill(0, 24, 0);
    
    foreach ($logs as $log) {
        // Count unique sessions
        $sessionId = $log['session_id'] ?? 'unknown';
        if (!isset($sessions[$sessionId])) {
            $sessions[$sessionId] = true;
            $stats['total_conversations']++;
        }
        
        $stats['total_messages']++;
        
        // Collect questions
        if (!empty($log['user_message'])) {
            $q = strtolower($log['user_message']);
            $questions[] = $q;
        }
        
        // Duration
        if (!empty($log['duration'])) {
            $durations[] = (int)$log['duration'];
        }
        
        // Ratings
        if (!empty($log['rating'])) {
            $ratings[] = (int)$log['rating'];
        }
        
        // Peak hours
        if (!empty($log['timestamp'])) {
            $hour = (int)date('H', strtotime($log['timestamp']));
            $hours[$hour]++;
        }
    }
    
    // Most common questions
    $questionCounts = array_count_values($questions);
    arsort($questionCounts);
    $stats['common_questions'] = array_slice($questionCounts, 0, 10, true);
    
    // Average rating
    if (!empty($ratings)) {
        $stats['avg_rating'] = round(array_sum($ratings) / count($ratings), 1);
    }
    
    // Average duration
    if (!empty($durations)) {
        $stats['avg_duration'] = round(array_sum($durations) / count($durations));
    }
    
    // Peak hours
    arsort($hours);
    $stats['peak_hours'] = array_slice($hours, 0, 3, true);
    
    return $stats;
}

// Handle requests
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON input']);
        exit;
    }
    
    // Validate required fields
    $required = ['action'];
    foreach ($required as $field) {
        if (empty($input[$field])) {
            http_response_code(400);
            echo json_encode(['error' => "Missing required field: $field"]);
            exit;
        }
    }
    
    $action = sanitize($input['action']);
    
    switch ($action) {
        case 'log':
            // Log a chat message
            $logData = [
                'timestamp' => date('Y-m-d H:i:s'),
                'session_id' => sanitize($input['session_id'] ?? session_id()),
                'user_name' => sanitize($input['user_name'] ?? 'Anonymous'),
                'user_contact' => sanitize($input['user_contact'] ?? ''),
                'user_message' => sanitize($input['user_message'] ?? ''),
                'bot_response' => sanitize($input['bot_response'] ?? ''),
                'page_url' => sanitize($input['page_url'] ?? ''),
                'duration' => (int)($input['duration'] ?? 0),
                'rating' => isset($input['rating']) ? (int)$input['rating'] : null,
                'ip_address' => substr($ip, 0, 50),
                'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 200)
            ];
            
            saveChatLog($logData);
            
            echo json_encode([
                'success' => true,
                'message' => 'Chat logged successfully',
                'log_id' => uniqid()
            ]);
            break;
            
        case 'get_stats':
            $date = sanitize($input['date'] ?? null);
            $stats = getChatStats($date);
            echo json_encode([
                'success' => true,
                'data' => $stats
            ]);
            break;
            
        case 'get_logs':
            $date = sanitize($input['date'] ?? null);
            $logs = getChatLogs($date);
            echo json_encode([
                'success' => true,
                'data' => $logs,
                'count' => count($logs)
            ]);
            break;
            
        default:
            http_response_code(400);
            echo json_encode(['error' => 'Unknown action: ' . $action]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
