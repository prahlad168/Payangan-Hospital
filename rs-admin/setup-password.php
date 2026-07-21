<?php
/**
 * RS Payangan Hospital - Password Hash Generator & Setup
 * =====================================================
 * 
 * INSTRUKSI PENGGUNAAN:
 * 1. Upload file ini ke hosting via cPanel File Manager
 * 2. Buka di browser: https://payanganhospital.gianyarkab.go.id/rs-admin/setup-password.php
 * 3. Copy SQL queries yang ditampilkan
 * 4. Buka phpMyAdmin dan jalankan query SQL
 * 5. HAPUS FILE INI setelah selesai untuk keamanan!
 * 
 * Created by: OpenHands AI Agent
 * Date: 2026-07-21
 */

echo "============================================================\n";
echo "   RS PAYANGAN HOSPITAL - PASSWORD SETUP SCRIPT\n";
echo "============================================================\n\n";

$passwords = [
    'direktur' => 'welcomehome',
    'admin' => 'admin123',
    'karyawan' => 'staf2026'
];

echo "📋 Default User Credentials:\n";
echo str_repeat("-", 55) . "\n";

foreach ($passwords as $username => $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "\n";
    echo "👤 Username: {$username}\n";
    echo "🔑 Password: {$password}\n";
    echo "🔐 Hash: {$hash}\n";
    echo str_repeat("-", 55) . "\n";
}

echo "\n";
echo "============================================================\n";
echo "   SQL UPDATE QUERIES FOR phpMyAdmin\n";
echo "============================================================\n\n";
echo "Copy dan jalankan query SQL berikut di phpMyAdmin:\n\n";

foreach ($passwords as $username => $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $hash_escaped = str_replace("'", "''", $hash);
    echo "-- Update password untuk {$username}\n";
    echo "UPDATE users SET password = '{$hash_escaped}' WHERE username = '{$username}';\n\n";
}

echo "\n============================================================\n";
echo "⚠️  PERINGATAN KEAMANAN\n";
echo "============================================================\n\n";
echo "SETELAH MENJALANKAN QUERY SQL DI ATAS:\n";
echo "1. ✅ HAPUS FILE INI DARI SERVER!\n";
echo "2. ✅ Verifikasi login berfungsi\n";
echo "3. ✅ Ganti password secara berkala\n\n";
