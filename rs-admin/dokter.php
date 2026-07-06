<?php
/**
 * Manajemen Data Dokter - RS Payangan Hospital
 */

require_once 'includes/auth.php';
require_role(['direktur', 'admin']);

$page_title = 'Data Dokter';

// Demo data dokter
$dokter_list = [
    ['id' => 1, 'nip' => '197801152008011001', 'nama' => 'dr. Wayan Susila, Sp.PD', 'spesialisasi' => 'Penyakit Dalam', 'poli' => 'Poli Dalam', 'status' => 'active'],
    ['id' => 2, 'nip' => '198205202010121001', 'nama' => 'dr. Made Sugiana, Sp.B', 'spesialisasi' => 'Bedah', 'poli' => 'Poli Bedah', 'status' => 'active'],
    ['id' => 3, 'nip' => '198510152015032001', 'nama' => 'dr. Nyoman Wiratama, Sp.A', 'spesialisasi' => 'Anak', 'poli' => 'Poli Anak', 'status' => 'active'],
    ['id' => 4, 'nip' => '197903252009121001', 'nama' => 'dr. Ketut Sudira, Sp.OG', 'spesialisasi' => 'Kandungan', 'poli' => 'Poli Kandungan', 'status' => 'active'],
    ['id' => 5, 'nip' => '198707302018011001', 'nama' => 'dr. Putu Ardana, Sp.JP', 'spesialisasi' => 'Jantung', 'poli' => 'Poli Jantung', 'status' => 'active'],
    ['id' => 6, 'nip' => '199003152020011001', 'nama' => 'dr. Komang Sari, Sp.THT', 'spesialisasi' => 'THT', 'poli' => 'Poli THT', 'status' => 'active'],
    ['id' => 7, 'nip' => '198201202013011001', 'nama' => 'dr. Bagus Santika, Sp.S', 'spesialisasi' => 'Saraf', 'poli' => 'Poli Saraf', 'status' => 'active'],
    ['id' => 8, 'nip' => '198405102016021001', 'nama' => 'dr. Rai Wahyudi, Sp.Ort', 'spesialisasi' => 'Ortopedi', 'poli' => 'Poli Ortopedi', 'status' => 'active'],
    ['id' => 9, 'nip' => '199204202019011001', 'nama' => 'drg. Ayu Lestari', 'spesialisasi' => 'Gigi', 'poli' => 'Poli Gigi', 'status' => 'active'],
    ['id' => 10, 'nip' => '198608152017011001', 'nama' => 'dr. Iwan Prasetya, Sp.U', 'spesialisasi' => 'Umum', 'poli' => 'Poli Umum', 'status' => 'active'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dokter - RS Payangan Hospital</title>
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
        body { font-family: 'Montserrat', sans-serif; background: var(--bg-light); }
        
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
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 600; font-size: 0.9rem;
        }
        .user-info .name { font-weight: 600; font-size: 0.85rem; }
        .user-info .role { font-size: 0.7rem; color: var(--text-muted); }
        
        .sidebar {
            position: fixed; top: 70px; left: 0; bottom: 0; width: 260px;
            background: white; box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            overflow-y: auto; z-index: 999;
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
            padding: 12px 24px; border: none; border-radius: 10px;
            font-size: 0.9rem; font-weight: 500; cursor: pointer;
            display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.3s;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { background: white; color: var(--primary); border: 2px solid var(--primary); }
        .btn-outline:hover { background: var(--primary); color: white; }
        
        .card { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .card-title { font-size: 1rem; font-weight: 600; }
        
        .search-bar {
            display: flex; gap: 15px; margin-bottom: 20px;
        }
        .search-input {
            flex: 1; padding: 12px 20px; border: 2px solid #e5e7eb;
            border-radius: 10px; font-size: 0.9rem; font-family: 'Montserrat', sans-serif;
        }
        .search-input:focus { outline: none; border-color: var(--primary); }
        .filter-select {
            padding: 12px 20px; border: 2px solid #e5e7eb; border-radius: 10px;
            font-size: 0.9rem; font-family: 'Montserrat', sans-serif; cursor: pointer;
        }
        
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            background: var(--bg-light); padding: 15px 20px; text-align: left;
            font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase;
        }
        .data-table td { padding: 15px 20px; border-bottom: 1px solid #f0f0f0; font-size: 0.9rem; }
        .data-table tr:hover { background: var(--bg-light); }
        
        .dokter-info { display: flex; align-items: center; gap: 15px; }
        .dokter-foto {
            width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 600; font-size: 1.2rem;
        }
        .dokter-detail h4 { font-size: 0.95rem; margin-bottom: 3px; }
        .dokter-detail p { font-size: 0.8rem; color: var(--text-muted); }
        
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;
        }
        .status-active { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-inactive { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        
        .action-btn {
            background: none; border: none; color: var(--text-muted); cursor: pointer;
            padding: 8px; border-radius: 8px; transition: all 0.3s;
        }
        .action-btn:hover { background: var(--bg-light); color: var(--primary); }
        .action-btn.danger:hover { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        
        .pagination {
            display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 25px;
        }
        .pagination a {
            padding: 10px 15px; border-radius: 8px; text-decoration: none;
            color: var(--text-dark); background: var(--bg-light); font-size: 0.9rem;
        }
        .pagination a.active { background: var(--primary); color: white; }
        .pagination a:hover { background: var(--primary-light); color: white; }
        
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .data-table { display: block; overflow-x: auto; }
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
                <span class="name"><?php echo htmlspecialchars($_SESSION['nama'] ?? 'Admin'); ?></span>
                <span class="role"><?php echo get_role_display($_SESSION['role'] ?? 'admin'); ?></span>
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
                <a href="dokter.php" class="sidebar-link active"><i class="fas fa-user-md"></i> Data Dokter</a>
                <a href="poli.php" class="sidebar-link"><i class="fas fa-stethoscope"></i> Data Poli</a>
                <a href="pasien.php" class="sidebar-link"><i class="fas fa-users"></i> Data Pasien</a>
                <a href="kamar.php" class="sidebar-link"><i class="fas fa-bed"></i> Kamar Inap</a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-section-title">Layanan</div>
                <a href="antrean.php" class="sidebar-link"><i class="fas fa-clipboard-list"></i> Antrean</a>
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
                <h1>Data Dokter</h1>
                <p class="breadcrumb">
                    <a href="dashboard.php">Dashboard</a> / Data Dokter
                </p>
            </div>
            <a href="dokter-form.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Dokter
            </a>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Dokter (<?php echo count($dokter_list); ?> orang)</h3>
            </div>
            
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Cari nama dokter, NIP, atau spesialisasi...">
                <select class="filter-select">
                    <option value="">Semua Poli</option>
                    <option value="poli-dalam">Poli Dalam</option>
                    <option value="poli-bedah">Poli Bedah</option>
                    <option value="poli-anak">Poli Anak</option>
                    <option value="poli-kandungan">Poli Kandungan</option>
                </select>
                <button class="btn btn-outline">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Dokter</th>
                        <th>NIP</th>
                        <th>Spesialisasi</th>
                        <th>Poli</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dokter_list as $dokter): ?>
                    <tr>
                        <td>
                            <div class="dokter-info">
                                <div class="dokter-foto">
                                    <?php echo strtoupper(substr($dokter['nama'], 3, 1)); ?>
                                </div>
                                <div class="dokter-detail">
                                    <h4><?php echo htmlspecialchars($dokter['nama']); ?></h4>
                                </div>
                            </div>
                        </td>
                        <td><code style="background: var(--bg-light); padding: 3px 8px; border-radius: 4px;"><?php echo $dokter['nip']; ?></code></td>
                        <td><?php echo htmlspecialchars($dokter['spesialisasi']); ?></td>
                        <td><?php echo htmlspecialchars($dokter['poli']); ?></td>
                        <td>
                            <span class="status-badge <?php echo ($dokter['status'] == 'active') ? 'status-active' : 'status-inactive'; ?>">
                                <i class="fas fa-<?php echo ($dokter['status'] == 'active') ? 'check-circle' : 'times-circle'; ?>"></i>
                                <?php echo ucfirst($dokter['status']); ?>
                            </span>
                        </td>
                        <td>
                            <button class="action-btn" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                            <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="action-btn danger" title="Hapus"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="pagination">
                <a href="#"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#"><i class="fas fa-chevron-right"></i></a>
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
