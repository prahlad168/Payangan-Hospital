<?php
/**
 * Login Page - RS Payangan Hospital
 * Backend Administration System
 */

session_start();

// Check if already logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$success = '';

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi!';
    } else {
        // Simple authentication (demo mode - tanpa database)
        // Untuk production, gunakan database dengan password_hash()
        
        // Demo users (dalam production, ini dari database)
        $demo_users = [
            'direktur' => [
                'password' => 'welcomehome',
                'nama' => 'dr. Anak Agung Gede Jaya Kesuma, Sp.PD',
                'role' => 'direktur',
                'email' => 'direktur@payanganhospital.id'
            ],
            'admin' => [
                'password' => 'admin123',
                'nama' => 'Administrator Sistem',
                'role' => 'admin',
                'email' => 'admin@payanganhospital.id'
            ],
            'karyawan' => [
                'password' => 'staf2026',
                'nama' => 'Staf Rumah Sakit',
                'role' => 'karyawan',
                'email' => 'staf@payanganhospital.id'
            ]
        ];
        
        if (isset($demo_users[$username]) && $demo_users[$username]['password'] === $password) {
            // Login berhasil
            $_SESSION['user_id'] = $username;
            $_SESSION['username'] = $username;
            $_SESSION['nama'] = $demo_users[$username]['nama'];
            $_SESSION['role'] = $demo_users[$username]['role'];
            $_SESSION['email'] = $demo_users[$username]['email'];
            $_SESSION['login_time'] = time();
            $_SESSION['last_activity'] = time();
            
            // Redirect berdasarkan role
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Username atau password salah!';
        }
    }
}

// Check for timeout message
if (isset($_GET['timeout'])) {
    $error = 'Sesi telah berakhir. Silakan login kembali.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RS Payangan Hospital</title>
    <link rel="icon" type="image/png" href="../img/logo-official.png">
    <link rel="icon" type="image/png" href="../img/logo-official.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a5f5a;
            --primary-dark: #0f3d3a;
            --secondary: #c9a86c;
            --bg-light: #f8fafc;
            --text-dark: #2c3e3c;
            --text-muted: #6c757d;
            --danger: #ef4444;
            --success: #10b981;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background: white;
            border-radius: 24px;
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.3);
            text-align: center;
        }
        
        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 30px;
        }
        
        .hospital-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }
        
        .hospital-icon i {
            font-size: 36px;
            color: white;
        }
        
        .login-container h1 {
            font-size: 1.8rem;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        
        .login-container .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 35px;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }
        
        input {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(26, 95, 90, 0.1);
        }
        
        input.error {
            border-color: var(--danger);
            animation: shake 0.5s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-muted);
            transition: color 0.3s;
            background: none;
            border: none;
            padding: 0;
        }
        
        .toggle-password:hover {
            color: var(--primary);
        }
        
        .btn-login {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(26, 95, 90, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            padding: 14px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-top: 20px;
            display: none;
        }
        
        .error-message.show {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .success-message {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 14px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-top: 20px;
            display: none;
        }
        
        .success-message.show {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .footer-note {
            margin-top: 30px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }
        
        .footer-note a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .back-link {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        
        .back-link a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s;
        }
        
        .back-link a:hover {
            color: var(--primary);
        }
        
        .demo-accounts {
            margin-top: 25px;
            padding: 15px;
            background: var(--bg-light);
            border-radius: 12px;
            text-align: left;
        }
        
        .demo-accounts h4 {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }
        
        .demo-account {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.85rem;
        }
        
        .demo-account:last-child {
            border-bottom: none;
        }
        
        .demo-account .role {
            background: var(--primary);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
        }
        
        .demo-account .role.direktur {
            background: var(--secondary);
            color: var(--text-dark);
        }
        
        .demo-account .role.admin {
            background: var(--primary);
        }
        
        .demo-account .role.karyawan {
            background: #6c757d;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 40px 25px;
            }
            
            .login-container h1 {
                font-size: 1.5rem;
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

    <div class="login-container">
        <!-- Logo with shimmer animation -->
        <div class="logo-shimmer-wrap">
            <img src="../img/logo-official.png" alt="Logo Payangan Hospital" class="logo">
        </div>
        
        <div class="hospital-icon">
            <i class="fas fa-hospital"></i>
        </div>
        
        <h1>Sistem Admin RS</h1>
        <p class="subtitle">Masukkan username dan password untuk masuk</p>
        
        <?php if ($error): ?>
        <div class="error-message show">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
        <div class="success-message show">
            <i class="fas fa-check-circle"></i>
            <span><?php echo htmlspecialchars($success); ?></span>
        </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required autofocus>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>
        
        <div class="demo-accounts">
            <h4><i class="fas fa-info-circle"></i> Demo Account</h4>
            <div class="demo-account">
                <span><strong>direktur</strong> / welcomehome</span>
                <span class="role direktur">Direktur</span>
            </div>
            <div class="demo-account">
                <span><strong>admin</strong> / admin123</span>
                <span class="role admin">Admin</span>
            </div>
            <div class="demo-account">
                <span><strong>karyawan</strong> / staf2026</span>
                <span class="role karyawan">Karyawan</span>
            </div>
        </div>
        
        <div class="back-link">
            <a href="../index.html">
                <i class="fas fa-arrow-left"></i> Kembali ke Website
            </a>
        </div>
        
        <p class="footer-note">
            <i class="fas fa-shield-alt"></i> RS Payangan Hospital © 2026
        </p>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        }
    </script>

</body>
</html>
