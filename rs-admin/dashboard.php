<?php
/**
 * Dashboard - RS Payangan Hospital
 */

require_once 'includes/auth.php';
require_login();

$page_title = 'Dashboard';
$current_user = get_current_user();

// Get role-specific dashboard data (demo data)
$dokter_count = 22;
$poli_count = 14;
$pasien_count = 156;
$kamar_tersedia = 8;
$kamar_total = 10;
$antrean_hari_ini = 47;
$antrean_menunggu = 12;

$recent_activities = [
    ['time' => '10 menit lalu', 'user' => 'Sistem', 'action' => 'Auto-refresh dashboard', 'icon' => 'fa-sync'],
    ['time' => '30 menit lalu', 'user' => 'Admin', 'action' => 'Update jadwal dr. Wayan', 'icon' => 'fa-user-edit'],
    ['time' => '1 jam lalu', 'user' => 'Karyawan', 'action' => 'Tambah antrean baru', 'icon' => 'fa-plus'],
    ['time' => '2 jam lalu', 'user' => 'Sistem', 'action' => 'Reset antrean harian', 'icon' => 'fa-refresh'],
    ['time' => '3 jam lalu', 'user' => 'Admin', 'action' => 'Update tarif kamar', 'icon' => 'fa-dollar-sign'],
];

// Stats berdasarkan role
$role_stats = [
    'direktur' => [
        ['label' => 'Total Pasien', 'value' => $pasien_count, 'icon' => 'fa-users', 'color' => '#1a5f5a', 'trend' => '+12%'],
        ['label' => 'Pendapatan Bulan Ini', 'value' => 'Rp 850jt', 'icon' => 'fa-dollar-sign', 'color' => '#c9a86c', 'trend' => '+8%'],
        ['label' => 'Rata-rata Antrean', 'value' => '35 menit', 'icon' => 'fa-clock', 'color' => '#10b981', 'trend' => '-5%'],
        ['label' => 'Bed Occupancy', 'value' => '65%', 'icon' => 'fa-bed', 'color' => '#f59e0b', 'trend' => '+3%'],
    ],
    'admin' => [
        ['label' => 'Total Dokter', 'value' => $dokter_count, 'icon' => 'fa-user-md', 'color' => '#1a5f5a', 'trend' => '+2'],
        ['label' => 'Total Poli', 'value' => $poli_count, 'icon' => 'fa-stethoscope', 'color' => '#10b981', 'trend' => ''],
        ['label' => 'User Aktif', 'value' => 8, 'icon' => 'fa-user-check', 'color' => '#c9a86c', 'trend' => ''],
        ['label' => 'Kamar Tersedia', 'value' => $kamar_tersedia . '/' . $kamar_total, 'icon' => 'fa-bed', 'color' => '#f59e0b', 'trend' => ''],
    ],
    'karyawan' => [
        ['label' => 'Antrean Hari Ini', 'value' => $antrean_hari_ini, 'icon' => 'fa-clipboard-list', 'color' => '#1a5f5a', 'trend' => ''],
        ['label' => 'Menunggu', 'value' => $antrean_menunggu, 'icon' => 'fa-hourglass-half', 'color' => '#f59e0b', 'trend' => ''],
        ['label' => 'Selesai', 'value' => $antrean_hari_ini - $antrean_menunggu, 'icon' => 'fa-check-circle', 'color' => '#10b981', 'trend' => ''],
        ['label' => 'IGD Aktif', 'value' => 3, 'icon' => 'fa-ambulance', 'color' => '#ef4444', 'trend' => ''],
    ]
];

$stats = $role_stats[$current_user['role']] ?? $role_stats['karyawan'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RS Payangan Hospital</title>
    <link rel="icon" type="image/png" href="../logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a5f5a;
            --primary-dark: #0f3d3a;
            --primary-light: #2d8a84;
            --secondary: #c9a86c;
            --bg-light: #f8fafc;
            --text-dark: #2c3e3c;
            --text-muted: #6c757d;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }
        
        /* Top Navbar */
        .navbar {
            background: white;
            padding: 0 30px;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-area img { height: 45px; }
        
        .logo-text strong { font-size: 1.1rem; color: var(--primary); }
        .logo-text span { font-size: 0.75rem; color: var(--text-muted); }
        
        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.3rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
        }
        
        .sidebar-toggle:hover { background: var(--bg-light); }
        
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .navbar-icon {
            position: relative;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--text-muted);
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
        }
        
        .navbar-icon:hover { background: var(--bg-light); color: var(--primary); }
        
        .navbar-icon .badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background: var(--danger);
            color: white;
            font-size: 0.65rem;
            padding: 2px 5px;
            border-radius: 50%;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background: var(--bg-light);
            border-radius: 50px;
            cursor: pointer;
        }
        
        .user-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .user-info .name { font-weight: 600; font-size: 0.85rem; }
        .user-info .role { font-size: 0.7rem; color: var(--text-muted); }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            bottom: 0;
            width: 260px;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            overflow-y: auto;
            z-index: 999;
        }
        
        .sidebar-menu { padding: 20px 15px; }
        
        .sidebar-section { margin-bottom: 25px; }
        
        .sidebar-section-title {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 15px;
            margin-bottom: 8px;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.85rem;
            transition: all 0.3s;
            margin-bottom: 3px;
        }
        
        .sidebar-link:hover {
            background: var(--bg-light);
            color: var(--primary);
        }
        
        .sidebar-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
        }
        
        .sidebar-link i { width: 20px; text-align: center; }
        
        /* Main Content */
        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }
        
        .page-header {
            margin-bottom: 30px;
        }
        
        .page-header h1 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .page-header .welcome {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .page-header .welcome strong {
            color: var(--primary);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 3px;
        }
        
        .stat-info p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        
        .stat-trend {
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 20px;
            margin-top: 5px;
            display: inline-block;
        }
        
        .stat-trend.up { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-trend.down { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        
        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }
        
        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .card-title {
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-title i { color: var(--primary); }
        
        .btn-sm {
            padding: 8px 15px;
            background: var(--bg-light);
            color: var(--text-dark);
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .btn-sm:hover { background: var(--primary); color: white; }
        
        /* Table */
        .activity-list { list-style: none; }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .activity-item:last-child { border-bottom: none; }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            background: var(--bg-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }
        
        .activity-content { flex: 1; }
        .activity-content h4 { font-size: 0.9rem; margin-bottom: 3px; }
        .activity-content p { font-size: 0.8rem; color: var(--text-muted); }
        .activity-time { font-size: 0.75rem; color: var(--text-muted); }
        
        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 20px;
            background: var(--bg-light);
            border-radius: 12px;
            text-decoration: none;
            color: var(--text-dark);
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            background: var(--primary);
            color: white;
        }
        
        .action-btn i { font-size: 1.5rem; }
        .action-btn span { font-size: 0.8rem; }
        
        /* Antrian Info */
        .antrean-display {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 16px;
            padding: 25px;
            color: white;
            text-align: center;
        }
        
        .antrean-number {
            font-size: 4rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 10px;
        }
        
        .antrean-label {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }
        
        .antrean-status {
            display: flex;
            justify-content: center;
            gap: 20px;
            font-size: 0.85rem;
        }
        
        .antrean-status span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .dashboard-grid { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .navbar { padding: 0 15px; }
            .main-content { padding: 20px; }
        }
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
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="logo-area">
                <img src="../logo.png" alt="Logo">
                <div class="logo-text">
                    <strong>RS Payangan</strong>
                    <span>Admin Panel</span>
                </div>
            </div>
        </div>
        
        <div class="navbar-right">
            <button class="navbar-icon">
                <i class="fas fa-bell"></i>
                <span class="badge">3</span>
            </button>
            
            <div class="user-menu">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($current_user['nama'] ?? 'U', 0, 1)); ?>
                </div>
                <div class="user-info">
                    <span class="name"><?php echo htmlspecialchars($current_user['nama'] ?? 'User'); ?></span>
                    <span class="role"><?php echo get_role_display($current_user['role'] ?? 'user'); ?></span>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-menu">
            <div class="sidebar-section">
                <div class="sidebar-section-title">Menu Utama</div>
                <a href="dashboard.php" class="sidebar-link active">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="#" class="sidebar-link">
                    <i class="fas fa-clipboard"></i> Laporan
                </a>
            </div>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">Manajemen</div>
                <a href="dokter.php" class="sidebar-link">
                    <i class="fas fa-user-md"></i> Data Dokter
                </a>
                <a href="poli.php" class="sidebar-link">
                    <i class="fas fa-stethoscope"></i> Data Poli
                </a>
                <a href="pasien.php" class="sidebar-link">
                    <i class="fas fa-users"></i> Data Pasien
                </a>
                <a href="kamar.php" class="sidebar-link">
                    <i class="fas fa-bed"></i> Kamar Inap
                </a>
            </div>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">Layanan</div>
                <a href="antrean.php" class="sidebar-link">
                    <i class="fas fa-clipboard-list"></i> Antrean
                </a>
                <a href="igd.php" class="sidebar-link">
                    <i class="fas fa-ambulance"></i> IGD
                </a>
                <a href="rawat-inap.php" class="sidebar-link">
                    <i class="fas fa-procedures"></i> Rawat Inap
                </a>
            </div>
            
            <?php if (has_role(['direktur', 'admin'])): ?>
            <div class="sidebar-section">
                <div class="sidebar-section-title">Administrsi</div>
                <a href="users.php" class="sidebar-link">
                    <i class="fas fa-user-cog"></i> Manajemen User
                </a>
                <a href="pengaturan.php" class="sidebar-link">
                    <i class="fas fa-cogs"></i> Pengaturan
                </a>
            </div>
            <?php endif; ?>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">Sistem</div>
                <a href="../progress/director-report-login.html" class="sidebar-link" target="_blank">
                    <i class="fas fa-chart-bar"></i> Laporan Direksi
                </a>
                <a href="logout.php" class="sidebar-link" style="color: var(--danger);">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <h1>Dashboard</h1>
            <p class="welcome">Selamat datang, <strong><?php echo htmlspecialchars($current_user['nama'] ?? 'User'); ?></strong>! Berikut ringkasan aktivitas hari ini.</p>
        </div>
        
        <!-- Stats Grid -->
        <div class="stats-grid">
            <?php foreach ($stats as $stat): ?>
            <div class="stat-card">
                <div class="stat-icon" style="background: <?php echo $stat['color']; ?>;">
                    <i class="fas <?php echo $stat['icon']; ?>"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stat['value']; ?></h3>
                    <p><?php echo $stat['label']; ?></p>
                    <?php if (!empty($stat['trend'])): ?>
                    <span class="stat-trend <?php echo (strpos($stat['trend'], '+') !== false) ? 'up' : 'down'; ?>">
                        <?php echo $stat['trend']; ?> dari kemarin
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Main Content -->
            <div>
                <!-- Recent Activity -->
                <div class="card" style="margin-bottom: 25px;">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history"></i> Aktivitas Terbaru
                        </h3>
                        <a href="log-aktivitas.php" class="btn-sm">Lihat Semua</a>
                    </div>
                    <ul class="activity-list">
                        <?php foreach ($recent_activities as $activity): ?>
                        <li class="activity-item">
                            <div class="activity-icon">
                                <i class="fas <?php echo $activity['icon']; ?>"></i>
                            </div>
                            <div class="activity-content">
                                <h4><?php echo htmlspecialchars($activity['action']); ?></h4>
                                <p>Oleh: <?php echo htmlspecialchars($activity['user']); ?></p>
                            </div>
                            <span class="activity-time"><?php echo $activity['time']; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bolt"></i> Aksi Cepat
                        </h3>
                    </div>
                    <div class="quick-actions">
                        <a href="antrean.php?action=tambah" class="action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>Tambah Antrean</span>
                        </a>
                        <a href="pasien.php?action=tambah" class="action-btn">
                            <i class="fas fa-user-plus"></i>
                            <span>Registrasi Pasien</span>
                        </a>
                        <a href="igd.php?action=tambah" class="action-btn">
                            <i class="fas fa-ambulance"></i>
                            <span>Pasien IGD</span>
                        </a>
                        <a href="rawat-inap.php?action=tambah" class="action-btn">
                            <i class="fas fa-bed"></i>
                            <span>Rawat Inap</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar Content -->
            <div>
                <!-- Antrean Display -->
                <div class="card" style="margin-bottom: 25px;">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tv"></i> Display Antrean
                        </h3>
                    </div>
                    <div class="antrean-display">
                        <div class="antrean-number">A-023</div>
                        <div class="antrean-label">sedang dilayani di Poli Umum</div>
                        <div class="antrean-status">
                            <span><i class="fas fa-clock"></i> Estimasi: 15 menit</span>
                            <span><i class="fas fa-users"></i> 12 menunggu</span>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Info -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle"></i> Info Sistem
                        </h3>
                    </div>
                    <div style="font-size: 0.85rem;">
                        <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                            <span>Status Server</span>
                            <span style="color: var(--success);"><i class="fas fa-circle"></i> Online</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                            <span>Database</span>
                            <span style="color: var(--success);"><i class="fas fa-circle"></i> Connected</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                            <span>Last Sync</span>
                            <span><?php echo date('H:i'); ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                            <span>Versi</span>
                            <span>1.0.0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>
