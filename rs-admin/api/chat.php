<?php
/**
 * Chat API - RS Payangan Hospital
 * 
 * API Endpoint untuk chat agent
 * Connected to OpenHands Agent System
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Start session for user tracking
session_start();

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$action = $_GET['action'] ?? $input['action'] ?? '';

// Response helper
function jsonResponse($success, $data = null, $message = '', $code = 200) {
    http_response_code($code);
    echo json_encode([
        'success' => $success,
        'data' => $data,
        'message' => $message,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    exit;
}

// Knowledge Base untuk RS Payangan
$KNOWLEDGE_BASE = [
    'jam_buka' => [
        'keywords' => ['jam', 'buka', 'waktu', 'operasional', 'layanan'],
        'response' => 'в—Ҹ <strong>Jam Operasional RS Payangan:</strong><br>
в—Ҹ Rawat Jalan: 08:00 - 20:00 WITA<br>
в—Ҹ IGD: 24 jam (Setiap hari)<br>
в—Ҹ Apotek: 07:00 - 21:00 WITA<br>
в—Ҹ Laboratorium: 07:00 - 19:00 WITA<br><br>
Telepon: <strong>0361 98087</strong>'
    ],
    'pendaftaran' => [
        'keywords' => ['daftar', 'pendaftaran', 'registrasi', 'online', 'antrian'],
        'response' => 'в—Ҹ <strong>Cara Pendaftaran Online:</strong><br><br>
1. Kunjungi website kami<br>
2. Pilih menu <strong>Antrean Online</strong><br>
3. Pilih poli dan dokter<br>
4. Isi data pasien<br>
5. Dapatkan nomor antrean<br><br>
WhatsApp: <strong>+62 361 9088087</strong>'
    ],
    'tarif' => [
        'keywords' => ['tarif', 'harga', 'biaya', 'konsultasi', 'bayar'],
        'response' => 'в—Ҹ <strong>Estimasi Tarif:</strong><br><br>
в—Ҹ Konsultasi Dokter Umum: Rp 150.000 - 250.000<br>
в—Ҹ Konsultasi Spesialis: Rp 250.000 - 500.000<br>
в—Ҹ Rawat Inap Kelas 3: Rp 350.000 - 500.000/malam<br>
в—Ҹ Rawat Inap VIP: Rp 1.500.000 - 2.500.000/malam<br><br>
<em>*Tarif dapat berubah. Hubungi kami untuk info terbaru.</em>'
    ],
    'dokter' => [
        'keywords' => ['dokter', 'dokter praktik', 'jadwal dokter', 'spesialis'],
        'response' => 'в—Ҹ RS Payangan memiliki <strong>22 dokter</strong> dan <strong>14 poli</strong>:<br><br>
в—Ҹ Poli Umum<br>
в—Ҹ Poli Anak<br>
в—Ҹ Poli Kandungan<br>
в—Ҹ Poli Bedah<br>
в—Ҹ Poli Penyakit Dalam<br>
в—Ҹ Poli Jantung<br>
в—Ҹ Poli THT<br>
в—Ҹ Poli Saraf<br>
в—Ҹ Poli Gigi<br>
в—Ҹ Poli Ortopedi<br><br>
Lihat jadwal lengkap di halaman <strong>Dokter</strong>'
    ],
    'lokasi' => [
        'keywords' => ['lokasi', 'alamat', 'mana', 'dimana', 'arah', 'peta'],
        'response' => 'в—Ҹ <strong>Lokasi RS Payangan:</strong><br><br>
в—Ҹ <strong>Alamat:</strong> Jl. Raya Payangan, Gianyar, Bali<br>
в—Ҹ <strong>Telepon:</strong> 0361 98087<br>
в—Ҹ <strong>WhatsApp:</strong> +62 361 9088087<br>
в—Ҹ <strong>Email:</strong> info@rsupayangan.co.id<br><br>
RS Payangan terletak di jalur utama Gianyar, mudah diakses dari Denpasar dan Ubud.'
    ],
    'igd' => [
        'keywords' => ['igd', 'darurat', 'emergency', 'ambulans', 'darurat'],
        'response' => 'в—Ҹ <strong>Layanan IGD 24 Jam:</strong><br><br>
в—Ҹ <strong>Telepon IGD:</strong> <strong>0361 98087</strong><br>
в—Ҹ <strong>WhatsApp Darurat:</strong> <strong>+62 361 9088087</strong><br><br>
<strong>Prioritas IGD:</strong><br>
1. Resusitasi (Sangat darurat)<br>
2. Emergensi<br>
3. Urgensi<br>
4. Kurang urgensi<br>
5. Non-urgensi<br><br>
в—Ҹ Untuk kasus darurat, segera hubungi nomor di atas!'
    ],
    'fasilitas' => [
        'keywords' => ['fasilitas', 'pelayanan', 'layanan', 'alat'],
        'response' => 'в—Ҹ <strong>Fasilitas RS Payangan:</strong><br><br>
в—Ҹ IGD 24 jam dengan tim medis standby<br>
в—Ҹ Rawat Inap (VVIP, VIP, Kelas 1, 2, 3)<br>
в—Ҹ Rawat Jalan 14 poli spesialis<br>
в—Ҹ ICU & NICU<br>
в—Ҹ Laboratorium 24 jam<br>
в—Ҹ Rontgen & USG<br>
в—Ҹ Apotek 24 jam<br>
в—Ҹ Ambulans'
    ],
    'salam' => [
        'keywords' => ['halo', 'hallo', 'hi', 'hai', 'pagi', 'siang', 'sore', 'malam'],
        'response' => 'Halo! рҹЁӨвҖҰ<br><br>
' . getGreeting() . ', ada yang bisa saya bantu?'
    ]
];

// Get greeting based on time
function getGreeting() {
    $hour = date('H');
    if ($hour < 12) return 'Selamat Pagi';
    if ($hour < 15) return 'Selamat Siang';
    if ($hour < 18) return 'Selamat Sore';
    return 'Selamat Malam';
}

// Find matching response
function findResponse($question) {
    global $KNOWLEDGE_BASE;
    $lowerQuestion = strtolower($question);
    
    foreach ($KNOWLEDGE_BASE as $key => $data) {
        foreach ($data['keywords'] as $keyword) {
            if (strpos($lowerQuestion, $keyword) !== false) {
                return $data['response'];
            }
        }
    }
    
    // Default response
    return 'Terima kasih atas pertanyaan Anda. рҹЎ"<br><br>
Untuk informasi lebih detail:<br>
в—Ҹ Telepon: <strong>0361 98087</strong><br>
в—Ҹ WhatsApp: <strong>+62 361 9088087</strong><br><br>
Atau klik tombol cepat untuk jawaban instant! рҹЁӨ';
}

// Log chat
function logChat($user_id, $question, $response, $source = 'chat_page') {
    $log_file = __DIR__ . '/../../logs/chat.log';
    if (!is_dir(dirname($log_file))) {
        mkdir(dirname($log_file), 0755, true);
    }
    
    $log = sprintf(
        "[%s] User: %s | Source: %s | Q: %s | A: %s\n",
        date('Y-m-d H:i:s'),
        $user_id ?? 'anonymous',
        $source,
        substr($question, 0, 100),
        substr(strip_tags($response), 0, 100)
    );
    
    file_put_contents($log_file, $log, FILE_APPEND);
}

// Handle actions
switch ($action) {
    case 'chat':
        $question = trim($input['question'] ?? '');
        
        if (empty($question)) {
            jsonResponse(false, null, 'Pertanyaan tidak boleh kosong', 400);
        }
        
        $response = findResponse($question);
        $user_id = $_SESSION['user_id'] ?? 'visitor_' . session_id();
        
        // Log chat
        logChat($user_id, $question, $response);
        
        jsonResponse(true, [
            'answer' => $response,
            'greeting' => getGreeting(),
            'session_id' => session_id()
        ], 'Response generated successfully');
        break;
    
    case 'quick_reply':
        $type = $input['type'] ?? '';
        
        $quick_replies = [
            'jam_buka' => 'Jam berapa RS Payangan buka?',
            'pendaftaran' => 'Bagaimana cara daftar online?',
            'tarif' => 'Berapa tarif konsultasi dokter?',
            'dokter' => 'Dokter apa saja yang praktik?',
            'lokasi' => 'Di mana lokasi RS Payangan?',
            'igd' => 'Nomor telepon IGD?'
        ];
        
        if (isset($quick_replies[$type])) {
            $question = $quick_replies[$type];
            $response = findResponse($question);
            
            $user_id = $_SESSION['user_id'] ?? 'visitor_' . session_id();
            logChat($user_id, $question, $response, 'quick_reply');
            
            jsonResponse(true, [
                'question' => $question,
                'answer' => $response
            ]);
        } else {
            jsonResponse(false, null, 'Quick reply type not found', 404);
        }
        break;
    
    case 'history':
        // Get chat history from session or database
        $history = $_SESSION['chat_history'] ?? [];
        jsonResponse(true, ['history' => $history]);
        break;
    
    case 'clear_history':
        $_SESSION['chat_history'] = [];
        jsonResponse(true, null, 'Chat history cleared');
        break;
    
    case 'stats':
        // Get chat statistics
        $log_file = __DIR__ . '/../../logs/chat.log';
        $stats = [
            'total_chats' => 0,
            'today_chats' => 0,
            'popular_questions' => []
        ];
        
        if (file_exists($log_file)) {
            $lines = file($log_file, FILE_IGNORE_NEW_LINES);
            $stats['total_chats'] = count($lines);
            
            $today = date('Y-m-d');
            foreach ($lines as $line) {
                if (strpos($line, $today) !== false) {
                    $stats['today_chats']++;
                }
            }
        }
        
        jsonResponse(true, $stats);
        break;
    
    case 'agent_connect':
        // Connect to OpenHands Agent for complex queries
        $query = trim($input['query'] ?? '');
        
        if (empty($query)) {
            jsonResponse(false, null, 'Query tidak boleh kosong', 400);
        }
        
        // Here you can integrate with OpenHands Agent API
        // For now, return the knowledge base response
        $response = findResponse($query);
        
        jsonResponse(true, [
            'answer' => $response,
            'agent' => 'RS Payangan Assistant',
            'model' => 'Knowledge Base + OpenHands Agent'
        ]);
        break;
    
    default:
        // Return available actions
        jsonResponse(true, [
            'available_actions' => [
                'chat' => 'Send a chat message',
                'quick_reply' => 'Get quick reply response',
                'history' => 'Get chat history',
                'clear_history' => 'Clear chat history',
                'stats' => 'Get chat statistics',
                'agent_connect' => 'Connect to OpenHands Agent'
            ],
            'version' => '1.0.0',
            'hospital' => 'RS Payangan Hospital',
            'contact' => [
                'phone' => '0361 98087',
                'whatsapp' => '+62 361 9088087',
                'address' => 'Jl. Raya Payangan, Gianyar, Bali'
            ]
        ]);
}
