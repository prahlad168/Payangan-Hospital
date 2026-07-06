<?php
/**
 * DAILY REPORT - Maha Lakshmi
 * Script untuk Generate Laporan Harian & Kirim ke WhatsApp
 * Dijalankan via Cron: 0 12 * * * (Setiap jam 12 siang)
 */

header('Content-Type: application/json');

// ============================================
// KONFIGURASI
// ============================================
$CONFIG = [
    'wa_number' => '6281234567890', // GANTI DENGAN NOMOR WA ANDA (format: 628...)
    'wa_api_url' => 'https://api.fonnte.com/send', // Atau WA Gateway lain
    'wa_token' => 'YOUR_FONNTE_TOKEN', // GANTI dengan token API WA Gateway
    'companies_file' => __DIR__ . '/../data/companies.json',
    'transactions_file' => __DIR__ . '/../data/transactions.json',
    'use_wa' => false, // Set true jika sudah ada WA API
];

// ============================================
// LOAD DATA
// ============================================
function loadJson($file) {
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true) ?? [];
}

// ============================================
// GENERATE REPORT
// ============================================
function generateDailyReport($companies, $transactions, $today) {
    $totalRevenue = 0;
    $activeCompanies = 0;
    $companyDetails = [];
    
    foreach ($companies as $c) {
        $totalRevenue += $c['revenue'];
        if ($c['status'] === 'active') $activeCompanies++;
        
        // Hitung transaksi hari ini untuk perusahaan ini
        $todayTxn = array_filter($transactions, function($t) use ($today, $c) {
            return $t['company_id'] === $c['id'] && $t['date'] === $today;
        });
        $todayRevenue = array_sum(array_column($todayTxn, 'amount'));
        
        $companyDetails[] = [
            'id' => $c['id'],
            'name' => $c['name'],
            'status' => $c['status'],
            'revenue' => $c['revenue'],
            'progress' => $c['progress'],
            'today_revenue' => $todayRevenue,
            'transactions_today' => count($todayTxn)
        ];
    }
    
    // Urutkan: Active dulu, lalu Ready, lalu Pending
    usort($companyDetails, function($a, $b) {
        $order = ['active' => 1, 'ready' => 2, 'pending' => 3];
        return $order[$a['status']] <=> $order[$b['status']];
    });
    
    return [
        'date' => $today,
        'total_revenue' => $totalRevenue,
        'active_companies' => $activeCompanies,
        'total_companies' => count($companies),
        'companies' => $companyDetails,
        'summary' => [
            'target' => count($companies) * 100000000,
            'progress_percent' => $totalRevenue > 0 ? min(100, round($totalRevenue / (count($companies) * 100000000) * 100, 1)) : 0
        ]
    ];
}

// ============================================
// FORMAT WHATSAPP MESSAGE
// ============================================
function formatWhatsAppMessage($report) {
    $date = date('d F Y', strtotime($report['date']));
    $totalRevenue = number_format($report['total_revenue'], 0, ',', '.');
    $target = number_format($report['summary']['target'], 0, ',', '.');
    
    $msg = "📊 *LAPORAN HARIAN*\n";
    $msg .= "Maha Lakshmi - {$date}\n";
    $msg .= "━━━━━━━━━━━━━━━━━━━━\n\n";
    
    $msg .= "💰 *TOTAL PENDAPATAN*\n";
    $msg .= "Hari ini: Rp {$totalRevenue}\n";
    $msg .= "Target: Rp {$target}\n";
    $msg .= "Progress: {$report['summary']['progress_percent']}%\n\n";
    
    $msg .= "🏢 *STATUS PERUSAHAAN*\n";
    $msg .= "Aktif: {$report['active_companies']}\n";
    $msg .= "Total: {$report['total_companies']}\n\n";
    
    $msg .= "📋 *DETAIL PERUSAHAAN*\n";
    foreach ($report['companies'] as $c) {
        $emoji = $c['status'] === 'active' ? '✅' : ($c['status'] === 'ready' ? '⚡' : '⏳');
        $revenue = number_format($c['revenue'], 0, ',', '.');
        $todayRev = number_format($c['today_revenue'], 0, ',', '.');
        $status = strtoupper($c['status']);
        
        $msg .= "{$emoji} *{$c['id']}. {$c['name']}*\n";
        $msg .= "   Status: {$status} | Revenue: Rp {$revenue}\n";
        $msg .= "   Hari ini: +Rp {$todayRev} ({$c['transactions_today']} transaksi)\n\n";
    }
    
    $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
    $msg .= "_Dikirim otomatis oleh GAURANGA AI_";
    
    return $msg;
}

// ============================================
// KIRIM WHATSAPP
// ============================================
function sendWhatsApp($message, $config) {
    if (!$config['use_wa']) {
        // Simpan ke file jika belum ada WA API
        $logFile = __DIR__ . '/../data/daily-reports/' . date('Y-m-d') . '.txt';
        if (!is_dir(dirname($logFile))) mkdir(dirname($logFile), 0755, true);
        file_put_contents($logFile, $message);
        return ['success' => true, 'mode' => 'file_only', 'file' => $logFile];
    }
    
    $ch = curl_init($config['wa_api_url']);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Authorization: ' . $config['wa_token']],
        CURLOPT_POSTFIELDS => [
            'token' => $config['wa_token'],
            'target' => $config['wa_number'],
            'message' => $message
        ]
    ]);
    
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        return ['success' => false, 'error' => $error];
    }
    
    return ['success' => true, 'response' => json_decode($response, true)];
}

// ============================================
// MAIN EXECUTION
// ============================================
function runDailyReport($config) {
    // Load data
    $companies = loadJson($config['companies_file'])['companies'] ?? [];
    $transactions = loadJson($config['transactions_file'])['transactions'] ?? [];
    $today = date('Y-m-d');
    
    // Generate report
    $report = generateDailyReport($companies, $transactions, $today);
    
    // Format message
    $message = formatWhatsAppMessage($report);
    
    // Send WhatsApp (or save to file)
    $result = sendWhatsApp($message, $config);
    
    // Save report
    $reportFile = __DIR__ . '/../data/daily-reports/' . $today . '.json';
    if (!is_dir(dirname($reportFile))) mkdir(dirname($reportFile), 0755, true);
    file_put_contents($reportFile, json_encode($report, JSON_PRETTY_PRINT));
    
    return [
        'success' => true,
        'report' => $report,
        'message' => $message,
        'send_result' => $result,
        'timestamp' => date('c')
    ];
}

// ============================================
// CLI / CRON EXECUTION
// ============================================
if (php_sapi_name() === 'cli' || isset($_GET['run'])) {
    $result = runDailyReport($CONFIG);
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    // Web access - show API info
    echo json_encode([
        'success' => true,
        'message' => 'Daily Report API',
        'usage' => 'Jalankan via cron: 0 12 * * * php ' . __FILE__,
        'or_visit' => '?run=1 untuk test',
        'schedule' => 'Setiap jam 12 siang (Asia/Jakarta)',
        'config_needed' => [
            'wa_number' => 'Nomor WhatsApp Anda (format: 628...)',
            'wa_token' => 'Token WA Gateway (Fonnte/Wablas)',
            'use_wa' => 'Set true jika sudah punya WA API'
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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
