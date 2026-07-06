<?php
session_start();
if (!isset($_SESSION['maha_lakshmi_auth']) || $_SESSION['maha_lakshmi_auth'] !== true) {
    header('Location: login.php');
    exit;
}
$_SESSION['login_time'] = time();

// Load companies from JSON
$companiesFile = __DIR__ . '/data/companies.json';
$companies = [];
if (file_exists($companiesFile)) {
    $data = json_decode(file_get_contents($companiesFile), true);
    $companies = $data['companies'] ?? [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maha Lakshmi - Revenue Dashboard</title>
    <style>
        :root {
            --gold: #FFD700;
            --gold-dark: #B8860B;
            --purple: #6B21A8;
            --purple-light: #A855F7;
            --bg-dark: #0F0F23;
            --bg-card: #1A1A2E;
            --text: #E5E5E5;
            --success: #10B981;
            --warning: #F59E0B;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            min-height: 100vh;
        }
        .header {
            background: linear-gradient(135deg, var(--purple) 0%, #1A1A2E 100%);
            padding: 30px 40px;
            border-bottom: 3px solid var(--gold);
        }
        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .logo { display: flex; align-items: center; gap: 15px; }
        .logo-icon { font-size: 48px; }
        .logo-text h1 {
            font-size: 32px;
            background: linear-gradient(135deg, var(--gold) 0%, #FFF8DC 50%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .logo-text p {
            color: var(--gold-dark);
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .header-stats { display: flex; gap: 40px; }
        .header-stat { text-align: right; }
        .header-stat-label { font-size: 12px; color: #888; text-transform: uppercase; }
        .header-stat-value { font-size: 28px; font-weight: 700; color: var(--gold); }
        .main { max-width: 1400px; margin: 0 auto; padding: 30px 40px; }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .summary-card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 25px;
            border: 1px solid rgba(255, 215, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(255, 215, 0, 0.1);
        }
        .summary-card.gold {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, var(--bg-card) 100%);
            border-color: var(--gold);
        }
        .summary-card-icon { font-size: 36px; margin-bottom: 15px; }
        .summary-card-label { font-size: 13px; color: #888; text-transform: uppercase; margin-bottom: 8px; }
        .summary-card-value { font-size: 32px; font-weight: 700; color: var(--gold); }
        .summary-card-change { font-size: 14px; margin-top: 10px; }
        .section-title {
            font-size: 24px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .section-title::before {
            content: '';
            width: 5px;
            height: 30px;
            background: var(--gold);
            border-radius: 3px;
        }
        .companies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
        }
        .company-card {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s;
        }
        .company-card:hover {
            border-color: var(--gold);
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.1);
        }
        .company-header {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .company-info { display: flex; align-items: center; gap: 15px; }
        .company-number {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            color: var(--bg-dark);
        }
        .company-name { font-size: 18px; font-weight: 600; }
        .company-type { font-size: 13px; color: #888; }
        .company-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-active { background: rgba(16, 185, 129, 0.2); color: var(--success); }
        .status-ready { background: rgba(245, 158, 11, 0.2); color: var(--warning); }
        .status-pending { background: rgba(107, 33, 168, 0.3); color: var(--purple-light); }
        .company-body { padding: 25px; }
        .revenue-bar { margin-bottom: 20px; }
        .revenue-bar-header { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .revenue-label { font-size: 13px; color: #888; }
        .revenue-amount { font-size: 13px; font-weight: 600; color: var(--gold); }
        .revenue-target { font-size: 13px; color: #666; margin-top: 4px; }
        .progress-bar { height: 8px; background: rgba(255, 255, 255, 0.1); border-radius: 4px; overflow: hidden; }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--gold-dark) 0%, var(--gold) 100%);
            border-radius: 4px;
            transition: width 1s ease;
        }
        .company-metrics { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-top: 20px; }
        .metric { text-align: center; padding: 15px; background: rgba(255, 255, 255, 0.02); border-radius: 10px; }
        .metric-value { font-size: 20px; font-weight: 700; color: var(--gold); }
        .metric-label { font-size: 11px; color: #666; text-transform: uppercase; margin-top: 5px; }
        .streams-section { margin-top: 40px; }
        .streams-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
        }
        .stream-card {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .stream-icon { font-size: 32px; margin-bottom: 10px; }
        .stream-name { font-size: 13px; color: #888; margin-bottom: 8px; }
        .stream-value { font-size: 22px; font-weight: 700; color: var(--gold); }
        .footer { text-align: center; padding: 40px; color: #666; font-size: 13px; }
        .footer span { color: var(--gold); }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .live-indicator { display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--success); }
        .live-dot { width: 8px; height: 8px; background: var(--success); border-radius: 50%; animation: pulse 2s infinite; }
        .btn-refresh {
            background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 100%);
            color: var(--bg-dark);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-refresh:hover { transform: translateY(-2px); box-shadow: 0 5px 20px rgba(255, 215, 0, 0.3); }
        .refresh-info { font-size: 12px; color: #666; margin-top: 5px; }
        
        /* Kasir Modal */
        .kasir-btn {
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-light) 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }
        .kasir-btn:hover { transform: translateY(-2px); box-shadow: 0 5px 20px rgba(107, 33, 168, 0.4); }
        
        .ceo-btn {
            background: linear-gradient(135deg, #059669 0%, #10B981 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            margin-left: 10px;
        }
        .ceo-btn:hover { transform: translateY(-2px); box-shadow: 0 5px 20px rgba(5, 150, 105, 0.4); }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal.active { display: flex; }
        .modal-content {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            border: 2px solid var(--gold);
        }
        .modal h2 { color: var(--gold); margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #888; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; }
        .form-group select, .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 16px;
        }
        .form-group select:focus, .form-group input:focus {
            outline: none;
            border-color: var(--gold);
        }
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 100%);
            color: var(--bg-dark);
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4); }
        .btn-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: #888;
            font-size: 24px;
            cursor: pointer;
        }
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 10px;
            font-weight: 600;
            z-index: 2000;
            transform: translateX(400px);
            transition: transform 0.3s;
        }
        .notification.show { transform: translateX(0); }
        .notification.success { background: rgba(16, 185, 129, 0.2); color: var(--success); border: 1px solid var(--success); }
        .notification.error { background: rgba(239, 68, 68, 0.2); color: #EF4444; border: 1px solid #EF4444; }
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
    <!-- Notification -->
    <div id="notification" class="notification"></div>
    
    <!-- Kasir Modal -->
    <div id="kasirModal" class="modal">
        <div class="modal-content">
            <button class="btn-close" onclick="closeKasirModal()">&times;</button>
            <h2>💰 Input Transaksi Kasir</h2>
            <form id="kasirForm">
                <div class="form-group">
                    <label>Pilih Perusahaan</label>
                    <select name="company_id" id="companySelect" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        <?php foreach($companies as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['id'] ?> - <?= htmlspecialchars($c['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah (Rp)</label>
                    <input type="number" name="amount" id="amountInput" placeholder="100000" min="1000" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" name="description" id="descInput" placeholder="Pembayaran layanan...">
                </div>
                <button type="submit" class="btn-submit">💵 Catat Transaksi</button>
            </form>
        </div>
    </div>
    
    <!-- CEO Report Modal -->
    <div id="ceoModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <button class="btn-close" onclick="closeCeoReport()">&times;</button>
            <h2>👑 CEO Report - Laporan Executive</h2>
            <div id="ceoReportContent" style="color: #E5E5E5;">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin: 20px 0;">
                    <div style="background: rgba(255,215,0,0.1); padding: 20px; border-radius: 12px; text-align: center;">
                        <div style="font-size: 32px; color: #FFD700;">💰</div>
                        <div style="font-size: 24px; font-weight: bold; color: #FFD700;" id="ceoRevenue">Rp 0</div>
                        <div style="font-size: 12px; color: #888;">Total Revenue</div>
                    </div>
                    <div style="background: rgba(16,185,129,0.1); padding: 20px; border-radius: 12px; text-align: center;">
                        <div style="font-size: 32px;">✅</div>
                        <div style="font-size: 24px; font-weight: bold; color: #10B981;" id="ceoActive">3</div>
                        <div style="font-size: 12px; color: #888;">Perusahaan Aktif</div>
                    </div>
                    <div style="background: rgba(245,158,11,0.1); padding: 20px; border-radius: 12px; text-align: center;">
                        <div style="font-size: 32px;">⚡</div>
                        <div style="font-size: 24px; font-weight: bold; color: #F59E0B;" id="ceoReady">3</div>
                        <div style="font-size: 12px; color: #888;">Ready</div>
                    </div>
                    <div style="background: rgba(107,33,168,0.2); padding: 20px; border-radius: 12px; text-align: center;">
                        <div style="font-size: 32px;">⏳</div>
                        <div style="font-size: 24px; font-weight: bold; color: #A855F7;" id="ceoPending">4</div>
                        <div style="font-size: 12px; color: #888;">Pending</div>
                    </div>
                </div>
                
                <h3 style="color: #FFD700; margin: 20px 0 10px;">📋 Detail Per Perusahaan</h3>
                <div id="ceoCompanyList" style="max-height: 300px; overflow-y: auto;">
                    <!-- Filled by JavaScript -->
                </div>
                
                <div style="margin-top: 20px; padding: 15px; background: rgba(255,255,255,0.05); border-radius: 10px;">
                    <h4 style="color: #FFD700; margin-bottom: 10px;">📊 Progress Keseluruhan</h4>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="flex: 1; height: 12px; background: rgba(255,255,255,0.1); border-radius: 6px; overflow: hidden;">
                            <div id="ceoProgressBar" style="height: 100%; background: linear-gradient(90deg, #B8860B, #FFD700); width: 0%; transition: width 1s;"></div>
                        </div>
                        <span id="ceoProgressText" style="color: #FFD700; font-weight: bold;">0%</span>
                    </div>
                    <div style="margin-top: 10px; font-size: 12px; color: #888;">
                        Target: Rp 1.000.000.000/bulan dari 10 Perusahaan
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <div class="logo-icon">💰</div>
                <div class="logo-text">
                    <h1>Maha Lakshmi</h1>
                    <p>Revenue Intelligence</p>
                </div>
            </div>
            <div class="header-stats">
                <div class="header-stat">
                    <div class="header-stat-label">Total Revenue</div>
                    <div class="header-stat-value" id="totalRevenue">Rp 0</div>
                </div>
                <div class="header-stat">
                    <div class="header-stat-label">Perusahaan Aktif</div>
                    <div class="header-stat-value" id="activeCount">0</div>
                </div>
            </div>
        </div>
    </header>
    
    <main class="main">
        <div class="summary-grid">
            <div class="summary-card gold">
                <div class="summary-card-icon">🏢</div>
                <div class="summary-card-label">Total Perusahaan</div>
                <div class="summary-card-value" id="totalCompanies"><?= count($companies) ?></div>
            </div>
            <div class="summary-card">
                <div class="summary-card-icon">✅</div>
                <div class="summary-card-label">Aktif</div>
                <div class="summary-card-value" id="activeCompanies"><?= count(array_filter($companies, fn($c) => $c['status'] === 'active')) ?></div>
            </div>
            <div class="summary-card">
                <div class="summary-card-icon">⚡</div>
                <div class="summary-card-label">Ready</div>
                <div class="summary-card-value" id="readyCompanies"><?= count(array_filter($companies, fn($c) => $c['status'] === 'ready')) ?></div>
            </div>
            <div class="summary-card">
                <div class="summary-card-icon">⏳</div>
                <div class="summary-card-label">Pending</div>
                <div class="summary-card-value" id="pendingCompanies"><?= count(array_filter($companies, fn($c) => $c['status'] === 'pending')) ?></div>
            </div>
        </div>
        
        <section>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h2 class="section-title">Daftar Perusahaan</h2>
                <div>
                    <button class="kasir-btn" onclick="openKasirModal()">💰 Kasir</button>
                    <button class="ceo-btn" onclick="openCeoReport()">👑 CEO Report</button>
                    <button class="btn-refresh" onclick="refreshData()" style="margin-left: 10px;">🔄 Refresh</button>
                    <div class="refresh-info">Auto-update setiap transaksi</div>
                </div>
            </div>
            
            <div class="companies-grid" id="companiesGrid">
                <?php foreach($companies as $c): 
                    $progress = $c['progress'] ?? 0;
                    $statusClass = 'status-' . $c['status'];
                    $statusLabel = ucfirst($c['status']);
                ?>
                <div class="company-card" data-company-id="<?= $c['id'] ?>">
                    <div class="company-header">
                        <div class="company-info">
                            <div class="company-number"><?= $c['id'] ?></div>
                            <div>
                                <div class="company-name"><?= htmlspecialchars($c['name']) ?></div>
                                <div class="company-type"><?= htmlspecialchars($c['type']) ?></div>
                            </div>
                        </div>
                        <span class="company-status <?= $statusClass ?>"><?= $statusLabel ?></span>
                    </div>
                    <div class="company-body">
                        <div class="revenue-bar">
                            <div class="revenue-bar-header">
                                <span class="revenue-label">Monthly Progress</span>
                                <span class="revenue-amount">Rp <?= number_format($c['revenue'], 0, ',', '.') ?></span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?= $progress ?>%;"></div>
                            </div>
                            <div class="revenue-target">Target: Rp <?= number_format($c['target'], 0, ',', '.') ?></div>
                        </div>
                        <div class="company-metrics">
                            <div class="metric">
                                <div class="metric-value"><?= $progress ?>%</div>
                                <div class="metric-label">Progress</div>
                            </div>
                            <div class="metric">
                                <div class="metric-value"><?= $c['quarter'] ?></div>
                                <div class="metric-label">Quarter</div>
                            </div>
                            <div class="metric">
                                <div class="metric-value"><?= $c['activeSince'] ? date('d/m', strtotime($c['activeSince'])) : 'N/A' ?></div>
                                <div class="metric-label">Active Since</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        
        <section class="streams-section">
            <h2 class="section-title">Revenue Streams Breakdown</h2>
            <div class="streams-grid">
                <div class="stream-card">
                    <div class="stream-icon">💻</div>
                    <div class="stream-name">SaaS Products</div>
                    <div class="stream-value">Rp 300M</div>
                </div>
                <div class="stream-card">
                    <div class="stream-icon">🛠️</div>
                    <div class="stream-name">Freelance Services</div>
                    <div class="stream-value">Rp 250M</div>
                </div>
                <div class="stream-card">
                    <div class="stream-icon">📚</div>
                    <div class="stream-name">Digital Products</div>
                    <div class="stream-value">Rp 200M</div>
                </div>
                <div class="stream-card">
                    <div class="stream-icon">💎</div>
                    <div class="stream-name">Consulting</div>
                    <div class="stream-value">Rp 150M</div>
                </div>
                <div class="stream-card">
                    <div class="stream-icon">🔗</div>
                    <div class="stream-name">Affiliate</div>
                    <div class="stream-value">Rp 100M</div>
                </div>
            </div>
        </section>
    </main>
    
    <footer class="footer">
        <p><span>Maha Lakshmi</span> - Revenue Intelligence Dashboard | Powered by <span>GAURANGA</span> AI</p>
        <p>Target: Rp 1.000.000.000/bulan dari 10 Perusahaan</p>
        <p>Last Updated: <span id="lastUpdate"><?= date('d/m/Y H:i') ?></span></p>
    </footer>
    
    <script>
        // Format currency
        function formatCurrency(num) {
            return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
        
        // Show notification
        function showNotification(message, type = 'success') {
            const notif = document.getElementById('notification');
            notif.textContent = message;
            notif.className = 'notification ' + type + ' show';
            setTimeout(() => { notif.classList.remove('show'); }, 3000);
        }
        
        // Open Kasir Modal
        function openKasirModal() {
            document.getElementById('kasirModal').classList.add('active');
        }
        
        // Close Kasir Modal
        function closeKasirModal() {
            document.getElementById('kasirModal').classList.remove('active');
            document.getElementById('kasirForm').reset();
        }
        
        // Open CEO Report Modal
        function openCeoReport() {
            document.getElementById('ceoModal').classList.add('active');
            loadCeoReport();
        }
        
        // Close CEO Report Modal
        function closeCeoReport() {
            document.getElementById('ceoModal').classList.remove('active');
        }
        
        // Load CEO Report Data
        async function loadCeoReport() {
            try {
                const response = await fetch('api/kasir.php?action=companies');
                const result = await response.json();
                
                if (result.success) {
                    const companies = result.data;
                    const summary = result.summary;
                    const totalTarget = companies.length * 100000000;
                    const totalRevenue = summary.totalRevenue;
                    const progressPercent = totalRevenue > 0 ? Math.min(100, (totalRevenue / totalTarget) * 100) : 0;
                    
                    // Update summary cards
                    document.getElementById('ceoRevenue').textContent = formatCurrency(totalRevenue);
                    document.getElementById('ceoActive').textContent = summary.active;
                    document.getElementById('ceoReady').textContent = summary.ready;
                    document.getElementById('ceoPending').textContent = summary.pending;
                    
                    // Update progress bar
                    document.getElementById('ceoProgressBar').style.width = progressPercent + '%';
                    document.getElementById('ceoProgressText').textContent = progressPercent.toFixed(1) + '%';
                    
                    // Generate company list
                    let companyListHTML = '';
                    companies.forEach(c => {
                        const statusColor = c.status === 'active' ? '#10B981' : (c.status === 'ready' ? '#F59E0B' : '#A855F7');
                        const statusEmoji = c.status === 'active' ? '✅' : (c.status === 'ready' ? '⚡' : '⏳');
                        
                        companyListHTML += `
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(255,255,255,0.03); border-radius: 8px; margin-bottom: 8px;">
                                <div>
                                    <div style="font-weight: 600;">${statusEmoji} ${c.name}</div>
                                    <div style="font-size: 12px; color: #888;">${c.type}</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="color: #FFD700; font-weight: 600;">${formatCurrency(c.revenue)}</div>
                                    <div style="font-size: 11px; color: ${statusColor};">${c.status.toUpperCase()} | ${c.progress}%</div>
                                </div>
                            </div>
                        `;
                    });
                    document.getElementById('ceoCompanyList').innerHTML = companyListHTML;
                }
            } catch (err) {
                console.error('Failed to load CEO report:', err);
            }
        }
        
        // Submit Kasir Form
        document.getElementById('kasirForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                company_id: formData.get('company_id'),
                amount: formData.get('amount'),
                description: formData.get('description') || 'Transaksi kasir',
                source: 'dashboard-kasir'
            };
            
            try {
                const response = await fetch('api/kasir.php?action=add', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showNotification('✅ Transaksi berhasil! Status: ' + result.company.status);
                    closeKasirModal();
                    refreshData();
                } else {
                    showNotification('❌ Error: ' + result.error, 'error');
                }
            } catch (err) {
                showNotification('❌ Gagal mengirim data', 'error');
            }
        });
        
        // Refresh Data from API
        async function refreshData() {
            try {
                const response = await fetch('api/kasir.php?action=companies');
                const result = await response.json();
                
                if (result.success) {
                    updateDashboard(result.data, result.summary);
                    document.getElementById('lastUpdate').textContent = new Date().toLocaleString('id-ID');
                }
            } catch (err) {
                console.error('Failed to refresh:', err);
            }
        }
        
        // Update Dashboard with new data
        function updateDashboard(companies, summary) {
            // Update summary
            document.getElementById('totalRevenue').textContent = formatCurrency(summary.totalRevenue);
            document.getElementById('activeCount').textContent = summary.active;
            document.getElementById('activeCompanies').textContent = summary.active;
            document.getElementById('readyCompanies').textContent = summary.ready;
            document.getElementById('pendingCompanies').textContent = summary.pending;
            
            // Update company cards
            companies.forEach(c => {
                const card = document.querySelector(`[data-company-id="${c.id}"]`);
                if (card) {
                    // Update status
                    const statusEl = card.querySelector('.company-status');
                    statusEl.className = 'company-status status-' + c.status;
                    statusEl.textContent = c.status.charAt(0).toUpperCase() + c.status.slice(1);
                    
                    // Update revenue
                    const amountEl = card.querySelector('.revenue-amount');
                    amountEl.textContent = formatCurrency(c.revenue);
                    
                    // Update progress bar
                    const progressBar = card.querySelector('.progress-fill');
                    progressBar.style.width = c.progress + '%';
                    
                    // Update metrics
                    const metrics = card.querySelectorAll('.metric-value');
                    metrics[0].textContent = c.progress + '%';
                    if (c.activeSince) {
                        const date = new Date(c.activeSince);
                        metrics[2].textContent = date.toLocaleDateString('id-ID', {day: '2-digit', month: '2-digit'});
                    }
                }
            });
        }
        
        // Auto-refresh every 30 seconds
        setInterval(refreshData, 30000);
    </script>
</body>
</html>
