<?php
/**
 * KASIR API - Maha Lakshmi
 * Endpoint untuk mencatat transaksi dan auto-update status perusahaan
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');

// Load data
$companiesFile = __DIR__ . '/../data/companies.json';
$transactionsFile = __DIR__ . '/../data/transactions.json';

function loadJson($file) {
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true) ?? [];
}

function saveJson($file, $data) {
    return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Get request method and action
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'list';

switch ($action) {
    // ============================================
    // GET: List companies or single company
    // ============================================
    case 'list':
    case 'companies':
        $companies = loadJson($companiesFile);
        echo json_encode([
            'success' => true,
            'data' => $companies['companies'] ?? [],
            'summary' => [
                'total' => count($companies['companies'] ?? []),
                'active' => count(array_filter($companies['companies'] ?? [], fn($c) => $c['status'] === 'active')),
                'ready' => count(array_filter($companies['companies'] ?? [], fn($c) => $c['status'] === 'ready')),
                'pending' => count(array_filter($companies['companies'] ?? [], fn($c) => $c['status'] === 'pending')),
                'totalRevenue' => array_sum(array_column($companies['companies'] ?? [], 'revenue'))
            ]
        ]);
        break;

    case 'company':
        $id = $_GET['id'] ?? null;
        $companies = loadJson($companiesFile);
        $company = array_filter($companies['companies'] ?? [], fn($c) => $c['id'] === $id);
        if (empty($company)) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Company not found']);
        } else {
            echo json_encode(['success' => true, 'data' => array_values($company)[0]]);
        }
        break;

    case 'transactions':
        $transactions = loadJson($transactionsFile);
        echo json_encode([
            'success' => true,
            'data' => $transactions['transactions'] ?? [],
            'dailyTotals' => $transactions['dailyTotals'] ?? [],
            'monthlyTotals' => $transactions['monthlyTotals'] ?? []
        ]);
        break;

    case 'daily-report':
        $companies = loadJson($companiesFile)['companies'] ?? [];
        $transactions = loadJson($transactionsFile);
        $today = date('Y-m-d');
        
        $todayTransactions = array_filter(
            $transactions['transactions'] ?? [],
            fn($t) => date('Y-m-d', strtotime($t['timestamp'])) === $today
        );
        
        $todayTotal = array_sum(array_column($todayTransactions, 'amount'));
        
        echo json_encode([
            'success' => true,
            'date' => $today,
            'totalToday' => $todayTotal,
            'transactionCount' => count($todayTransactions),
            'companies' => array_map(fn($c) => [
                'id' => $c['id'],
                'name' => $c['name'],
                'status' => $c['status'],
                'revenue' => $c['revenue'],
                'target' => $c['target'],
                'progress' => $c['progress']
            ], $companies)
        ]);
        break;

    // ============================================
    // POST: Add transaction
    // ============================================
    case 'add':
    case 'transaction':
        if ($method !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }
        
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        
        $companyId = $input['company_id'] ?? $input['company'] ?? null;
        $amount = floatval($input['amount'] ?? 0);
        $description = $input['description'] ?? 'Transaksi kasir';
        $category = $input['category'] ?? 'sale';
        $source = $input['source'] ?? 'manual';
        
        if (!$companyId || $amount <= 0) {
            http_response_code(400);
            echo json_encode([
                'success' => false, 
                'error' => 'company_id dan amount wajib diisi'
            ]);
            break;
        }
        
        $companies = loadJson($companiesFile);
        $transactions = loadJson($transactionsFile);
        
        $companyIndex = null;
        foreach ($companies['companies'] as $i => $c) {
            if ($c['id'] === $companyId) {
                $companyIndex = $i;
                break;
            }
        }
        
        if ($companyIndex === null) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Company not found']);
            break;
        }
        
        $timestamp = date('c');
        $today = date('Y-m-d');
        $monthKey = date('Y-m');
        
        $transaction = [
            'id' => uniqid('txn_'),
            'company_id' => $companyId,
            'company_name' => $companies['companies'][$companyIndex]['name'],
            'amount' => $amount,
            'description' => $description,
            'category' => $category,
            'source' => $source,
            'timestamp' => $timestamp,
            'date' => $today
        ];
        
        $transactions['transactions'][] = $transaction;
        
        if (!isset($transactions['dailyTotals'][$today])) {
            $transactions['dailyTotals'][$today] = 0;
        }
        $transactions['dailyTotals'][$today] += $amount;
        
        if (!isset($transactions['monthlyTotals'][$monthKey])) {
            $transactions['monthlyTotals'][$monthKey] = 0;
        }
        $transactions['monthlyTotals'][$monthKey] += $amount;
        
        $oldStatus = $companies['companies'][$companyIndex]['status'];
        $companies['companies'][$companyIndex]['revenue'] += $amount;
        $companies['companies'][$companyIndex]['target'] = $companies['companies'][$companyIndex]['target'] ?: 100000000;
        $companies['companies'][$companyIndex]['progress'] = min(100, 
            round(($companies['companies'][$companyIndex]['revenue'] / $companies['companies'][$companyIndex]['target']) * 100, 2)
        );
        $companies['companies'][$companyIndex]['lastUpdated'] = $timestamp;
        
        // AUTO STATUS: Change to active if first revenue
        if ($oldStatus === 'ready' && $amount > 0) {
            $companies['companies'][$companyIndex]['status'] = 'active';
            $companies['companies'][$companyIndex]['activeSince'] = date('Y-m-d');
        }
        
        saveJson($transactionsFile, $transactions);
        saveJson($companiesFile, $companies);
        
        echo json_encode([
            'success' => true,
            'message' => 'Transaksi berhasil dicatat',
            'transaction' => $transaction,
            'company' => [
                'id' => $companyId,
                'name' => $companies['companies'][$companyIndex]['name'],
                'status' => $companies['companies'][$companyIndex]['status'],
                'revenue' => $companies['companies'][$companyIndex]['revenue'],
                'progress' => $companies['companies'][$companyIndex]['progress']
            ],
            'statusChanged' => $oldStatus !== $companies['companies'][$companyIndex]['status']
        ]);
        break;

    case 'update-status':
        if ($method !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
        }
        
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $companyId = $input['company_id'] ?? null;
        $newStatus = $input['status'] ?? null;
        
        if (!$companyId || !$newStatus) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'company_id dan status wajib diisi']);
            break;
        }
        
        $validStatuses = ['active', 'ready', 'pending'];
        if (!in_array($newStatus, $validStatuses)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Status tidak valid']);
            break;
        }
        
        $companies = loadJson($companiesFile);
        
        $companyIndex = null;
        foreach ($companies['companies'] as $i => $c) {
            if ($c['id'] === $companyId) {
                $companyIndex = $i;
                break;
            }
        }
        
        if ($companyIndex === null) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Company not found']);
            break;
        }
        
        $oldStatus = $companies['companies'][$companyIndex]['status'];
        $companies['companies'][$companyIndex]['status'] = $newStatus;
        $companies['companies'][$companyIndex]['lastUpdated'] = date('c');
        
        if ($newStatus === 'active' && !$companies['companies'][$companyIndex]['activeSince']) {
            $companies['companies'][$companyIndex]['activeSince'] = date('Y-m-d');
        }
        
        saveJson($companiesFile, $companies);
        
        echo json_encode([
            'success' => true,
            'message' => 'Status berhasil diupdate',
            'company' => $companies['companies'][$companyIndex],
            'previousStatus' => $oldStatus
        ]);
        break;

    default:
        echo json_encode([
            'success' => true,
            'message' => 'Maha Lakshmi Kasir API v1.0',
            'endpoints' => [
                'GET ?action=companies - List perusahaan',
                'GET ?action=company&id=01 - Detail perusahaan',
                'GET ?action=transactions - Semua transaksi',
                'GET ?action=daily-report - Laporan harian',
                'POST ?action=add - Tambah transaksi',
                'POST ?action=update-status - Update status'
            ]
        ]);
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
