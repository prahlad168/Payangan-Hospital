# 🚀 Deploy ke Cloudflare Pages (GRATIS - Unlimited Bandwidth)

## Cara Paling Mudah: Direct Upload

### Langkah 1: Buka Cloudflare Pages
1. Buka https://dash.cloudflare.com/
2. Login / Sign up (GRATIS)
3. Klik **Pages** di sidebar kiri
4. Klik **Create a project**

### Langkah 2: Pilih "Direct Upload"
1. Pilih **"Direct Upload"** (bukan Connect to Git)
2. Klik **Upload assets**

### Langkah 3: Download & Upload Files
1. Download folder website:
```bash
cd /workspace/project/payangan-hospital-live
zip -r payangan-hospital.zip .
```
2. Upload file ZIP ke Cloudflare
3. Set project name: `payangan-hospital`
4. Klik **Deploy**

### Hasil
Website langsung LIVE di:
**https://payangan-hospital.pages.dev**

---

## Auto-Deploy dari GitHub (Setup Sekali)

### Yang Perlu Dilakukan Sekali:

1. Buka https://dash.cloudflare.com/pages
2. Klik **Create a project**
3. Pilih **Connect to Git**
4. Connect repo: `prahlad168/Payangan-Hospital`
5. Set:
   - Project name: `payangan-hospital`
   - Production branch: `main`
6. Build settings: **None** (karena static)
7. Klik **Save and Deploy**

Selesai! Setiap push ke GitHub akan auto-deploy.

---

## Perbandingan Hosting

| Platform | Bandwidth | Harga |
|----------|-----------|-------|
| Cloudflare Pages | **Unlimited** ⭐ | GRATIS |
| Vercel Hobby | 100GB/bulan | GRATIS |
| Netlify | 100GB/bulan | GRATIS |
| GitHub Pages | 100GB/bulan | GRATIS |

**Cloudflare Pages adalah pilihan terbaik** karena unlimited bandwidth!

---

## Setup GitHub Secrets (untuk auto-deploy)

Di repo GitHub → Settings → Secrets:

| Secret Name | Value |
|-------------|-------|
| `CLOUDFLARE_API_TOKEN` | Buat di Cloudflare Profile → API Tokens |
| `CLOUDFLARE_ACCOUNT_ID` | Lihat di Cloudflare Pages Overview |

Workflow sudah ada di `.github/workflows/cloudflare-deploy.yml`

---

**Setelah deploy, website akan LIVE di:**
`https://payangan-hospital.pages.dev`
