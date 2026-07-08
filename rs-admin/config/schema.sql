-- ================================================
-- DATABASE SCHEMA - RS PAYANGAN HOSPITAL
-- ================================================

-- Buat database
CREATE DATABASE IF NOT EXISTS payangan_hospital CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE payangan_hospital;

-- ================================================
-- TABLE: users (User Management)
-- ================================================
CREATE TABLE IF NOT EXISTS users (
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
) ENGINE=InnoDB;

-- ================================================
-- TABLE: dokter (Data Dokter)
-- ================================================
CREATE TABLE IF NOT EXISTS dokter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    spesialisasi VARCHAR(100) NOT NULL,
    poli_id INT,
    pendidikan VARCHAR(100),
    pengalaman INT COMMENT 'Tahun pengalaman',
    foto VARCHAR(255),
    jadwal_praktik TEXT COMMENT 'JSON: {"senin":"08:00-14:00","selasa":"08:00-14:00",...}',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    INDEX idx_poli (poli_id),
    INDEX idx_spesialisasi (spesialisasi)
) ENGINE=InnoDB;

-- ================================================
-- TABLE: poli (Poli Spesialis)
-- ================================================
CREATE TABLE IF NOT EXISTS poli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    slug VARCHAR(50) UNIQUE,
    deskripsi TEXT,
    dokter_id INT,
    jadwal TEXT COMMENT 'JSON format',
    kapasitas INT DEFAULT 50,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    INDEX idx_slug (slug)
) ENGINE=InnoDB;

-- ================================================
-- TABLE: kamar (Kamar Rawat Inap)
-- ================================================
CREATE TABLE IF NOT EXISTS kamar (
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
) ENGINE=InnoDB;

-- ================================================
-- TABLE: pasien (Data Pasien)
-- ================================================
CREATE TABLE IF NOT EXISTS pasien (
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
) ENGINE=InnoDB;

-- ================================================
-- TABLE: antrean (Sistem Antrean)
-- ================================================
CREATE TABLE IF NOT EXISTS antrean (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_antrean VARCHAR(10) NOT NULL UNIQUE,
    pasien_id INT,
    poli_id INT,
    dokter_id INT,
    jenis ENUM('online', 'manual') DEFAULT 'online',
    status ENUM('waiting', 'called', 'serving', 'done', 'cancel', 'no_show') DEFAULT 'waiting',
    complaint TEXT COMMENT 'Keluhan',
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
) ENGINE=InnoDB;

-- ================================================
-- TABLE: kamar_inap (Rawat Inap)
-- ================================================
CREATE TABLE IF NOT EXISTS kamar_inap (
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
) ENGINE=InnoDB;

-- ================================================
-- TABLE: igd (IGD / Emergency)
-- ================================================
CREATE TABLE IF NOT EXISTS igd (
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
) ENGINE=InnoDB;

-- ================================================
-- TABLE: activity_log (Log Aktivitas)
-- ================================================
CREATE TABLE IF NOT EXISTS activity_log (
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
) ENGINE=InnoDB;

-- ================================================
-- TABLE: settings (Pengaturan)
-- ================================================
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    description VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_by INT
) ENGINE=InnoDB;

-- ================================================
-- INSERT DEFAULT USERS
-- ================================================
INSERT INTO users (username, password, nama_lengkap, email, role, departemen) VALUES
('direktur', '$2y$10$YourHashedPasswordHere', 'dr. Anak Agung Gede Jaya Kesuma, Sp.PD', 'direktur@payanganhospital.id', 'direktur', 'Direksi'),
('admin', '$2y$10$YourHashedPasswordHere', 'Administrator', 'admin@payanganhospital.id', 'admin', 'IT'),
('karyawan', '$2y$10$YourHashedPasswordHere', 'Staf Rumah Sakit', 'staf@payanganhospital.id', 'karyawan', 'Umum');

-- ================================================
-- INSERT SAMPLE DATA POLI
-- ================================================
INSERT INTO poli (nama, slug, deskripsi, kapasitas) VALUES
('Poli Umum', 'poli-umum', 'Pelayanan kesehatan umum', 50),
('Poli Anak', 'poli-anak', 'Pelayanan kesehatan anak', 30),
('Poli Kandungan', 'poli-kandungan', 'Pelayanan kesehatan ibu dan kandungan', 25),
('Poli Bedah', 'poli-bedah', 'Pelayanan bedah umum', 20),
('Poli Dalam', 'poli-dalam', 'Pelayanan penyakit dalam', 35),
('Poli Jantung', 'poli-jantung', 'Pelayanan kesehatan jantung', 20),
('Poli THT', 'poli-tht', 'Telinga, Hidung, Tenggorokan', 25),
('Poli Saraf', 'poli-saraf', 'Pelayanan saraf', 20),
('Poli Gigi', 'poli-gigi', 'Pelayanan kesehatan gigi', 30),
('Poli Ortopedi', 'poli-orthopedic', 'Pelayanan ortopedi', 20);

-- ================================================
-- INSERT SAMPLE DATA KAMAR
-- ================================================
INSERT INTO kamar (nomor, lantai, kelas, kapasitas, terpakai, tarif, fasilitas) VALUES
('301', 3, 'VVIP', 1, 0, 2500000, 'AC, TV, Kulkas, Sofa, Kamar Mandi Pribadi'),
('302', 3, 'VVIP', 1, 0, 2500000, 'AC, TV, Kulkas, Sofa, Kamar Mandi Pribadi'),
('201', 2, 'VIP', 1, 0, 1500000, 'AC, TV, Kamar Mandi Pribadi'),
('202', 2, 'VIP', 1, 0, 1500000, 'AC, TV, Kamar Mandi Pribadi'),
('101', 1, 'Kelas 1', 2, 0, 750000, 'AC, Kamar Mandi Bersama'),
('102', 1, 'Kelas 1', 2, 0, 750000, 'AC, Kamar Mandi Bersama'),
('001', 0, 'Kelas 2', 3, 0, 500000, 'Kipas Angin, Kamar Mandi Bersama'),
('002', 0, 'Kelas 2', 3, 0, 500000, 'Kipas Angin, Kamar Mandi Bersama'),
('ICU-1', 2, 'ICU', 1, 0, 3500000, 'Monitor, Ventilator, 24/7 Nurse'),
('NICU-1', 2, 'NICU', 4, 0, 2000000, 'Incubator, Monitor');

-- ================================================
-- INSERT DEFAULT SETTINGS
-- ================================================
INSERT INTO settings (setting_key, setting_value, description) VALUES
('app_name', 'RS Payangan Hospital', 'Nama Aplikasi'),
('app_tagline', 'Pavitram Idam Uttamam', 'Tagline'),
('alamat', 'Jl. Raya Payangan, Gianyar, Bali', 'Alamat RS'),
('telepon', '0361 98087', 'Nomor Telepon'),
('email', 'info@payanganhospital.id', 'Email'),
('antrean_prefix', 'A', 'Prefix Nomor Antrean'),
('antrean_daily_reset', '1', 'Reset antrean harian (1=Ya)'),
('max_antrean_per_hari', '200', 'Maksimal antrean per hari'),
('jam_buka', '08:00', 'Jam Buka'),
('jam_tutup', '20:00', 'Jam Tutup');

-- ================================================
-- PASSWORD HASHING NOTE
-- ================================================
-- Ganti password dengan hash yang dihasilkan oleh password_hash()
-- Contoh: password_hash('welcome123', PASSWORD_DEFAULT)
-- Default password: welcome123
