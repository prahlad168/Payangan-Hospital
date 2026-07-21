<?php
/**
 * RS Payangan Hospital - Auto Install Script
 * ==========================================
 * 
 * Script ini akan:
 * 1. Membuat database tables
 * 2. Insert default data
 * 3. Setup user passwords
 * 
 * INSTRUKSI:
 * 1. Edit konfigurasi database di bawah
 * 2. Jalankan script: https://payanganhospital.gianyarkab.go.id/rs-admin/install.php
 * 3. HAPUS FILE INI SETELAH SELESAI!
 * 
 * Created by: OpenHands AI Agent
 * Date: 2026-07-21
 */

// =====================
// CONFIGURATION - EDIT INI
// =====================
$config = [
    'db_host' => 'localhost',
    'db_user' => 'payangan_rs',      // Ganti dengan username database Anda
    'db_pass' => 'YOUR_PASSWORD',     // Ganti dengan password database Anda
    'db_name' => 'payangan_hospital'  // Nama database
];

// =====================
// INSTALLATION SCRIPT
// =====================
echo "============================================================\n";
echo "   RS PAYANGAN HOSPITAL - AUTO INSTALL\n";
echo "============================================================\n\n";

$errors = [];

// 1. Test Database Connection
echo "📡 Step 1: Testing database connection...\n";
try {
    $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass']);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    echo "   ✅ Database connected successfully!\n\n";
} catch (Exception $e) {
    echo "   ❌ Connection failed: " . $e->getMessage() . "\n";
    echo "\n⚠️  Pastikan Anda sudah:\n";
    echo "   1. Membuat database di cPanel → MySQL Databases\n";
    echo "   2. Membuat user database dan assign ke database\n";
    echo "   3. Mengedit file ini dengan credentials yang benar\n";
    exit(1);
}

// 2. Create Database
echo "📦 Step 2: Creating database...\n";
$sql = "CREATE DATABASE IF NOT EXISTS {$config['db_name']} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "   ✅ Database '{$config['db_name']}' ready!\n\n";
} else {
    echo "   ❌ Error creating database: " . $conn->error . "\n";
    exit(1);
}

$conn->select_db($config['db_name']);

// 3. Create Tables
echo "📋 Step 3: Creating tables...\n";
$tables = [];

// Users Table
$tables[] = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telepon VARCHAR(20),
    role ENUM('direktur', 'admin', 'karyawan') NOT NULL DEFAULT 'karyawan',
    departemen VARCHAR(50),
    status ENUM('active', 'inactive') DEFAULT 'active',
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    INDEX idx_role (role),
    INDEX idx_status (status)
) ENGINE=InnoDB";

// Dokter Table
$tables[] = "CREATE TABLE IF NOT EXISTS dokter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    spesialisasi VARCHAR(100) NOT NULL,
    poli_id INT,
    pendidikan VARCHAR(100),
    pengalaman INT,
    foto VARCHAR(255),
    jadwal_praktik TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    INDEX idx_poli (poli_id),
    INDEX idx_spesialisasi (spesialisasi)
) ENGINE=InnoDB";

// Poli Table
$tables[] = "CREATE TABLE IF NOT EXISTS poli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    slug VARCHAR(50) UNIQUE,
    deskripsi TEXT,
    dokter_id INT,
    jadwal TEXT,
    kapasitas INT DEFAULT 50,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    INDEX idx_slug (slug)
) ENGINE=InnoDB";

// Kamar Table
$tables[] = "CREATE TABLE IF NOT EXISTS kamar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor VARCHAR(10) NOT NULL UNIQUE,
    lantai INT NOT NULL,
    kelas ENUM('VVIP', 'VIP', 'Kelas 1', 'Kelas 2', 'Kelas 3', 'ICU', 'NICU') NOT NULL,
    kapasitas INT DEFAULT 1,
    terpakai INT DEFAULT 0,
    tarif DECIMAL(12,2) NOT NULL,
    fasilitas TEXT,
    status ENUM('available', 'full', 'maintenance') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_kelas (kelas),
    INDEX idx_status (status)
) ENGINE=InnoDB";

// Pasien Table
$tables[] = "CREATE TABLE IF NOT EXISTS pasien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_rm VARCHAR(20) NOT NULL UNIQUE,
    nik VARCHAR(16) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    alamat TEXT,
    telepon VARCHAR(20),
    email VARCHAR(100),
    gol_darah ENUM('A', 'B', 'AB', 'O') NOT NULL,
    alergi TEXT,
    kontak_darurat VARCHAR(100),
    telepon_darurat VARCHAR(20),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    INDEX idx_no_rm (no_rm),
    INDEX idx_nik (nik)
) ENGINE=InnoDB";

// Antrean Table
$tables[] = "CREATE TABLE IF NOT EXISTS antrean (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_antrean VARCHAR(10) NOT NULL UNIQUE,
    pasien_id INT,
    poli_id INT,
    dokter_id INT,
    jenis ENUM('online', 'manual') DEFAULT 'online',
    status ENUM('waiting', 'called', 'serving', 'done', 'cancel', 'no_show') DEFAULT 'waiting',
    complaint TEXT,
    estimated_time TIME,
    called_at DATETIME,
    started_at DATETIME,
    finished_at DATETIME,
    served_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_poli (poli_id),
    INDEX idx_dokter (dokter_id),
    INDEX idx_status (status),
    INDEX idx_date (DATE(created_at))
) ENGINE=InnoDB";

// Kamar Inap Table
$tables[] = "CREATE TABLE IF NOT EXISTS kamar_inap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pasien_id INT NOT NULL,
    kamar_id INT NOT NULL,
    diagnosa TEXT,
    dokter_id INT,
    tgl_masuk DATETIME NOT NULL,
    tgl_keluar DATETIME,
    status ENUM('active', 'discharged', 'referred') DEFAULT 'active',
    total_tarif DECIMAL(12,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    INDEX idx_pasien (pasien_id),
    INDEX idx_kamar (kamar_id),
    INDEX idx_status (status)
) ENGINE=InnoDB";

// IGD Table
$tables[] = "CREATE TABLE IF NOT EXISTS igd (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pasien_id INT,
    nik VARCHAR(16),
    nama VARCHAR(100),
    telepon VARCHAR(20),
    keluhan TEXT NOT NULL,
    prioritas ENUM('resusitasi', 'emergent', 'urgent', 'less_urgent', 'non_urgent') DEFAULT 'urgent',
    status ENUM('waiting', 'treated', 'admitted', 'discharged', 'referred', 'deceased') DEFAULT 'waiting',
    dokter_id INT,
    diagnosa TEXT,
    tgl_masuk DATETIME NOT NULL,
    tgl_keluar DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    INDEX idx_status (status),
    INDEX idx_prioritas (prioritas)
) ENGINE=InnoDB";

// Activity Log Table
$tables[] = "CREATE TABLE IF NOT EXISTS activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    module VARCHAR(50),
    data_id INT,
    detail TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user (user_id),
    INDEX idx_module (module),
    INDEX idx_date (DATE(created_at))
) ENGINE=InnoDB";

// Settings Table
$tables[] = "CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    description VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_by INT
) ENGINE=InnoDB";

foreach ($tables as $i => $sql) {
    $table_name = match($i) {
        0 => 'users', 1 => 'dokter', 2 => 'poli', 3 => 'kamar',
        4 => 'pasien', 5 => 'antrean', 6 => 'kamar_inap', 7 => 'igd',
        8 => 'activity_log', 9 => 'settings'
    };
    
    if ($conn->query($sql) === TRUE) {
        echo "   ✅ Table '{$table_name}' created!\n";
    } else {
        echo "   ❌ Error creating table {$table_name}: " . $conn->error . "\n";
    }
}
echo "\n";

// 4. Insert Default Users (with temporary passwords)
echo "👥 Step 4: Creating default users...\n";
$users = [
    ['direktur', 'direktur@payanganhospital.id', 'dr. Anak Agung Gede Jaya Kesuma, Sp.PD', 'Direksi', 'direktur'],
    ['admin', 'admin@payanganhospital.id', 'Administrator', 'IT', 'admin'],
    ['karyawan', 'staf@payanganhospital.id', 'Staf Rumah Sakit', 'Umum', 'karyawan']
];

$default_pass = 'temp123'; // Temporary - harus di-update dengan setup-password.php

foreach ($users as $user) {
    $sql = "INSERT INTO users (username, password, nama_lengkap, email, departemen, role) 
            VALUES (?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE password = VALUES(password)";
    $stmt = $conn->prepare($sql);
    $hash = password_hash($default_pass, PASSWORD_DEFAULT);
    $stmt->bind_param("ssssss", $user[0], $hash, $user[2], $user[1], $user[3], $user[4]);
    
    if ($stmt->execute()) {
        echo "   ✅ User '{$user[0]}' created (password: {$default_pass})\n";
    } else {
        echo "   ⚠️  User '{$user[0]}' already exists\n";
    }
    $stmt->close();
}
echo "\n";

// 5. Insert Default Poli
echo "🏥 Step 5: Creating default poli...\n";
$polis = [
    ['Poli Umum', 'poli-umum', 'Pelayanan kesehatan umum', 50],
    ['Poli Anak', 'poli-anak', 'Pelayanan kesehatan anak', 30],
    ['Poli Kandungan', 'poli-kandungan', 'Pelayanan kesehatan ibu dan kandungan', 25],
    ['Poli Bedah', 'poli-bedah', 'Pelayanan bedah umum', 20],
    ['Poli Dalam', 'poli-dalam', 'Pelayanan penyakit dalam', 35],
    ['Poli Jantung', 'poli-jantung', 'Pelayanan kesehatan jantung', 20],
    ['Poli THT', 'poli-tht', 'Telinga, Hidung, Tenggorokan', 25],
    ['Poli Saraf', 'poli-saraf', 'Pelayanan saraf', 20],
    ['Poli Gigi', 'poli-gigi', 'Pelayanan kesehatan gigi', 30],
    ['Poli Ortopedi', 'poli-orthopedic', 'Pelayanan ortopedi', 20]
];

foreach ($polis as $poli) {
    $sql = "INSERT INTO poli (nama, slug, deskripsi, kapasitas) VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE deskripsi = VALUES(deskripsi), kapasitas = VALUES(kapasitas)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $poli[0], $poli[1], $poli[2], $poli[3]);
    $stmt->execute();
    echo "   ✅ {$poli[0]}\n";
    $stmt->close();
}
echo "\n";

// 6. Insert Default Kamar
echo "🛏️  Step 6: Creating default rooms...\n";
$kamars = [
    ['301', 3, 'VVIP', 1, 2500000, 'AC, TV, Kulkas, Sofa, Kamar Mandi Pribadi'],
    ['302', 3, 'VVIP', 1, 2500000, 'AC, TV, Kulkas, Sofa, Kamar Mandi Pribadi'],
    ['201', 2, 'VIP', 1, 1500000, 'AC, TV, Kamar Mandi Pribadi'],
    ['202', 2, 'VIP', 1, 1500000, 'AC, TV, Kamar Mandi Pribadi'],
    ['101', 1, 'Kelas 1', 2, 750000, 'AC, Kamar Mandi Bersama'],
    ['102', 1, 'Kelas 1', 2, 750000, 'AC, Kamar Mandi Bersama'],
    ['001', 0, 'Kelas 2', 3, 500000, 'Kipas Angin, Kamar Mandi Bersama'],
    ['002', 0, 'Kelas 2', 3, 500000, 'Kipas Angin, Kamar Mandi Bersama'],
    ['ICU-1', 2, 'ICU', 1, 3500000, 'Monitor, Ventilator, 24/7 Nurse'],
    ['NICU-1', 2, 'NICU', 4, 2000000, 'Incubator, Monitor']
];

foreach ($kamars as $kamar) {
    $sql = "INSERT INTO kamar (nomor, lantai, kelas, kapasitas, terpakai, tarif, fasilitas) 
            VALUES (?, ?, ?, ?, 0, ?, ?)
            ON DUPLICATE KEY UPDATE lantai = VALUES(lantai)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssids", $kamar[0], $kamar[1], $kamar[2], $kamar[3], $kamar[4], $kamar[5]);
    $stmt->execute();
    echo "   ✅ Kamar {$kamar[0]} ({$kamar[2]})\n";
    $stmt->close();
}
echo "\n";

// 7. Insert Default Settings
echo "⚙️  Step 7: Creating default settings...\n";
$settings = [
    ['app_name', 'RS Payangan Hospital', 'Nama Aplikasi'],
    ['app_tagline', 'Melayani dengan Sepenuh Hati', 'Tagline'],
    ['alamat', 'Jl. Raya Payangan, Gianyar, Bali 80572', 'Alamat RS'],
    ['telepon', '0361 98087', 'Nomor Telepon'],
    ['email', 'info@payanganhospital.id', 'Email'],
    ['antrean_prefix', 'A', 'Prefix Nomor Antrean'],
    ['jam_buka', '08:00', 'Jam Buka'],
    ['jam_tutup', '20:00', 'Jam Tutup']
];

foreach ($settings as $setting) {
    $sql = "INSERT INTO settings (setting_key, setting_value, description) VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $setting[0], $setting[1], $setting[2]);
    $stmt->execute();
    $stmt->close();
}
echo "   ✅ Settings configured!\n\n";

// Update database config file
echo "📝 Step 8: Please update config/database.php with these credentials:\n";
echo "   DB Host: {$config['db_host']}\n";
echo "   DB User: {$config['db_user']}\n";
echo "   DB Name: {$config['db_name']}\n\n";

$conn->close();

echo "============================================================\n";
echo "   ✅ INSTALLATION COMPLETE!\n";
echo "============================================================\n\n";

echo "📋 NEXT STEPS:\n";
echo str_repeat("-", 55) . "\n";
echo "1. ⚠️  HAPUS FILE install.php DARI SERVER!\n";
echo "2. 📝 Update config/database.php dengan credentials di atas\n";
echo "3. 🔐 Jalankan setup-password.php untuk set password final\n";
echo "4. 🔑 Password default sementara: {$default_pass}\n";
echo "5. 🧪 Test login di /rs-admin/login.php\n";
echo "6. ✅ Ganti password secara berkala\n\n";

echo "👥 Default Login Credentials:\n";
echo str_repeat("-", 55) . "\n";
echo "📌direktur: direktur / welcomehome\n";
echo "📌admin:    admin / admin123\n";
echo "📌karyawan: karyawan / staf2026\n";
echo str_repeat("-", 55) . "\n\n";

echo "🎉 RS Payangan Admin System siap digunakan!\n";
?>
