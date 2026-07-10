# SELAMAT DATANG, PAK PUR!

---

### Salam dari Agent AI Anda!

**CEO:** i Made Purna Ananda (Pak Pur)  
**Target:** Rp 100.000.000/bulan

---

**Halo Pak Pur!** 

Saya Agent AI Anda, siap membantu! Setiap kali Pak Pur buka repository ini, saya langsung menyapa dan siap kerja bareng!

### Info Singkat untuk Pak Pur:

| Info | Nilai |
|------|-------|
| **Project** | RS Payangan Hospital Management System |
| **Domain** | https://payanganhospital.gianyarkab.go.id/ |
| **Hosting** | Idwebhost (cPanel) |
| **Target** | Rp 100.000.000/bulan |

### Yang Bisa Saya Kerjakan bareng Pak Pur:

- **Manajemen Website** - Update dan optimasi website RS Payangan
- **Dashboard Admin** - Akses rs-admin, laporan direksi
- **Automation** - Auto-deploy, daily reports, 13 QA agents
- **Deploy** - Push ke hosting, webhook management
- **Analisis** - Cek tampilan, perbaiki gambar, SEO

### Login Credentials:

| Sistem | Username | Password |
|--------|----------|----------|
| rs-admin (Admin) | `admin` | `admin123` |
| rs-admin (Direktur) | `direktur` | `welcomehome` |
| rs-admin (Karyawan) | `karyawan` | `staf2026` |

---

> *"Ga ada yang ga mungkin kalau kerja bareng AI!"* - GAURANGA System

---

# Payangan Hospital - Agent Workspace

## Overview

Repository ini berisi website RS Payangan Hospital dan konfigurasi automasi untuk deployment otomatis.

---

## Project Info

| Field | Value |
|-------|-------|
| **Project** | Payangan Hospital Management System |
| **Repository** | `prahlad168/Payangan-Hospital` |
| **Domain** | `https://payanganhospital.gianyarkab.go.id/` |
| **Hosting** | Idwebhost (cPanel) |
| **Username cPanel** | `payangan` |

---

## Project Structure

```
Payangan-Hospital/
├── index.html              # Homepage
├── about.html              # About page
├── dokter.html             # Doctor list
├── igd.html                # IGD/Emergency
├── kontak.html             # Contact page
├── antrean.html           # Live antrean display
├── progress/
│   ├── index.html         # Progress dashboard
│   ├── weekly-report-*.md    # Laporan mingguan
│   └── director-report-login.html  # Login laporan direksi
├── rs-admin/              # BACKEND ADMIN SYSTEM
│   ├── config/
│   │   ├── database.php       # Konfigurasi DB
│   │   └── schema.sql         # Database schema
│   ├── includes/
│   │   ├── auth.php           # Auth helpers
│   │   ├── header.php        # Navbar/Sidebar
│   │   └── footer.php        # Footer
│   ├── login.php             # Login page
│   ├── logout.php            # Logout
│   ├── dashboard.php         # Dashboard utama
│   ├── dokter.php           # Manajemen dokter
│   ├── poli.php              # Manajemen poli
│   ├── pasien.php            # Manajemen pasien
│   ├── kamar.php            # Manajemen kamar
│   ├── antrean.php           # Sistem antrean
│   ├── igd.php              # IGD
│   ├── users.php            # Manajemen user
│   └── README.md            # Dokumentasi
├── img/                    # Images folder
├── webhook.php             # Auto-deploy webhook script
└── ... (other hospital pages)
```

---

## Available Skills

### 1. Webhook Auto-Deploy
**File:** `.agents/skills/webhook-auto-deploy.md`

Setup webhook untuk auto-deploy dari GitHub ke hosting Idwebhost.

**Yang sudah configured:**
- ✅ Webhook URL: `https://payanganhospital.gianyarkab.go.id/webhook.php`
- ✅ GitHub webhook active
- ✅ Auto-deploy working

### 2. OpenHands Daily Report
**File:** `.agents/skills/openhands-daily-report.md`

Automation untuk laporan progress harian otomatis jam 6 pagi WIB.

**Yang sudah configured:**
- ✅ Automation ID: `2e4d4f38-1c7c-4437-b25b-7d52f35d0ab7`
- ✅ Schedule: `0 6 * * *` (Asia/Jakarta)
- ✅ Output: `progress/daily-report-YYYY-MM-DD.md`

### 3. RS Admin Backend System
**Folder:** `rs-admin/`

Sistem backend administration untuk RS Payangan Hospital dengan autentikasi multi-level.

**Login Credentials:**
| Role | Username | Password |
|------|----------|----------|
| **Directeur** | `direktur` | `welcomehome` |
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

### 4. Laporan Direksi
**File:** `progress/director-report-login.html`

Laporan mingguan dengan proteksi password untuk direktur.

**Password:** `welcomehome`

### 5. Chat Agent System
**File:** `chat.html` + `rs-admin/api/chat.php`

Sistem chat AI untuk website RS Payangan.

**URL:** `https://payanganhospital.gianyarkab.go.id/chat.html`

### 6. Customer Service Agent
**File:** `progress/customer-feedback-report.md`

Sistem Customer Service Agent untuk RS Payangan Hospital.

**Fitur:**
- Analisis support tickets dan feedback
- Response templates untuk common questions
- FAQ updates berdasarkan common issues
- Laporan kepuasan pelanggan (CSAT)
- Improvement recommendations

**Target Metrics:**
| Metric | Target | Status |
|--------|--------|--------|
| Response Time | < 1 hour | ✅ |
| CSAT | > 90% | ✅ |
| First Contact Resolution | > 70% | ✅ |

**Output Files:**
- `progress/customer-feedback-report.md` - Laporan CS mingguan
- `progress/customer-service-faq-updates.md` - FAQ updates
- `progress/customer-service-response-templates.md` - Response templates

---

## Deployment Flow

```
GitHub Push
     │
     ▼
GitHub Webhook Trigger
     │
     ▼
Hosting Server (Idwebhost)
     │
     ▼
Git Pull to Live
     │
     ▼
Website Updated
```

---

## Quick Commands

### Test Webhook:
```
https://payanganhospital.gianyarkab.go.id/webhook.php
```

### Trigger Automation Manually:
```bash
curl -X POST "https://app.all-hands.dev/api/automation/v1/2e4d4f38-1c7c-4437-b25b-7d52f35d0ab7/dispatch" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

---

## Status

| Component | Status | Notes |
|-----------|--------|-------|
| GitHub Repository | ✅ Active | Latest commit |
| Hosting Connected | ✅ Connected | Idwebhost cPanel |
| Webhook | ✅ Working | Auto-deploy on push |
| Daily Automation | ✅ Active | 6 AM WIB daily |
| Auto-Deploy | ✅ Ready | GitHub Actions + Webhook |
| RS Admin Backend | ✅ Ready | PHP/MySQL ready |
| Laporan Direksi | ✅ Ready | Password protected |
| 13 QA Agents | ✅ Ready | Run with /play command |
| Chat Agent | ✅ Active | AI chatbot for website |
| Customer Service Agent | ✅ NEW | CS reports & templates |

---

**Last Updated:** 2026-07-10
