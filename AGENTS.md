# Payangan Hospital - Agent Workspace

## рҹ“Ӣ Overview

Repository ini berisi website RS Payangan Hospital dan konfigurasi automasi untuk deployment otomatis.

---

## рҹҸҘ Project Info

| Field | Value |
|-------|-------|
| **Project** | Payangan Hospital Management System |
| **Repository** | `prahlad168/Payangan-Hospital` |
| **Domain** | `https://payanganhospital.gianyarkab.go.id/` |
| **Hosting** | Idwebhost (cPanel) |
| **Username cPanel** | `payangan` |

---

## рҹ"Ғ Project Structure

```
Payangan-Hospital/
в”ңв”Җв”Җ index.html              # Homepage
в”ңв”Җв”Җ about.html              # About page
в”ңв”Җв”Җ dokter.html             # Doctor list
в”ңв”Җв”Җ igd.html                # IGD/Emergency
в”ңв”Җв”Җ kontak.html             # Contact page
в”ңв”Җв”Җ antrean.html           # Live antrean display
в”ңв”Җв”Җ progress/
в”Ӯ   в””в”Җв”Җ index.html         # Progress dashboard
в”Ӯ   в””в”Җв”Җ weekly-report-*.md    # Laporan mingguan
в”Ӯ   в””в”Җв”Җ director-report-login.html  # Login laporan direksi
в”ңв”Җв”Җ rs-admin/              # BACKEND ADMIN SYSTEM
в”Ӯ   в”Ӯ
в”Ӯ   в””в”Җв”Җ config/
в”Ӯ   в”Ӯ   в””в”Җв”Җ database.php       # Konfigurasi DB
в”Ӯ   в”Ӯ   в””в”Җв”Җ schema.sql         # Database schema
в”Ӯ   в”Ӯ
в”Ӯ   в””в”Җв”Җ includes/
в”Ӯ   в”Ӯ   в””в”Җв”Җ auth.php           # Auth helpers
в”Ӯ   в”Ӯ   в””в”Җв”Җ header.php        # Navbar/Sidebar
в”Ӯ   в”Ӯ   в””в”Җв”Җ footer.php        # Footer
в”Ӯ   в”Ӯ
в”Ӯ   в””в”Җв”Җ login.php             # Login page
в”Ӯ   в””в”Җв”Җ logout.php            # Logout
в”Ӯ   в””в”Җв”Җ dashboard.php         # Dashboard utama
в”Ӯ   в””в”Җв”Җ dokter.php           # Manajemen dokter
в”Ӯ   в””в”Җв”Җ poli.php              # Manajemen poli
в”Ӯ   в””в”Җв”Җ pasien.php            # Manajemen pasien
в”Ӯ   в””в”Җв”Җ kamar.php            # Manajemen kamar
в”Ӯ   в””в”Җв”Җ antrean.php           # Sistem antrean
в”Ӯ   в””в”Җв”Җ igd.php              # IGD
в”Ӯ   в””в”Җв”Җ users.php            # Manajemen user
в”Ӯ   в””в”Җв”Җ README.md            # Dokumentasi
в”Ӯ
в”ңв”Җв”Җ img/                    # Images folder
в”ңв”Җв”Җ webhook.php             # Auto-deploy webhook script
в””в”Җв”Җ ... (other hospital pages)
```

---

## рҹӨ– Available Skills

### 3. RS Admin Backend System
**Folder:** `rs-admin/`

Sistem backend administration untuk RS Payangan Hospital dengan autentikasi multi-level.

**Login Credentials:**
| Role | Username | Password |
|------|----------|----------|
| **Direktur** | `direktur` | `welcomehome` |
| **Admin** | `admin` | `admin123` |
| **Karyawan** | `karyawan` | `staf2026` |

**Fitur:**
- Dashboard dengan statistik real-time
- Manajemen dokter, poli, pasien, kamar
- Sistem antrean terintegrasi
- Role-based access control (RBAC)
- MySQL database schema siap pakai

**URL Akses (setelah deploy):**
```
https://payanganhospital.gianyarkab.go.id/rs-admin/
```

**Role Permissions:**
| Feature | Diretor | Admin | Karyawan |
|--------|:------:|:-----:|:--------:|
| Dashboard | Full | Full | Limited |
| Manajemen Dokter | ✅ | ✅ | ❌ |
| Manajemen User | ✅ | ✅ | ❌ |
| Sistem Antrean | ✅ | ✅ | ✅ |

### 4. Laporan Direksi
**File:** `progress/director-report-login.html`

Laporan mingguan dengan proteksi password untuk direktur.

**Password:** `welcomehome`

**URL:**
```
https://payanganhospital.gianyarkab.go.id/progress/director-report-login.html
```

**Isi Laporan:**
- Ringkasan eksekutif (92% progress)
- Status infrastruktur website
- Sistem automation (8 GitHub Actions + 6 OpenHands Agents)
- Issues & action items
- KPI achievement
- Rencana minggu depan

### 5. Chat Agent System
**File:** `chat.html` + `rs-admin/api/chat.php`

Sistem chat AI untuk website RS Payangan.

**URL:** `https://payanganhospital.gianyarkab.go.id/chat.html`

**Fitur:**
- Quick action buttons (6 tombol cepat)
- Knowledge base RS Payangan
- Voice input support
- Responsive design
- API endpoint untuk integrasi agent

**Quick Actions:**
| Tombol | Pertanyaan |
|--------|-----------|
| рҡҫ Jam Buka | Jam berapa RS buka? |
| рҡӣ Daftar Online | Cara pendaftaran online |
| рҡӣ Tarif Dokter | Berapa tarif konsultasi? |
| рҡӣ Dokter Praktik | Siapa dokter yang praktik? |
| рҡұ Lokasi RS | Di mana RS Payangan? |
| рҹӨ Kontak Darurat | Nomor telepon IGD? |

**API Endpoints:**
```
POST /rs-admin/api/chat.php?action=chat
GET /rs-admin/api/chat.php?action=stats
GET /rs-admin/api/chat.php?action=history
```

### 1. Webhook Auto-Deploy
**File:** `.agents/skills/webhook-auto-deploy.md`

Setup webhook untuk auto-deploy dari GitHub ke hosting Idwebhost.

**Yang sudah configured:**
- вң… Webhook URL: `https://payanganhospital.gianyarkab.go.id/webhook.php`
- вң… GitHub webhook active
- вң… Auto-deploy working

### 2. OpenHands Daily Report
**File:** `.agents/skills/openhands-daily-report.md`

Automation untuk laporan progress harian otomatis jam 6 pagi WIB.

**Yang sudah configured:**
- вң… Automation ID: `2e4d4f38-1c7c-4437-b25b-7d52f35d0ab7`
- вң… Schedule: `0 6 * * *` (Asia/Jakarta)
- вң… Output: `progress/daily-report-YYYY-MM-DD.md`

---

## рҹҡҖ Deployment Flow

```
в”Ңв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”җ
в”Ӯ  GitHub Push    в”Ӯ
в””в”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”¬в”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”ҳ
         в”Ӯ
         в–ј
в”Ңв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”җ
в”Ӯ  GitHub         в”Ӯ
в”Ӯ  Webhook        в”Ӯ
в””в”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”¬в”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”ҳ
         в”Ӯ
         в–ј
в”Ңв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”җ     в”Ңв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”җ
в”Ӯ  Idwebhost      в”Ӯв”Җв”Җв”Җв”Җв–¶в”Ӯ  Website Updated в”Ӯ
в”Ӯ  webhook.php    в”Ӯ     в”Ӯ  вң… Success      в”Ӯ
в””в”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”ҳ     в””в”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”ҳ
```

---

## рҹ“… Automation Schedule

| Task | Schedule | Output |
|------|----------|--------|
| Daily Progress Report | Setiap jam 6:00 pagi WIB | `progress/daily-report-*.md` |
| Progress Dashboard | Setiap push | `progress/index.html` |

---

## рҹ”§ Quick Commands

### Test Webhook:
```
https://payanganhospital.gianyarkab.go.id/webhook.php
```

### Trigger Automation Manually:
```bash
curl -X POST "https://app.all-hands.dev/api/automation/v1/2e4d4f38-1c7c-4437-b25b-7d52f35d0ab7/dispatch" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

### Check Automation Status:
```bash
curl "https://app.all-hands.dev/api/automation/v1/2e4d4f38-1c7c-4437-b25b-7d52f35d0ab7" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

---

## рҹ”Қ Visual Analysis Skill

**File:** `.agents/skills/visual-analysis/`

Skill untuk analisis gambar, screenshot, dan verifikasi tampilan website.

**Trigger phrases:**
- "lihat gambar", "analisis screenshot", "cek tampilan"
- "lihat halaman web", "deskripsikan gambar"
- "apa yang terlihat", "check image"

**Capabilities:**
- Web page navigation & screenshot capture
- Visual element verification
- UI/UX analysis
- Layout structure description
- Color scheme detection

---

## 🚀 Hosting Deploy Skill

**File:** `.agents/skills/hosting-deploy/`

Skill untuk deploy dari GitHub ke hosting Idwebhost.

**Trigger phrases:**
- "deploy", "push ke hosting", "update website"
- "sync hosting", "webhook tidak jalan"
- "manual deploy", "direct deploy"

**Deploy Methods:**
| Method | URL |
|--------|-----|
| GitHub Webhook | Auto on push |
| Manual Deploy | `deploy.php?key=DEPLOY_KEY` |
| SSH | cPanel Terminal |
| cPanel | File Manager |

**Quick Deploy:**
```
https://payanganhospital.gianyarkab.go.id/deploy.php?key=PAYANGAN_DEPLOY_2026
```

---

## 🌐 Network Speed Skill

**File:** `.agents/skills/network-speed/`

Skill untuk mempercepat koneksi internet secara **legal**.

**Trigger phrases:**
- "internet cepat", "speed internet"
- "DNS cepat", "wifi lambat"
- "optimasi internet", "download cepat"

**Quick Tips:**
| Tips | Cara |
|------|------|
| DNS | 1.1.1.1 / 8.8.8.8 |
| Browser | Clear cache, disable extensions |
| Router | Reboot, 5GHz band |
| System | Flush DNS, reset network |

---

## 📡 Onno W. Purbo Skill

**File:** `.agents/skills/onno-w-purbo/`

Skill untuk belajar metode **Onno W. Purbo** - Bapak Internet Indonesia.

**Trigger phrases:**
- "onno w purbo", "onno purbo"
- "wajan internet", "wokbolic"
- "wifi dari wajan", "antena kaleng"
- "internet murah", "community network"

**Metode Legendaris:**
| Metode | Hasil |
|--------|-------|
| Wokbolic (Wajan) | 50m → 4km |
| Tin Can WiFi | 50m → 1km |
| Community Network | Desa tanpa internet |

**Prinsip:**
- Kreatif dengan bahan murah
- Legal & open knowledge
- Bangun komunitas

---

## 🔧 Image Fixing Skill

**File:** `.agents/skills/image-fixing/`

Skill untuk memperbaiki masalah gambar di website (blur, stretch, kecil, tidak muncul).

**Trigger phrases:**
- "perbaiki gambar", "fix image", "gambar blurry"
- "gambar pecah", "gambar kecil", "image quality"

**Common Fixes:**
- Replace gambar kecil dengan versi lebih besar
- Adjust CSS background-size (cover/contain)
- Fix image path/case sensitivity
- Optimize image size


## рҹ“қ For Future Development

### Adding New Pages:
1. Create HTML file di repository
2. Push ke GitHub
3. Hosting auto-update via webhook

### Modifying Automation:
1. Edit prompt di OpenHands dashboard
2. Atau update via API

### Checking Logs:
- Webhook log: `/home/payangan/public_html/webhook.log`
- OpenHands runs: Via dashboard

---

## рҹ”’ Security Notes

- Webhook secret: Tidak dipakai (kosong) untuk simplicity
- Untuk production: Tambahkan secret verification
- GitHub token: Gunakan read-only access jika memungkinkan

---

## рҹ“һ Contact

- **GitHub Owner:** prahlad168
- **Domain Admin:** Team Idwebhost

---

## вң… Status

| Component | Status | Notes |
|-----------|--------|-------|
| GitHub Repository | вң… Active | Latest commit: 2026-07-04 |
| Hosting Connected | вң… Connected | Idwebhost cPanel |
| Webhook | вң… Working | Auto-deploy on push |
| Daily Automation | вң… Active | 6 AM WIB daily |
| Auto-Deploy | вң… Ready | GitHub Actions + Webhook |
| **RS Admin Backend** | **вң… Ready** | PHP/MySQL ready |
| **Laporan Direksi** | **вң… Ready** | Password protected |
| **13 QA Agents** | **вң… Ready** | Run with /play command |
| **Chat Agent** | **вң… NEW** | AI chatbot for website |

---

**Last Updated:** 2026-07-04
