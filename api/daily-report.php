<?php
/**
 * ==========================================
 * DAILY REPORT SYSTEM
 * RS Payangan Hospital
 * ==========================================
 * 
 * Generates daily report at 23:59 server time
 * Reports to: admin email (configured in admin panel)
 * Stores reports in: progress/daily-report-YYYY-MM-DD.md
 */

// Configuration
define('REPORT_DIR', __DIR__ . '/../progress/');
define('LOG_DIR', __DIR__ . '/../logs/');
define('ADMIN_EMAIL', ''); // Configure in admin panel

// Error handling
error_reporting(E_ALL);
ini_set('display_errors', 0);

/**
 * Get website analytics from log files
 */
function getWebsiteStats($date) {
    $stats = [
        'date' => $date,
        'visitors' => 0,
        'page_views' => 0,
        'top_pages' => [],
        'chat_conversations' => 0,
        'appointments' => 0,
        'errors' => 0,
        '404_errors' => 0,
        '500_errors' => 0
    ];
    
    // Read chat logs
    $chatFile = LOG_DIR . 'chat-' . $date . '.json';
    if (file_exists($chatFile)) {
        $chatLogs = json_decode(file_get_contents($chatFile), true) ?? [];
        $sessions = [];
        foreach ($chatLogs as $log) {
            $sessions[$log['session_id'] ?? 'unknown'] = true;
        }
        $stats['chat_conversations'] = count($sessions);
    }
    
    // Read error logs if exists
    $errorFile = LOG_DIR . 'error-' . $date . '.log';
    if (file_exists($errorFile)) {
        $errorContent = file_get_contents($errorFile);
        $stats['errors'] = substr_count($errorContent, "\n");
    }
    
    // Read access logs (if configured)
    // This depends on server configuration
    // $accessFile = '/var/log/apache2/access.log';
    
    return $stats;
}

/**
 * Get chat analytics
 */
function getChatAnalytics($date) {
    $chatFile = LOG_DIR . 'chat-' . $date . '.json';
    
    $analytics = [
        'total_conversations' => 0,
        'total_messages' => 0,
        'common_questions' => [],
        'avg_rating' => 0,
        'avg_duration' => 0,
        'peak_hours' => []
    ];
    
    if (!file_exists($chatFile)) {
        return $analytics;
    }
    
    $logs = json_decode(file_get_contents($chatFile), true) ?? [];
    
    $sessions = [];
    $questions = [];
    $durations = [];
    $ratings = [];
    $hours = array_fill(0, 24, 0);
    
    foreach ($logs as $log) {
        $sessionId = $log['session_id'] ?? 'unknown';
        if (!isset($sessions[$sessionId])) {
            $sessions[$sessionId] = true;
            $analytics['total_conversations']++;
        }
        
        $analytics['total_messages']++;
        
        if (!empty($log['user_message'])) {
            $questions[] = strtolower($log['user_message']);
        }
        
        if (!empty($log['duration'])) {
            $durations[] = (int)$log['duration'];
        }
        
        if (!empty($log['rating'])) {
            $ratings[] = (int)$log['rating'];
        }
        
        if (!empty($log['timestamp'])) {
            $hour = (int)date('H', strtotime($log['timestamp']));
            $hours[$hour]++;
        }
    }
    
    // Top questions
    $questionCounts = array_count_values($questions);
    arsort($questionCounts);
    $analytics['common_questions'] = array_slice($questionCounts, 0, 5, true);
    
    // Average rating
    if (!empty($ratings)) {
        $analytics['avg_rating'] = round(array_sum($ratings) / count($ratings), 1);
    }
    
    // Average duration
    if (!empty($durations)) {
        $analytics['avg_duration'] = round(array_sum($durations) / count($durations));
    }
    
    // Peak hours
    arsort($hours);
    $topHours = array_slice($hours, 0, 3, true);
    $analytics['peak_hours'] = array_map(function($hour, $count) {
        return sprintf('%02d:00 - %02d:59 (%d percakapan)', $hour, $hour, $count);
    }, array_keys($topHours), array_values($topHours));
    
    return $analytics;
}

/**
 * Get appointment requests
 */
function getAppointmentRequests($date) {
    // This would typically come from database
    // For now, return mock data structure
    return [
        'total' => 0,
        'by_poli' => [],
        'status' => [
            'pending' => 0,
            'confirmed' => 0,
            'completed' => 0,
            'cancelled' => 0
        ]
    ];
}

/**
 * Get feedback data
 */
function getFeedbackData($date) {
    return [
        'total' => 0,
        'positive' => 0,
        'negative' => 0,
        'average_rating' => 0,
        'comments' => []
    ];
}

/**
 * Generate recommendations
 */
function generateRecommendations($stats, $chatAnalytics) {
    $recommendations = [];
    
    // Based on common questions
    if (!empty($chatAnalytics['common_questions'])) {
        $topQuestion = array_key_first($chatAnalytics['common_questions']);
        $recommendations[] = "Pertanyaan paling umum: \"$topQuestion\" - pertimbangkan menambahkan FAQ atau informasi yang lebih jelas di halaman tersebut.";
    }
    
    // Based on chat volume
    if ($chatAnalytics['total_conversations'] > 50) {
        $recommendations[] = "Volume chat tinggi - pertimbangkan menambah jam operasional AI chat atau menambah fitur self-service di website.";
    } elseif ($chatAnalytics['total_conversations'] < 10) {
        $recommendations[] = "Volume chat rendah - pertimbangkan mempromosikan fitur chat AI di homepage atau media sosial.";
    }
    
    // Based on errors
    if ($stats['errors'] > 10) {
        $recommendations[] = "Terdapat {$stats['errors']} error - segera perbaiki untuk menjaga pengalaman pengguna.";
    }
    
    // Based on peak hours
    if (!empty($chatAnalytics['peak_hours'])) {
        $recommendations[] = "Jam sibuk chat: " . implode(', ', $chatAnalytics['peak_hours']) . " - pastikan staffing sesuai.";
    }
    
    // Based on rating
    if ($chatAnalytics['avg_rating'] > 0 && $chatAnalytics['avg_rating'] < 3) {
        $recommendations[] = "Rating rata-rata rendah ({$chatAnalytics['avg_rating']}/5) - evaluasi kualitas respons AI dan perluas knowledge base.";
    }
    
    if (empty($recommendations)) {
        $recommendations[] = "Semua sistem berjalan dengan baik. Lanjutkan pemantauan rutin.";
    }
    
    return $recommendations;
}

/**
 * Format duration
 */
function formatDuration($seconds) {
    if ($seconds < 60) {
        return $seconds . ' detik';
    }
    $minutes = floor($seconds / 60);
    return $minutes . ' menit';
}

/**
 * Generate markdown report
 */
function generateReport($date) {
    $stats = getWebsiteStats($date);
    $chatAnalytics = getChatAnalytics($date);
    $appointments = getAppointmentRequests($date);
    $feedback = getFeedbackData($date);
    $recommendations = generateRecommendations($stats, $chatAnalytics);
    
    $report = "# 📊 Laporan Harian RS Payangan Hospital\n\n";
    $report .= "## Tanggal: {$date}\n\n";
    $report .= "---\n\n";
    
    // Summary
    $report .= "## 📈 Ringkasan Umum\n\n";
    $report .= "| Metric | Nilai |\n";
    $report .= "|--------|-------|\n";
    $report .= "| Pengunjung | {$stats['visitors']} |\n";
    $report .= "| Page Views | {$stats['page_views']} |\n";
    $report .= "| Percakapan Chat | {$chatAnalytics['total_conversations']} |\n";
    $report .= "| Total Pesan Chat | {$chatAnalytics['total_messages']} |\n";
    $report .= "| Permintaan Janji | {$appointments['total']} |\n";
    $report .= "| Error Website | {$stats['errors']} |\n";
    $report .= "| 404 Errors | {$stats['404_errors']} |\n\n";
    
    // Chat Analytics
    $report .= "## 💬 Analisis Chat AI (MahaCare)\n\n";
    $report .= "| Metric | Nilai |\n";
    $report .= "|--------|-------|\n";
    $report .= "| Percakapan | {$chatAnalytics['total_conversations']} |\n";
    $report .= "| Rata-rata Rating | {$chatAnalytics['avg_rating']}/5 |\n";
    $report .= "| Rata-rata Durasi | " . formatDuration($chatAnalytics['avg_duration']) . " |\n\n";
    
    // Common Questions
    if (!empty($chatAnalytics['common_questions'])) {
        $report .= "### ❓ Pertanyaan Terbanyak\n\n";
        foreach ($chatAnalytics['common_questions'] as $question => $count) {
            $report .= "- \"$question\" ($count kali)\n";
        }
        $report .= "\n";
    }
    
    // Peak Hours
    if (!empty($chatAnalytics['peak_hours'])) {
        $report .= "### 🕐 Jam Sibuk Chat\n\n";
        foreach ($chatAnalytics['peak_hours'] as $hour) {
            $report .= "- $hour\n";
        }
        $report .= "\n";
    }
    
    // Top Pages
    if (!empty($stats['top_pages'])) {
        $report .= "### 📄 Halaman Paling Dikunjungi\n\n";
        foreach ($stats['top_pages'] as $page => $views) {
            $report .= "- $page ($views views)\n";
        }
        $report .= "\n";
    }
    
    // Appointments
    $report .= "## 📋 Permintaan Janji Temu\n\n";
    $report .= "| Status | Jumlah |\n";
    $report .= "|--------|--------|\n";
    $report .= "| Pending | {$appointments['status']['pending']} |\n";
    $report .= "| Dikonfirmasi | {$appointments['status']['confirmed']} |\n";
    $report .= "| Selesai | {$appointments['status']['completed']} |\n";
    $report .= "| Dibatalkan | {$appointments['status']['cancelled']} |\n\n";
    
    // Feedback
    $report .= "## ⭐ Feedback Pasien\n\n";
    $report .= "| Metric | Nilai |\n";
    $report .= "|--------|-------|\n";
    $report .= "| Total Feedback | {$feedback['total']} |\n";
    $report .= "| Positif | {$feedback['positive']} |\n";
    $report .= "| Negatif | {$feedback['negative']} |\n";
    $report .= "| Rating Rata-rata | {$feedback['average_rating']}/5 |\n\n";
    
    // Errors
    if ($stats['errors'] > 0) {
        $report .= "## ⚠️ Error Website\n\n";
        $report .= "| Tipe | Jumlah |\n";
        $report .= "|------|--------|\n";
        $report .= "| Total Error | {$stats['errors']} |\n";
        $report .= "| 404 Not Found | {$stats['404_errors']} |\n";
        $report .= "| 500 Server Error | {$stats['500_errors']} |\n\n";
    }
    
    // Recommendations
    $report .= "## 💡 Rekomendasi\n\n";
    foreach ($recommendations as $i => $rec) {
        $report .= ($i + 1) . ". $rec\n";
    }
    $report .= "\n---\n\n";
    
    // Footer
    $report .= "**Dibuat:** " . date('Y-m-d H:i:s') . " (Server Time)\n\n";
    $report .= "**RS Payangan Hospital** - Powered by MahaCare AI\n";
    
    return $report;
}

/**
 * Send email report
 */
function sendEmailReport($report, $date) {
    if (empty(ADMIN_EMAIL)) {
        // Store locally if no email configured
        $reportFile = REPORT_DIR . 'daily-report-' . $date . '.md';
        file_put_contents($reportFile, $report);
        return ['success' => true, 'message' => 'Report saved to file', 'file' => $reportFile];
    }
    
    $subject = "📊 Laporan Harian RS Payangan - $date";
    
    $headers = [
        'From: MahaCare AI <noreply@payanganhospital.gianyarkab.go.id>',
        'Content-Type: text/plain; charset=UTF-8',
        'X-Mailer: PHP/' . phpversion()
    ];
    
    $result = mail(ADMIN_EMAIL, $subject, $report, implode("\r\n", $headers));
    
    if ($result) {
        // Also save a copy
        $reportFile = REPORT_DIR . 'daily-report-' . $date . '.md';
        file_put_contents($reportFile, $report);
        
        return ['success' => true, 'message' => 'Report sent to email and saved', 'file' => $reportFile];
    } else {
        // Save locally on failure
        $reportFile = REPORT_DIR . 'daily-report-' . $date . '.md';
        file_put_contents($reportFile, $report);
        
        return ['success' => false, 'message' => 'Email failed, report saved locally', 'file' => $reportFile];
    }
}

// Handle request
if (php_sapi_name() === 'cli' || isset($_GET['run'])) {
    // Create directories if not exist
    if (!file_exists(REPORT_DIR)) {
        mkdir(REPORT_DIR, 0755, true);
    }
    
    $date = $_GET['date'] ?? date('Y-m-d', strtotime('-1 day'));
    
    echo "Generating daily report for $date...\n";
    
    $report = generateReport($date);
    $result = sendEmailReport($report, $date);
    
    echo "Status: " . ($result['success'] ? 'SUCCESS' : 'FAILED') . "\n";
    echo "Message: {$result['message']}\n";
    echo "File: {$result['file']}\n";
    
    // Return JSON for API calls
    header('Content-Type: application/json');
    echo json_encode($result);
}

// CRON JOB INSTALLATION
/**
 * To set up daily report cron job:
 * 
 * 1. Via SSH, edit crontab:
 *    crontab -e
 * 
 * 2. Add this line:
 *    59 23 * * * /usr/bin/php /path/to/api/daily-report.php >> /path/to/logs/cron-report.log 2>&1
 * 
 * 3. Save and exit
 * 
 * This will run the report at 23:59 every day
 */
