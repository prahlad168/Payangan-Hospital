# RS Payangan Hospital - Admin Backend System

## 📋 Overview

Sistem backend administration untuk RS Payangan Hospital dengan fitur:
- Autentikasi multi-level (Direksi, Admin, Karyawan)
- Manajemen data (Dokter, Poli, Pasien, Kamar)
- Sistem Antrean
- Dashboard real-time
- Role-based access control (RBAC)

---

## 🔐 Login Credentials

| Role | Username | Password |
|------|----------|----------|
| **Direktur** | direktur | welcomehome |
| **Admin** | admin | admin123 |
| **Karyawan** | karyawan | staf2026 |

---

## 📁 File Structure

```
rs-admin/
├── config/
│   ├── database.php       # Konfigurasi database
│   └── schema.sql         # Database schema (MySQL)
├── includes/
│   ├── auth.php           # Authentication helpers
│   ├── header.php         # Header/Navbar component
│   └── footer.php         # Footer component
├── api/
│   └── (API endpoints)
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── login.php              # Login page
├── logout.php             # Logout handler
├── dashboard.php          # Main dashboard
├── dokter.php             # Manajemen dokter
├── poli.php               # Manajemen poli
├── pasien.php             # Manajemen pasien
├── kamar.php              # Manajemen kamar
├── antrean.php            # Sistem antrean
├── igd.php                # IGD
├── users.php              # Manajemen user
└── README.md
```

---

## 🚀 Installation

### 1. Setup Database

Import schema ke MySQL:
```bash
mysql -u root -p < config/schema.sql
```

### 2. Konfigurasi Database

Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'payangan_rs');
define('DB_PASS', 'your_password');
define('DB_NAME', 'payangan_hospital');
```

### 3. Generate Password Hash

Untuk production, generate password hash:
```php
echo password_hash('welcomehome', PASSWORD_DEFAULT);
```

### 4. Deploy

Upload semua file ke hosting, pastikan:
- PHP version >= 7.4
- MySQL database created
- Write permission untuk folder logs

---

## 🔐 Role Permissions

| Feature | Direktur | Admin | Karyawan |
|--------|:--------:|:-----:|:--------:|
| Dashboard | ✅ Full | ✅ Full | ✅ Limited |
| Manajemen Dokter | ✅ | ✅ | ❌ |
| Manajemen Poli | ✅ | ✅ | ❌ |
| Manajemen Pasien | ✅ | ✅ | ✅ |
| Manajemen Kamar | ✅ | ✅ | ✅ |
| Sistem Antrean | ✅ | ✅ | ✅ |
| Manajemen User | ✅ | ✅ | ❌ |
| Pengaturan | ✅ | ✅ | ❌ |

---

## 📱 Features

### Dashboard
- Statistik real-time
- Aktivitas terbaru
- Quick actions
- Display antrean

### Manajemen Data
- CRUD dokter (Nama, NIP, Spesialisasi, Jadwal)
- CRUD poli (Nama, Deskripsi, Kapasitas)
- CRUD pasien (No. RM, NIK, Data diri)
- Manajemen kamar (Kelas, Tarif, Status)

### Sistem Antrean
- Generate nomor antrean otomatis
- Status tracking (Menunggu, Dilayani, Selesai)
- Display antrean real-time
- Cetak laporan

### IGD
- Pendaftaran darurat
- Prioritas kasus
- Tracking status

---

## 🛠️ Tech Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, Vanilla JS
- **Icons**: Font Awesome 6.4
- **Fonts**: Montserrat (Google Fonts)

---

## 📝 Notes

### Demo Mode
Sistem saat ini berjalan dalam **demo mode** dengan data static. 
Untuk production, perlu:
1. Setup MySQL database
2. Import schema.sql
3. Update konfigurasi database
4. Generate password hash untuk user

### Security
- Session-based authentication
- Password hashing dengan bcrypt
- Role-based access control
- Activity logging

---

## 📞 Support

Untuk pertanyaan atau issues:
- Email: info@payanganhospital.id
- GitHub: https://github.com/prahlad168/Payangan-Hospital

---

*Created by OpenHands Agent - 2026*
