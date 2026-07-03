# Payangan Hospital - Agent Workspace

## Overview

Repository ini berisi website RS Payangan Hospital dan konfigurasi automasi untuk deployment otomatis. AI Agent menggunakan pendekatan **Knowledge Pipeline** untuk continuous improvement.

---

## Project Info

| Field | Value |
|-------|-------|
| **Project** | Payangan Hospital Management System |
| **Repository** | `prahlad168/Payangan-Hospital` |
| **Domain** | `https://payanganhospital.gianyarkab.go.id/` |
| **Hosting** | Idwebhost (cPanel) |
| **Username cPanel** | `payangan` |
| **Agent Approach** | Master AI Continuous Learning V10 |

---

## Knowledge Pipeline

AI Agent Payangan Hospital menggunakan **Master AI Continuous Learning Prompt V10** dengan Knowledge Pipeline:

```
Observe → Collect → Analyze → Validate → Summarize
→ Create SOP → Create Checklist → Create Prompt
→ Store Knowledge → Apply Knowledge
→ Measure Result → Improve → Repeat
```

### Key Principles:
- Setiap task selesai harus meninggalkan perusahaan lebih cerdas
- Knowledge diubah menjadi SOP, checklist, dan template
- Knowledge base dapat digunakan ulang oleh semua agent
- Continuous improvement melalui siklus learning

---

## Project Structure

```
├── index.html              # Homepage
├── about.html              # About page
├── dokter.html             # Doctor list
├── igd.html                # IGD/Emergency
├── kontak.html             # Contact page
├── progress/
│   └── index.html          # Progress dashboard
├── img/                    # Images folder
├── webhook.php             # Auto-deploy webhook script
├── .agents/skills/         # AI Agent Skills
│   ├── master-continuous-learning.md  # Knowledge Pipeline SOP
│   └── knowledge-base/     # Knowledge Base
└── ... (other hospital pages)
```

---

## Available Skills

### 1. Master Continuous Learning
**File:** `.agents/skills/master-continuous-learning.md`

SOP inti untuk Knowledge Pipeline AI Agent.

### 2. Knowledge Base
**File:** `.agents/skills/knowledge-base/`

Structured knowledge storage:
- `hospital-sop/` - Hospital SOPs
- `marketing/` - Marketing knowledge
- `sales/` - Sales knowledge
- `automation/` - Automation SOPs
- `templates/` - Document templates
- `prompts/` - AI Prompts
- `checklists/` - Checklists
- `best-practices/` - Best practices
- `lessons-learned/` - Lessons from experience

### 3. Webhook Auto-Deploy
**File:** `.agents/skills/webhook-auto-deploy.md`

Setup webhook untuk auto-deploy dari GitHub ke hosting Idwebhost.

**Yang sudah configured:**
- Webhook URL: `https://payanganhospital.gianyarkab.go.id/webhook.php`
- GitHub webhook active
- Auto-deploy working

### 4. OpenHands Daily Report
**File:** `.agents/skills/openhands-daily-report.md`

Automation untuk laporan progress harian otomatis jam 6 pagi WIB.

**Yang sudah configured:**
- Automation ID: `2e4d4f38-1c7c-4437-b25b-7d52f35d0ab7`
- Schedule: `0 6 * * *` (Asia/Jakarta)
- Output: `progress/daily-report-YYYY-MM-DD.md`

---

## Deployment Flow

```
GitHub Push → GitHub Webhook → Hosting webhook.php → git pull → Live
```

---

## Automation Schedule

| Task | Schedule | Output |
|------|----------|--------|
| Daily Progress Report | Setiap jam 6:00 pagi WIB | `progress/daily-report-*.md` |
| Progress Dashboard | Setiap push | `progress/index.html` |
| Knowledge Extraction | Setiap task selesai | Knowledge Base updates |

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

### Check Automation Status:
```bash
curl "https://app.all-hands.dev/api/automation/v1/2e4d4f38-1c7c-4437-b25b-7d52f35d0ab7" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

---

## Additional Skills

### Visual Analysis
**File:** `.agents/skills/visual-analysis/`

Skill untuk analisis gambar, screenshot, dan verifikasi tampilan website.

### Hosting Deploy
**File:** `.agents/skills/hosting-deploy/`

Skill untuk deploy dari GitHub ke hosting Idwebhost.

### Network Speed
**File:** `.agents/skills/network-speed/`

Skill untuk mempercepat koneksi internet secara legal.

### Image Fixing
**File:** `.agents/skills/image-fixing/`

Skill untuk memperbaiki masalah gambar di website.

---

## Knowledge Pipeline Integration

Setiap task yang dikerjakan oleh AI Agent harus:

1. **Extract Knowledge** - Identifikasi pembelajaran kunci
2. **Create SOP** - Dokumentasikan proses jika baru/improve
3. **Create Checklist** - Buat checklist jika applicable
4. **Store** - Simpan ke knowledge base
5. **Share** - Rekomendasikan ke team lain jika relevan
6. **Improve** - Identifikasi opportunity untuk improvement

### Contoh Knowledge Output:

| Task | Knowledge Output |
|------|-----------------|
| Fix bug | SOP fix, checklist prevention |
| Create page | SOP development, template |
| Optimize SEO | Best practice, checklist |
| Deploy | SOP deployment, checklist |

---

## Status

| Component | Status |
|-----------|--------|
| GitHub Repository | Active |
| Hosting Connected | Connected |
| Webhook | Working |
| Daily Automation | Active |
| Auto-Deploy | Ready |
| Knowledge Pipeline | Active |

---

**Last Updated:** 2026-07-03
**Version:** 2.0 (Knowledge Pipeline)
