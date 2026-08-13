<?php
/**
 * Manajemen Kamar - RS Payangan Hospital
 */

require_once 'includes/auth.php';
require_once 'config/database.php';
require_login();

$page_title = 'Manajemen Kamar';
$current_user = rs_get_current_user();

$db = Database::getInstance();
$conn = $db->getConnection();

// Handle POST update
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update') {
        $kamar_id = intval($_POST['kamar_id'] ?? 0);
        $terpakai = intval($_POST['terpakai'] ?? 0);
        $status = $_POST['status'] ?? 'available';
        
        $valid_status = ['available', 'full', 'maintenance'];
        if (!in_array($status, $valid_status)) $status = 'available';
        
        if ($kamar_id > 0) {
            $kapasitas_result = $conn->query("SELECT kapasitas FROM kamar WHERE id = $kamar_id");
            $kapasitas_row = $kapasitas_result->fetch_assoc();
            $kapasitas = $kapasitas_row ? intval($kapasitas_row['kapasitas']) : 0;
            
            if ($terpakai < 0) {
                $message = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Jumlah terpakai tidak boleh negatif</div>';
            } elseif ($kapasitas > 0 && $terpakai > $kapasitas) {
                $message = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Jumlah terpakai tidak boleh melebihi kapasitas (' . $kapasitas . ')</div>';
            } else {
                $sql = "UPDATE kamar SET terpakai = ?, status = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isi", $terpakai, $status, $kamar_id);
                
                if ($stmt->execute()) {
                    $message = '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Status kamar berhasil diperbarui</div>';
                    log_activity('update_kamar', 'kamar', "Updated kamar ID: $kamar_id");
                } else {
                    $message = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Gagal memperbarui status kamar</div>';
                }
            }
        }
    }
    
    if ($_POST['action'] === 'batch') {
        $updates = $_POST['rooms'] ?? [];
        
        if (empty($updates)) {
            $message = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Tidak ada data yang diperbarui</div>';
        } else {
            $conn->begin_transaction();
            try {
                $sql = "UPDATE kamar SET terpakai = ?, status = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                
                foreach ($updates as $kamar_id => $room_data) {
                    $kamar_id = intval($kamar_id);
                    $terpakai = intval($room_data['terpakai'] ?? 0);
                    $status = $room_data['status'] ?? 'available';
                    
                    if (!in_array($status, ['available', 'full', 'maintenance'])) {
                        $status = 'available';
                    }
                    
                    $kapasitas_result = $conn->query("SELECT kapasitas FROM kamar WHERE id = $kamar_id");
                    $kapasitas_row = $kapasitas_result->fetch_assoc();
                    $kapasitas = $kapasitas_row ? intval($kapasitas_row['kapasitas']) : 0;
                    
                    if ($terpakai < 0) {
                        throw new Exception("Jumlah terpakai tidak boleh negatif untuk kamar ID $kamar_id");
                    }
                    if ($kapasitas > 0 && $terpakai > $kapasitas) {
                        throw new Exception("Jumlah terpakai ($terpakai) melebihi kapasitas ($kapasitas) untuk kamar ID $kamar_id");
                    }
                    
                    $stmt->bind_param("isi", $terpakai, $status, $kamar_id);
                    $stmt->execute();
                }
                
                $conn->commit();
                $message = '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Semua status kamar berhasil diperbarui</div>';
                log_activity('batch_update_kamar', 'kamar', "Updated all rooms");
            } catch (Exception $e) {
                $conn->rollback();
                $message = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Gagal batch update: ' . $e->getMessage() . '</div>';
            }
        }
    }
}

// Get all rooms
$sql = "SELECT * FROM kamar ORDER BY lantai, kelas, nomor";
$result = $conn->query($sql);
$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

// Group rooms by lantai
$rooms_by_lantai = [];
foreach ($rooms as $room) {
    $lantai = $room['lantai'];
    if (!isset($rooms_by_lantai[$lantai])) {
        $rooms_by_lantai[$lantai] = [];
    }
    $rooms_by_lantai[$lantai][] = $room;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - RS Payangan Hospital</title>
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
        
        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        /* Card */
        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
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
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(26, 95, 90, 0.3);
        }
        
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
        
        /* Room Table */
        .room-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .room-table th {
            text-align: left;
            padding: 15px;
            background: var(--bg-light);
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .room-table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }
        
        .room-table tr:hover {
            background: rgba(26, 95, 90, 0.02);
        }
        
        .room-number {
            font-weight: 600;
            color: var(--primary);
        }
        
        .room-class {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            background: rgba(26, 95, 90, 0.1);
            color: var(--primary);
        }
        
        .room-class.vvip {
            background: linear-gradient(135deg, rgba(201, 168, 108, 0.15) 0%, rgba(201, 168, 108, 0.05) 100%);
            color: #8b6914;
        }
        
        .room-class.vip {
            background: rgba(26, 95, 90, 0.1);
            color: var(--primary);
        }
        
        .room-class.kelas1 {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }
        
        .room-class.kelas2, .room-class.kelas3 {
            background: rgba(108, 117, 125, 0.1);
            color: #4b5563;
        }
        
        .room-class.icu, .room-class.nicu {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-badge.available {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .status-badge.full {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }
        
        .status-badge.maintenance {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        
        .status-dot.available { background: var(--success); }
        .status-dot.full { background: var(--danger); }
        .status-dot.maintenance { background: var(--warning); }
        
        .form-control {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.85rem;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s;
            width: 100%;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 95, 90, 0.1);
        }
        
        .form-select {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.85rem;
            font-family: 'Montserrat', sans-serif;
            background: white;
            cursor: pointer;
            min-width: 140px;
        }
        
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 95, 90, 0.1);
        }
        
        .capacity-info {
            font-size: 0.8rem;
            color: var(--text-muted);
        }
        
        .capacity-info strong {
            color: var(--text-dark);
        }
        
        /* Floor Section */
        .floor-section {
            margin-bottom: 30px;
        }
        
        .floor-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .floor-title i {
            color: var(--primary);
        }
        
        /* Stats */
        .room-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
        
        .stat-icon.total { background: var(--primary); }
        .stat-icon.occupied { background: var(--danger); }
        .stat-icon.available { background: var(--success); }
        .stat-icon.maintenance { background: var(--warning); }
        
        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 3px;
        }
        
        .stat-info p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
        
        @media (max-width: 768px) {
            .navbar { padding: 0 15px; }
            .main-content { padding: 20px; }
            .room-table { font-size: 0.8rem; }
            .room-table th, .room-table td { padding: 10px; }
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
                <a href="dashboard.php" class="sidebar-link">
                    <i class="fas fa-home"></i> Dashboard
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
                <a href="kamar.php" class="sidebar-link active">
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
            <h1>Manajemen Kamar</h1>
            <p class="welcome">Kelola ketersediaan kamar rawat inap secara real-time</p>
        </div>
        
        <?php echo $message; ?>
        
        <!-- Stats -->
        <div class="room-stats">
            <?php
            $total_kamar = count($rooms);
            $total_kapasitas = array_sum(array_column($rooms, 'kapasitas'));
            $total_terpakai = array_sum(array_column($rooms, 'terpakai'));
            $total_tersedia = $total_kapasitas - $total_terpakai;
            $full_count = count(array_filter($rooms, fn($r) => $r['status'] === 'full'));
            $maint_count = count(array_filter($rooms, fn($r) => $r['status'] === 'maintenance'));
            ?>
            <div class="stat-card">
                <div class="stat-icon total"><i class="fas fa-door-open"></i></div>
                <div class="stat-info">
                    <h3><?php echo $total_kamar; ?></h3>
                    <p>Total Kamar</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon occupied"><i class="fas fa-bed"></i></div>
                <div class="stat-info">
                    <h3><?php echo $total_terpakai; ?>/<?php echo $total_kapasitas; ?></h3>
                    <p>Tempat Tidur Terpakai</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon available"><i class="fas fa-check-circle"></i></div>
                <div class="stat-info">
                    <h3><?php echo $total_tersedia; ?></h3>
                    <p>Tempat Tidur Tersedia</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon maintenance"><i class="fas fa-tools"></i></div>
                <div class="stat-info">
                    <h3><?php echo $full_count + $maint_count; ?></h3>
                    <p>Kamar Penuh/Maintenance</p>
                </div>
            </div>
        </div>
        
        <!-- Room Management Form -->
        <form method="POST" id="kamarForm">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bed"></i> Daftar Kamar
                    </h3>
                    <button type="submit" class="btn btn-primary" name="action" value="batch">
                        <i class="fas fa-save"></i> Simpan Semua Perubahan
                    </button>
                </div>
                
                <div style="overflow-x: auto;">
                    <table class="room-table">
                        <thead>
                            <tr>
                                <th>No. Kamar</th>
                                <th>Lantai</th>
                                <th>Kelas</th>
                                <th>Kapasitas</th>
                                <th>Terpakai</th>
                                <th>Tersedia</th>
                                <th>Status</th>
                                <th>Tarif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rooms as $room): 
                                $tersedia = $room['kapasitas'] - $room['terpakai'];
                                $class_slug = strtolower(str_replace(' ', '', $room['kelas']));
                            ?>
                            <tr>
                                <td><span class="room-number"><?php echo htmlspecialchars($room['nomor']); ?></span></td>
                                <td>Lantai <?php echo $room['lantai']; ?></td>
                                <td><span class="room-class <?php echo $class_slug; ?>"><?php echo htmlspecialchars($room['kelas']); ?></span></td>
                                <td><?php echo $room['kapasitas']; ?> TT</td>
                                <td>
                                    <input type="number" class="form-control" name="rooms[<?php echo $room['id']; ?>][terpakai]" value="<?php echo $room['terpakai']; ?>" min="0" max="<?php echo $room['kapasitas']; ?>" style="width: 80px;">
                                </td>
                                <td><span class="capacity-info"><strong><?php echo $tersedia; ?></strong> TT</span></td>
                                <td>
                                    <select class="form-select" name="rooms[<?php echo $room['id']; ?>][status]">
                                        <option value="available" <?php echo $room['status'] === 'available' ? 'selected' : ''; ?>>Tersedia</option>
                                        <option value="full" <?php echo $room['status'] === 'full' ? 'selected' : ''; ?>>Penuh</option>
                                        <option value="maintenance" <?php echo $room['status'] === 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                                    </select>
                                </td>
                                <td>Rp <?php echo number_format($room['tarif'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        
        <!-- Info -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> Informasi
                </h3>
            </div>
            <div style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.8;">
                <p><i class="fas fa-circle" style="color: var(--success); font-size: 8px; vertical-align: middle; margin-right: 8px;"></i> <strong>Tersedia:</strong> Kamar dengan tempat tidur masih kosong</p>
                <p><i class="fas fa-circle" style="color: var(--danger); font-size: 8px; vertical-align: middle; margin-right: 8px;"></i> <strong>Penuh:</strong> Semua tempat tidur terisi</p>
                <p><i class="fas fa-circle" style="color: var(--warning); font-size: 8px; vertical-align: middle; margin-right: 8px;"></i> <strong>Maintenance:</strong> Kamar sedang dalam perbaikan</p>
            </div>
        </div>
    </main>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
        
        // Auto-calculate available beds
        document.querySelectorAll('input[name^="rooms"]').forEach(input => {
            input.addEventListener('change', function() {
                const row = this.closest('tr');
                const kapasitas = parseInt(row.querySelector('td:nth-child(4)').textContent);
                const terpakai = parseInt(this.value);
                const tersediaCell = row.querySelector('td:nth-child(6) strong');
                if (tersediaCell) {
                    tersediaCell.textContent = Math.max(0, kapasitas - terpakai) + ' TT';
                }
            });
        });
    </script>
</body>
</html>
