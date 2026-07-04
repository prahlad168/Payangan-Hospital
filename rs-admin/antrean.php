<?php
/**
 * Manajemen Antrean - RS Payangan Hospital
 */

require_once 'includes/auth.php';
require_login();

$page_title = 'Antrean';

// Demo data antrean
$antrean_list = [
    ['nomor' => 'A-001', 'nama' => 'I Wayan Sukarno', 'poli' => 'Poli Umum', 'dokter' => 'dr. Iwan Prasetya', 'status' => 'done', 'waktu' => '07:30'],
    ['nomor' => 'A-002', 'nama' => 'I Made Wira', 'poli' => 'Poli Anak', 'dokter' => 'dr. Nyoman Wiratama', 'status' => 'done', 'waktu' => '08:00'],
    ['nomor' => 'A-003', 'nama' => 'I Nyoman Budi', 'poli' => 'Poli Dalam', 'dokter' => 'dr. Wayan Susila', 'status' => 'serving', 'waktu' => '08:30'],
    ['nomor' => 'A-004', 'nama' => 'I Gusti Ayu Sri', 'poli' => 'Poli Kandungan', 'dokter' => 'dr. Ketut Sudira', 'status' => 'waiting', 'waktu' => '09:00'],
    ['nomor' => 'A-005', 'nama' => 'I Putu Gede', 'poli' => 'Poli Jantung', 'dokter' => 'dr. Putu Ardana', 'status' => 'waiting', 'waktu' => '09:30'],
    ['nomor' => 'A-006', 'nama' => 'I Gusti Komang', 'poli' => 'Poli Gigi', 'dokter' => 'drg. Ayu Lestari', 'status' => 'waiting', 'waktu' => '10:00'],
    ['nomor' => 'A-007', 'nama' => 'I Nyoman Arya', 'poli' => 'Poli THT', 'dokter' => 'dr. Komang Sari', 'status' => 'waiting', 'waktu' => '10:30'],
    ['nomor' => 'A-008', 'nama' => 'I Wayan Sudiarta', 'poli' => 'Poli Saraf', 'dokter' => 'dr. Bagus Santika', 'status' => 'waiting', 'waktu' => '11:00'],
];

$stats = [
    'total' => 47,
    'menunggu' => 12,
    'dilayani' => 32,
    'selesai' => 28
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrean - RS Payangan Hospital</title>
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
            --info: #3b82f6;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Montserrat', sans-serif; background: var(--bg-light); }
        
        .navbar {
            background: white; padding: 0 30px; height: 70px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
        }
        .navbar-left { display: flex; align-items: center; gap: 20px; }
        .logo-area { display: flex; align-items: center; gap: 12px; }
        .logo-area img { height: 45px; }
        .logo-text strong { font-size: 1.1rem; color: var(--primary); }
        .logo-text span { font-size: 0.75rem; color: var(--text-muted); }
        .sidebar-toggle { background: none; border: none; font-size: 1.3rem; color: var(--text-dark); cursor: pointer; padding: 10px; border-radius: 8px; }
        .sidebar-toggle:hover { background: var(--bg-light); }
        .navbar-right { display: flex; align-items: center; gap: 15px; }
        .user-avatar {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 600; font-size: 0.9rem;
        }
        .user-info .name { font-weight: 600; font-size: 0.85rem; }
        .user-info .role { font-size: 0.7rem; color: var(--text-muted); }
        
        .sidebar {
            position: fixed; top: 70px; left: 0; bottom: 0; width: 260px;
            background: white; box-shadow: 2px 0 10px rgba(0,0,0,0.05); overflow-y: auto; z-index: 999;
        }
        .sidebar-menu { padding: 20px 15px; }
        .sidebar-section { margin-bottom: 25px; }
        .sidebar-section-title { font-size: 0.7rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; padding: 0 15px; margin-bottom: 8px; }
        .sidebar-link {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 15px; color: var(--text-dark); text-decoration: none;
            border-radius: 10px; font-size: 0.85rem; transition: all 0.3s; margin-bottom: 3px;
        }
        .sidebar-link:hover { background: var(--bg-light); color: var(--primary); }
        .sidebar-link.active { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white; }
        .sidebar-link i { width: 20px; text-align: center; }
        
        .main-content { margin-left: 260px; margin-top: 70px; padding: 30px; min-height: calc(100vh - 70px); }
        
        .page-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
        .page-header h1 { font-size: 1.6rem; font-weight: 600; margin-bottom: 5px; }
        .page-header .breadcrumb { font-size: 0.85rem; color: var(--text-muted); }
        .page-header .breadcrumb a { color: var(--primary); text-decoration: none; }
        
        .btn {
            padding: 12px 24px; border: none; border-radius: 10px; font-size: 0.9rem; font-weight: 500;
            cursor: pointer; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.3s;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-success { background: var(--success); color: white; }
        .btn-warning { background: var(--warning); color: white; }
        
        /* Stats */
        .stats-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;
        }
        .stat-card {
            background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex; align-items: center; gap: 20px;
        }
        .stat-icon {
            width: 60px; height: 60px; border-radius: 14px; display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: white;
        }
        .stat-info h3 { font-size: 1.8rem; font-weight: 700; }
        .stat-info p { font-size: 0.85rem; color: var(--text-muted); }
        
        .card { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .card-title { font-size: 1rem; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .card-title i { color: var(--primary); }
        
        /* Antrean Display */
        .antrean-display {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 20px; padding: 40px; text-align: center; color: white; margin-bottom: 25px;
        }
        .antrean-number {
            font-size: 6rem; font-weight: 700; line-height: 1; margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        .antrean-label { font-size: 1.2rem; opacity: 0.9; margin-bottom: 20px; }
        .antrean-info { display: flex; justify-content: center; gap: 40px; font-size: 0.9rem; }
        .antrean-info span { display: flex; align-items: center; gap: 8px; }
        
        /* Table */
        .antrean-table { width: 100%; border-collapse: collapse; }
        .antrean-table th {
            background: var(--bg-light); padding: 15px 20px; text-align: left;
            font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;
        }
        .antrean-table td { padding: 15px 20px; border-bottom: 1px solid #f0f0f0; font-size: 0.9rem; }
        .antrean-table tr:hover { background: var(--bg-light); }
        
        .nomor-antrean {
            font-size: 1.3rem; font-weight: 700; color: var(--primary);
        }
        
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;
        }
        .status-waiting { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .status-serving { background: rgba(59, 130, 246, 0.1); color: var(--info); }
        .status-done { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-cancel { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        
        .action-btn {
            background: none; border: none; cursor: pointer; padding: 8px; border-radius: 8px;
            color: var(--text-muted); transition: all 0.3s;
        }
        .action-btn:hover { background: var(--bg-light); color: var(--primary); }
        .action-btn.success:hover { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .action-btn.danger:hover { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <button class="sidebar-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
            <div class="logo-area">
                <img src="../logo.png" alt="Logo">
                <div class="logo-text">
                    <strong>RS Payangan</strong>
                    <span>Admin Panel</span>
                </div>
            </div>
        </div>
        <div class="navbar-right">
            <div class="user-avatar"><?php echo strtoupper(substr($_SESSION['nama'] ?? 'A', 0, 1)); ?></div>
            <div class="user-info">
                <span class="name"><?php echo htmlspecialchars($_SESSION['nama'] ?? 'User'); ?></span>
                <span class="role"><?php echo get_role_display($_SESSION['role'] ?? 'user'); ?></span>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-menu">
            <div class="sidebar-section">
                <div class="sidebar-section-title">Menu Utama</div>
                <a href="dashboard.php" class="sidebar-link"><i class="fas fa-home"></i> Dashboard</a>
                <a href="#" class="sidebar-link"><i class="fas fa-clipboard"></i> Laporan</a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-section-title">Manajemen</div>
                <a href="dokter.php" class="sidebar-link"><i class="fas fa-user-md"></i> Data Dokter</a>
                <a href="poli.php" class="sidebar-link"><i class="fas fa-stethoscope"></i> Data Poli</a>
                <a href="pasien.php" class="sidebar-link"><i class="fas fa-users"></i> Data Pasien</a>
                <a href="kamar.php" class="sidebar-link"><i class="fas fa-bed"></i> Kamar Inap</a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-section-title">Layanan</div>
                <a href="antrean.php" class="sidebar-link active"><i class="fas fa-clipboard-list"></i> Antrean</a>
                <a href="igd.php" class="sidebar-link"><i class="fas fa-ambulance"></i> IGD</a>
                <a href="rawat-inap.php" class="sidebar-link"><i class="fas fa-procedures"></i> Rawat Inap</a>
            </div>
            <?php if (has_role(['direktur', 'admin'])): ?>
            <div class="sidebar-section">
                <div class="sidebar-section-title">Administrsi</div>
                <a href="users.php" class="sidebar-link"><i class="fas fa-user-cog"></i> Manajemen User</a>
                <a href="pengaturan.php" class="sidebar-link"><i class="fas fa-cogs"></i> Pengaturan</a>
            </div>
            <?php endif; ?>
            <div class="sidebar-section">
                <div class="sidebar-section-title">Sistem</div>
                <a href="../progress/director-report-login.html" class="sidebar-link" target="_blank"><i class="fas fa-chart-bar"></i> Laporan Direksi</a>
                <a href="logout.php" class="sidebar-link" style="color: var(--danger);"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <div>
                <h1>Antrean Pasien</h1>
                <p class="breadcrumb">
                    <a href="dashboard.php">Dashboard</a> / Antrean / <?php echo date('d F Y'); ?>
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <button class="btn btn-primary" onclick="cetakAntrean()">
                    <i class="fas fa-print"></i> Cetak Antrean
                </button>
                <a href="antrean.php?action=tambah" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Antrean
                </a>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--primary);"><i class="fas fa-clipboard-list"></i></div>
                <div class="stat-info">
                    <h3><?php echo $stats['total']; ?></h3>
                    <p>Total Antrean</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--warning);"><i class="fas fa-hourglass-half"></i></div>
                <div class="stat-info">
                    <h3><?php echo $stats['menunggu']; ?></h3>
                    <p>Menunggu</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--info);"><i class="fas fa-user-md"></i></div>
                <div class="stat-info">
                    <h3><?php echo $stats['dilayani']; ?></h3>
                    <p>Sedang Dilayani</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--success);"><i class="fas fa-check-circle"></i></div>
                <div class="stat-info">
                    <h3><?php echo $stats['selesai']; ?></h3>
                    <p>Selesai</p>
                </div>
            </div>
        </div>
        
        <!-- Antrean Display -->
        <div class="antrean-display">
            <div style="font-size: 1rem; opacity: 0.8; margin-bottom: 10px;">SEDANG LAYANAN</div>
            <div class="antrean-number">A-003</div>
            <div class="antrean-label">Poli Dalam - dr. Wayan Susila</div>
            <div class="antrean-info">
                <span><i class="fas fa-clock"></i> Estimasi selesai: 15 menit</span>
                <span><i class="fas fa-user"></i> I Nyoman Budi</span>
                <span><i class="fas fa-list"></i> 12 lagi menunggu</span>
            </div>
        </div>
        
        <!-- Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i> Daftar Antrean Hari Ini
                </h3>
            </div>
            
            <table class="antrean-table">
                <thead>
                    <tr>
                        <th>No. Antrean</th>
                        <th>Nama Pasien</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($antrean_list as $antrean): ?>
                    <tr>
                        <td><span class="nomor-antrean"><?php echo $antrean['nomor']; ?></span></td>
                        <td><?php echo htmlspecialchars($antrean['nama']); ?></td>
                        <td><?php echo htmlspecialchars($antrean['poli']); ?></td>
                        <td><?php echo htmlspecialchars($antrean['dokter']); ?></td>
                        <td><?php echo $antrean['waktu']; ?></td>
                        <td>
                            <span class="status-badge status-<?php echo $antrean['status']; ?>">
                                <?php
                                $status_labels = [
                                    'waiting' => 'Menunggu',
                                    'serving' => 'Dilayani',
                                    'done' => 'Selesai',
                                    'cancel' => 'Batal'
                                ];
                                ?>
                                <i class="fas fa-<?php echo ($antrean['status'] == 'done') ? 'check' : (($antrean['status'] == 'serving') ? 'user-md' : (($antrean['status'] == 'cancel') ? 'times' : 'clock')); ?>"></i>
                                <?php echo $status_labels[$antrean['status']] ?? $antrean['status']; ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($antrean['status'] == 'waiting'): ?>
                            <button class="action-btn success" title="Panggil"><i class="fas fa-bullhorn"></i></button>
                            <?php elseif ($antrean['status'] == 'serving'): ?>
                            <button class="action-btn success" title="Selesai"><i class="fas fa-check"></i></button>
                            <?php endif; ?>
                            <button class="action-btn" title="Detail"><i class="fas fa-eye"></i></button>
                            <button class="action-btn danger" title="Batal"><i class="fas fa-times"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
        
        function cetakAntrean() {
            window.print();
        }
    </script>
</body>
</html>
