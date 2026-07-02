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

## рҹ“Ғ Project Structure

```
в”ңв”Җв”Җ index.html              # Homepage
в”ңв”Җв”Җ about.html              # About page
в”ңв”Җв”Җ dokter.html             # Doctor list
в”ңв”Җв”Җ igd.html                # IGD/Emergency
в”ңв”Җв”Җ kontak.html             # Contact page
в”ңв”Җв”Җ progress/
в”Ӯ   в””в”Җв”Җ index.html         # Progress dashboard
в”ңв”Җв”Җ img/                    # Images folder
в”ңв”Җв”Җ webhook.php             # Auto-deploy webhook script
в””в”Җв”Җ ... (other hospital pages)
```

---

## рҹӨ– Available Skills

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

| Component | Status |
|-----------|--------|
| GitHub Repository | вң… Active |
| Hosting Connected | вң… Connected |
| Webhook | вң… Working |
| Daily Automation | вң… Active |
| Auto-Deploy | вң… Ready |

---

**Last Updated:** 2026-07-02
