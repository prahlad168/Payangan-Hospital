<?php
/**
 * Header/Navbar Component - RS Payangan Hospital
 */

$current_user = get_current_user();
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Dashboard'; ?> - RS Payangan Hospital</title>
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
            line-height: 1.6;
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
        
        .logo-area img {
            height: 45px;
        }
        
        .logo-text {
            display: flex;
            flex-direction: column;
        }
        
        .logo-text strong {
            font-size: 1.1rem;
            color: var(--primary);
            line-height: 1.2;
        }
        
        .logo-text span {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.3rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .sidebar-toggle:hover {
            background: var(--bg-light);
        }
        
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
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
            transition: all 0.3s;
        }
        
        .navbar-icon:hover {
            background: var(--bg-light);
            color: var(--primary);
        }
        
        .navbar-icon .badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background: var(--danger);
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 50%;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 15px;
            background: var(--bg-light);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .user-menu:hover {
            background: #e9ecef;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-info .name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-dark);
        }
        
        .user-info .role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        
        .user-dropdown {
            position: relative;
        }
        
        .dropdown-content {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            min-width: 200px;
            padding: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .user-dropdown:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .dropdown-item:hover {
            background: var(--bg-light);
        }
        
        .dropdown-item.danger {
            color: var(--danger);
        }
        
        .dropdown-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 5px 0;
        }
        
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
            transition: transform 0.3s;
        }
        
        .sidebar.collapsed {
            transform: translateX(-100%);
        }
        
        .sidebar-menu {
            padding: 20px 15px;
        }
        
        .sidebar-section {
            margin-bottom: 25px;
        }
        
        .sidebar-section-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 15px;
            margin-bottom: 10px;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.3s;
            margin-bottom: 5px;
        }
        
        .sidebar-link:hover {
            background: var(--bg-light);
            color: var(--primary);
        }
        
        .sidebar-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
        }
        
        .sidebar-link i {
            width: 20px;
            text-align: center;
        }
        
        .sidebar-link .badge {
            margin-left: auto;
            background: var(--danger);
            color: white;
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 20px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 30px;
            min-height: calc(100vh - 70px);
            transition: margin-left 0.3s;
        }
        
        .main-content.expanded {
            margin-left: 0;
        }
        
        /* Page Header */
        .page-header {
            margin-bottom: 30px;
        }
        
        .page-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }
        
        .page-header .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        
        .page-header .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }
        
        /* Cards */
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
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        /* Mobile Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .user-info {
                display: none;
            }
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
    <!-- Top Navbar -->
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
            
            <button class="navbar-icon">
                <i class="fas fa-envelope"></i>
            </button>
            
            <div class="user-dropdown">
                <div class="user-menu">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($current_user['nama'] ?? 'U', 0, 1)); ?>
                    </div>
                    <div class="user-info">
                        <span class="name"><?php echo htmlspecialchars($current_user['nama'] ?? 'User'); ?></span>
                        <span class="role"><?php echo get_role_display($current_user['role'] ?? 'user'); ?></span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem; color: var(--text-muted);"></i>
                </div>
                <div class="dropdown-content">
                    <a href="profile.php" class="dropdown-item">
                        <i class="fas fa-user"></i> Profil Saya
                    </a>
                    <a href="settings.php" class="dropdown-item">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-menu">
            <div class="sidebar-section">
                <div class="sidebar-section-title">Menu Utama</div>
                <a href="dashboard.php" class="sidebar-link <?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="#" class="sidebar-link">
                    <i class="fas fa-clipboard"></i> Laporan
                    <span class="badge">New</span>
                </a>
            </div>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">Manajemen</div>
                <a href="dokter.php" class="sidebar-link <?php echo ($current_page == 'dokter') ? 'active' : ''; ?>">
                    <i class="fas fa-user-md"></i> Data Dokter
                </a>
                <a href="poli.php" class="sidebar-link <?php echo ($current_page == 'poli') ? 'active' : ''; ?>">
                    <i class="fas fa-stethoscope"></i> Data Poli
                </a>
                <a href="pasien.php" class="sidebar-link <?php echo ($current_page == 'pasien') ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i> Data Pasien
                </a>
                <a href="kamar.php" class="sidebar-link <?php echo ($current_page == 'kamar') ? 'active' : ''; ?>">
                    <i class="fas fa-bed"></i> Kamar Inap
                </a>
            </div>
            
            <div class="sidebar-section">
                <div class="sidebar-section-title">Layanan</div>
                <a href="antrean.php" class="sidebar-link <?php echo ($current_page == 'antrean') ? 'active' : ''; ?>">
                    <i class="fas fa-clipboard-list"></i> Antrean
                </a>
                <a href="igd.php" class="sidebar-link <?php echo ($current_page == 'igd') ? 'active' : ''; ?>">
                    <i class="fas fa-ambulance"></i> IGD
                </a>
                <a href="rawat-inap.php" class="sidebar-link <?php echo ($current_page == 'rawat-inap') ? 'active' : ''; ?>">
                    <i class="fas fa-procedures"></i> Rawat Inap
                </a>
            </div>
            
            <?php if (has_role(['direktur', 'admin'])): ?>
            <div class="sidebar-section">
                <div class="sidebar-section-title">Administrsi</div>
                <a href="users.php" class="sidebar-link <?php echo ($current_page == 'users') ? 'active' : ''; ?>">
                    <i class="fas fa-user-cog"></i> Manajemen User
                </a>
                <a href="pengaturan.php" class="sidebar-link <?php echo ($current_page == 'pengaturan') ? 'active' : ''; ?>">
                    <i class="fas fa-cogs"></i> Pengaturan
                </a>
                <a href="log-aktivitas.php" class="sidebar-link <?php echo ($current_page == 'log-aktivitas') ? 'active' : ''; ?>">
                    <i class="fas fa-history"></i> Log Aktivitas
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
    <main class="main-content" id="mainContent">
</body>
</html>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('expanded');
    }
</script>
