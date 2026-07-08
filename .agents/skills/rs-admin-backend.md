# RS Admin Backend System - Skill Documentation

## Overview
Sistem backend administration untuk RS Payangan Hospital dengan autentikasi multi-level dan role-based access control.

---

## рҹ“Ӣ Quick Info

| Field | Value |
|-------|-------|
| **Folder** | `rs-admin/` |
| **Tech Stack** | PHP 7.4+, MySQL, HTML5/CSS3/JS |
| **Status** | вң… Ready to Deploy |
| **Last Updated** | 2026-07-04 |

---

## рҹ”Ҹ Quick Start

### Login Credentials
```
URL: https://payanganhospital.gianyarkab.go.id/rs-admin/login.php

| Role      | Username  | Password    |
|-----------|-----------|-------------|
| Direktur  | direktur  | welcomehome |
| Admin    | admin     | admin123    |
| Karyawan | karyawan  | staf2026    |
```

---

## рҹ“Ғ File Structure

```
rs-admin/
рӣ• config/
рӣӮ   в”Ӯ   database.php       # Konfigurasi MySQL
рӣӮ   в”Ӯ   schema.sql         # 8 tabel database
рӣӮ
рӣӮ   includes/
рӣӮ   в”Ӯ   auth.php           # Auth helpers (require_login, require_role)
рӣӮ   в”Ӯ   header.php        # Navbar & Sidebar
рӣӮ   в”Ӯ   footer.php        # Footer scripts
рӣӮ
рӣӮ   login.php              # Halaman login
рӣӮ   logout.php             # Handle logout
рӣӮ   dashboard.php          # Dashboard utama
рӣӮ   dokter.php             # Manajemen dokter
рӣӮ   poli.php              # Manajemen poli
рӣӮ   pasien.php             # Manajemen pasien
рӣӮ   kamar.php             # Manajemen kamar
рӣӮ   antrean.php            # Sistem antrean
рӣӮ   igd.php                # IGD
рӣӮ   users.php              # Manajemen user
рӣӮ   README.md              # Dokumentasi
```

---

## рҹ”Ҹ Features

### 1. Authentication System
```php
// Start session
session_start();

// Check if logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in
}

// Get current user
$nama = $_SESSION['nama'];
$role = $_SESSION['role'];
```

### 2. Role-Based Access Control
```php
// Require specific role
require_role(['direktur', 'admin']);

// Check role
if (has_role('direktur')) {
    // Show director-only content
}
```

### 3. Database Schema (8 Tables)
- `users` - User management
- `dokter` - Data dokter
- `poli` - Data poli spesialis
- `kamar` - Kamar rawat inap
- `pasien` - Data pasien
- `antrean` - Sistem antrean
- `kamar_inap` - Rawat inap
- `igd` - IGD/Emergency
- `activity_log` - Log aktivitas
- `settings` - Pengaturan sistem

---

## рҹ”Ҹ Setup Instructions

### Step 1: Setup MySQL Database
```bash
# Login ke MySQL
mysql -u root -p

# Import schema
source config/schema.sql;
```

### Step 2: Configure Database
Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'payangan_rs');
define('DB_PASS', 'your_password');
define('DB_NAME', 'payangan_hospital');
```

### Step 3: Generate Password Hash (Production)
```php
// Generate hash untuk password baru
echo password_hash('your_password', PASSWORD_DEFAULT);

// Output: $2y$10$xxxxxx...
```

### Step 4: Deploy ke Hosting
```bash
# Clone atau download repository
git clone https://github.com/prahlad168/Payangan-Hospital.git

# Upload folder rs-admin ke hosting
# Pastikan PHP version >= 7.4

# Set permission
chmod 755 rs-admin/
chmod 755 rs-admin/config/
chmod 755 rs-admin/includes/
chmod 755 rs-admin/logs/
```

---

## рҹ“Ҹ API Endpoints

### Users
```
GET  /api/users.php?action=list
POST /api/users.php?action=create
POST /api/users.php?action=update
POST /api/users.php?action=delete
```

### Dokter
```
GET  /api/dokter.php?action=list
POST /api/dokter.php?action=create
POST /api/dokter.php?action=update
```

### Antrean
```
GET  /api/antrean.php?action=list
POST /api/antrean.php?action=create
POST /api/antrean.php?action=update-status
GET  /api/antrean.php?action=display
```

---

## рҹ”§ Role Permissions

| Feature | Diretor | Admin | Karyawan |
|---------|:------:|:-----:|:--------:|
| Dashboard | Full | Full | Limited |
| Manajemen Dokter | вң… | вң… | вӣӮ |
| Manajemen Poli | вң… | вң… | вӣӮ |
| Manajemen Pasien | вң… | вң… | вң… |
| Manajemen Kamar | вң… | вң… | вң… |
| Sistem Antrean | вң… | вң… | вң… |
| Manajemen User | вң… | вң… | вӣӮ |
| Pengaturan | вң… | вң… | вӣӮ |

---

## рҹҡҖ Dashboard Features

### Stats Cards
- Total Pasien / Total Dokter (berdasarkan role)
- Antrean Hari Ini
- Kamar Tersedia
- User Aktif

### Quick Actions
- Tambah Antrean
- Registrasi Pasien
- Pasien IGD
- Rawat Inap

### Display
- Antrean saat ini
- Estimasi waktu tunggu
- Jumlah menunggu

---

## рҹҡҖ Security Features

### Session Management
```php
// Session timeout (1 hour)
define('SESSION_TIMEOUT', 3600);

// Auto logout setelah inactivity
if (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT) {
    session_destroy();
    header('Location: login.php');
}
```

### Password Hashing
```php
// Verifikasi password
if (password_verify($input, $hashed)) {
    // Password match
}
```

### Activity Logging
```php
// Log aktivitas user
log_activity('create', 'dokter', 'Added new doctor: dr. Wayan');

// Log tersimpan di logs/activity.log
```

---

## рҹ‘¬️ Database Tables

### users
| Field | Type | Description |
|-------|------|-------------|
| id | INT | Primary key |
| username | VARCHAR(50) | Unique username |
| password | VARCHAR(255) | Hashed password |
| nama_lengkap | VARCHAR(100) | Full name |
| role | ENUM | 'direktur', 'admin', 'karyawan' |
| status | ENUM | 'active', 'inactive' |

### dokter
| Field | Type | Description |
|-------|------|-------------|
| id | INT | Primary key |
| nip | VARCHAR(20) | NIP (unique) |
| nama | VARCHAR(100) | Doctor name |
| spesialisasi | VARCHAR(100) | Specialization |
| poli_id | INT | FK to poli |

### antrean
| Field | Type | Description |
|-------|------|-------------|
| id | INT | Primary key |
| nomor_antrean | VARCHAR(10) | Queue number |
| pasien_id | INT | FK to pasien |
| poli_id | INT | FK to poli |
| status | ENUM | 'waiting', 'called', 'serving', 'done' |

---

## рҹ“Ҹ Troubleshooting

### Error: "Connection failed"
```php
// Check database connection
$db = Database::getInstance();
if ($db->getConnection()->connect_error) {
    die("Koneksi gagal");
}
```

### Error: "Session not started"
```php
// Add at top of every page
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
```

### Error: "Access denied"
```php
// Pastikan user sudah login
require_login();

// Atau cek role
require_role(['direktur', 'admin']);
```

---

## рҹ“” Quick Commands

### Test Login
```
https://payanganhospital.gianyarkab.go.id/rs-admin/login.php
```

### Check Dashboard
```
https://payanganhospital.gianyarkab.go.id/rs-admin/dashboard.php
```

### Test API
```bash
curl "https://payanganhospital.gianyarkab.go.id/rs-admin/api/dokter.php?action=list"
```

---

## рҹ‘¬️ Customization

### Add New Role
1. Edit `config/schema.sql`:
```sql
ALTER TABLE users MODIFY COLUMN role 
ENUM('direktur', 'admin', 'karyawan', 'new_role');
```

2. Update `includes/auth.php`:
```php
function get_role_display($role) {
    $roles = [
        'direktur' => 'Direktur',
        'admin' => 'Administrator',
        'karyawan' => 'Karyawan',
        'new_role' => 'New Role Name'
    ];
}
```

### Add New Table
1. Add to `config/schema.sql`
2. Create model class
3. Add CRUD functions
4. Create API endpoint

---

## рҹ“” Next Steps

- [ ] Setup MySQL database di hosting
- [ ] Import schema.sql
- [ ] Update database credentials
- [ ] Generate production passwords
- [ ] Test semua fitur
- [ ] Setup backup automation

---

**Created:** 2026-07-04  
**Updated:** 2026-07-04  
**Version:** 1.0.0
