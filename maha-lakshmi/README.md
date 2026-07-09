# Maha Lakshmi - Kasir & Revenue Dashboard

## 📋 Fitur

### 1. Dashboard Otomatis
- Semua status perusahaan otomatis berubah menjadi **Active** ketika ada transaksi kasir
- Data dibaca dari file JSON (bisa dikoneksikan ke database)

### 2. Kasir API
- Endpoint untuk input transaksi
- Auto-update status perusahaan

### 3. Laporan Harian Otomatis
- Dijadwalkan jam 12 siang setiap hari
- Bisa dikirim ke WhatsApp

---

## 🚀 Setup

### 1. Deploy ke Hosting
```bash
git add .
git commit -m "feat: kasir system dengan auto-status"
git push
```

### 2. Setup Cron Job (Laporan Harian)
```bash
# Edit crontab
crontab -e

# Tambahkan baris ini (jam 12 siang WIB):
0 12 * * * cd /home/payangan/public_html/maha-lakshmi && php api/daily-report.php >> /dev/null 2>&1
```

### 3. Setup WhatsApp (Optional)
Edit file `api/daily-report.php` dan isi:
```php
$CONFIG = [
    'wa_number' => '6281234567890', // Nomor WA Anda
    'wa_token' => 'YOUR_FONNTE_TOKEN',
    'use_wa' => true, // Set true setelah isi config
];
```

---

## 📡 API Endpoints

### List Semua Perusahaan
```
GET api/kasir.php?action=companies
```

### Tambah Transaksi
```
POST api/kasir.php?action=add
Body: {
    "company_id": "01",
    "amount": 500000,
    "description": "Pembayaran layanan"
}
```

### Laporan Harian
```
GET api/kasir.php?action=daily-report
```

### Update Status Manual
```
POST api/kasir.php?action=update-status
Body: {
    "company_id": "04",
    "status": "active"
}
```

---

## 📊 Auto-Status Logic

| Kondisi | Status |
|---------|--------|
| Ada transaksi kasir | **Ready → Active** |
| Revenue > 0 | Status tetap Active |
| Belum ada transaksi | Ready / Pending |

---

## 🔧 File Structure

```
maha-lakshmi/
├── api/
│   ├── kasir.php          # Main API
│   └── daily-report.php   # Laporan harian
├── data/
│   ├── companies.json     # Data perusahaan
│   └── transactions.json  # Data transaksi
├── login.php              # Login page
├── index.php              # Dashboard
└── README.md              # Dokumentasi
```

---

## 💰 Target

- 10 Perusahaan
- Target: Rp 100.000.000/perusahaan/bulan
- Total Target: Rp 1.000.000.000/bulan
