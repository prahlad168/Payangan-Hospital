# 📋 RS Payangan Hospital - Phase 2 Installation Guide

## 🎯 Overview

Dokumen ini berisi panduan lengkap untuk mengaktifkan **RS Admin Backend System (Phase 2)** di hosting Idwebhost.

---

## 📋 Prerequisites

- [ ] Akses cPanel hosting Idwebhost
- [ ] Domain: `payanganhospital.gianyarkab.go.id`
- [ ] GitHub repository sudah terhubung dengan webhook

---

## 🚀 Quick Installation (5 Steps)

### Step 1: Buat Database di cPanel

1. Login ke cPanel: `https://payanganhospital.gianyarkab.go.id:2083`
2. Buka **MySQL Databases**
3. Buat database baru:
   - Database Name: `payangan_hospital`
4. Buat user database:
   - Username: `payangan_rs`
   - Password: *(hasilkan password kuat)*
5. Add User ke Database → Grant All Privileges

### Step 2: Setup Konfigurasi Database

1. Buka **File Manager** → `public_html` → `rs-admin` → `config`
2. Edit `database.php`
3. Update credentials:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'payangan_rs');        // Username database
define('DB_PASS', 'YOUR_PASSWORD');      // Password database
define('DB_NAME', 'payangan_hospital');  // Nama database
```

### Step 3: Jalankan Auto-Install

1. Buka browser dan jalankan:
   ```
   https://payanganhospital.gianyarkab.go.id/rs-admin/install.php
   ```
2. Script akan:
   - ✅ Membuat semua tabel database
   - ✅ Insert data default (poli, kamar, settings)
   - ✅ Buat 3 user default

### Step 4: Setup Password

1. Buka browser:
   ```
   https://payanganhospital.gianyarkab.go.id/rs-admin/setup-password.php
   ```
2. Copy SQL queries yang ditampilkan
3. Buka **phpMyAdmin** di cPanel
4. Pilih database `payangan_hospital`
5. Klik tab **SQL** → Paste queries → **Go**

### Step 5: Hapus File Install (Security!)

⚠️ **PENTING!** Hapus file ini untuk keamanan:

```bash
# Via File Manager, hapus:
rs-admin/install.php
rs-admin/setup-password.php
```

---

## 🔐 Default Login Credentials

| Role | Username | Password |
|------|----------|----------|
| **Directeur** | `direktur` | `welcomehome` |
| **Admin** | `admin` | `admin123` |
| **Karyawan** | `karyawan` | `staf2026` |

---

## 📊 Fitur yang Diaktifkan

### Setelah Instalasi:

| Feature | Status | URL |
|---------|--------|-----|
| Login | ✅ Ready | `/rs-admin/login.php` |
| Dashboard | ✅ Ready | `/rs-admin/dashboard.php` |
| Manajemen Dokter | ✅ Ready | `/rs-admin/dokter.php` |
| Manajemen User | ✅ Ready | `/rs-admin/users.php` |
| Sistem Antrean | ✅ Ready | `/rs-admin/antrean.php` |
| API Endpoints | ✅ Ready | `/rs-admin/api/` |

---

## 🧪 Testing

### Test Database Connection:
```bash
curl "https://payanganhospital.gianyarkab.go.id/rs-admin/api/setup-api.php?action=status"
```

### Test Login:
1. Buka: `https://payanganhospital.gianyarkab.go.id/rs-admin/login.php`
2. Login dengan credentials di atas
3. Cek dashboard berfungsi

---

## 🐛 Troubleshooting

### Error: "Connection failed"
```
✅ Pastikan credentials database benar
✅ Pastikan user sudah di-grant akses ke database
✅ Cek nama database dengan prefix username (payangan_payangan_rs)
```

### Error: "Table already exists"
```
✅ Normal - tabel sudah ada dari instalasi sebelumnya
✅ Skip dan lanjutkan ke step berikutnya
```

### Error: "Password not working"
```
✅ Jalankan setup-password.php lagi
✅ Paste query SQL di phpMyAdmin
✅ Hapus cookies browser dan coba lagi
```

---

## 📁 File Structure After Install

```
rs-admin/
├── config/
│   ├── database.php       ✅ Updated dengan credentials
│   └── schema.sql         (Backup reference)
├── includes/
│   ├── auth.php           ✅ Ready
│   ├── header.php        ✅ Ready
│   └── footer.php        ✅ Ready
├── api/
│   ├── dokter.php         ✅ Ready
│   ├── antrean.php        ✅ Ready
│   ├── setup-api.php     ✅ NEW - Status checker
│   └── users.php          ✅ Ready
├── login.php              ✅ Ready
├── logout.php             ✅ Ready
├── dashboard.php          ✅ Ready
├── dokter.php             ✅ Ready
├── users.php              ✅ Ready
├── antrean.php            ✅ Ready
├── install.php            ⚠️ HAPUS SETELAH INSTALASI
├── setup-password.php     ⚠️ HAPUS SETELAH INSTALASI
└── README.md              ✅ Ready
```

---

## 🔒 Security Checklist

- [ ] Database credentials di-set dengan benar
- [ ] install.php sudah dihapus
- [ ] setup-password.php sudah dihapus
- [ ] Password default sudah di-hash
- [ ] Session timeout configured (1 hour)
- [ ] Activity logging enabled

---

## 📞 Support

Jika ada masalah:
1. Cek error logs di cPanel
2. Test database connection dengan `setup-api.php?action=test-db`
3. Hubungi OpenHands Agent untuk assistance

---

## 🎉 Success!

Setelah instalasi berhasil, RS Admin System siap digunakan!

**URL Access:** `https://payanganhospital.gianyarkab.go.id/rs-admin/`

---

*Created by: OpenHands AI Agent*
*Date: 2026-07-21*
*Version: 1.0.0*
