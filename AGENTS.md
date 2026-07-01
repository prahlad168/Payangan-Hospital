# Payangan Hospital - Website Repository

---

## 🤖 Auto-Running Agents

Repository ini dilengkapi dengan **5 agent otomatis** yang berjalan via GitHub Actions:

### 1. 🔍 Auto Link Checker
| Property | Value |
|-----------|-------|
| **Trigger** | Setiap 6 jam / On push / Manual |
| **File** | `.github/workflows/01-link-checker.yml` |
| **Fungsi** | Cek broken links dan link standards (logo, dokter, kontak) |

### 2. 🤖 Auto PR Reviewer
| Property | Value |
|-----------|-------|
| **Trigger** | Saat PR baru/updated |
| **File** | `.github/workflows/02-pr-reviewer.yml` |
| **Fungsi** | Review PR, cek link standards, validasi gambar |

### 3. ✅ Auto QA Checker
| Property | Value |
|-----------|-------|
| **Trigger** | On push ke main/develop / On PR |
| **File** | `.github/workflows/03-qa-checker.yml` |
| **Fungsi** | Validasi HTML, accessibility, SEO, performance |

### 4. 🚀 Auto Deploy
| Property | Value |
|-----------|-------|
| **Trigger** | Push ke branch main |
| **File** | `.github/workflows/04-deploy.yml` |
| **Fungsi** | Pre-deploy validation → Deploy ke GitHub Pages |

### 5. 📋 Content Validator
| Property | Value |
|-----------|-------|
| **Trigger** | Harian jam 7 AM WIB / On push HTML / Manual |
| **File** | `.github/workflows/05-content-validator.yml` |
| **Fungsi** | Validasi dokter, poli, gambar, link standards |

---

## Automation Flow

```
┌─────────────────────────────────────────────────────────────┐
│                     GITHUB ACTIONS                           │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  📝 Push/Pull Request                                       │
│       │                                                      │
│       ├──┬──► 🔍 Link Checker ────► Report links error       │
│       │                                                      │
│       ├──┬──► ✅ QA Checker ──────► Report HTML/SEO issues   │
│       │                                                      │
│       ├──┬──► 📋 Content Validator ──► Report dokter/poli     │
│       │                                                      │
│       │                                                      │
│       ▼                                                      │
│  Push ke main ──► 🚀 Auto Deploy ────► GitHub Pages Live!    │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

## ℹ️ Informasi Rumah Sakit
- **Nama**: Payangan Hospital
- **Slogan**: "Pavitram Idam Uttamam" (Tempat terbaik untuk kesehatan)
- **Lokasi**: Jl. Raya Payangan, Gianyar, Bali
- **Telepon**: 0361 98087 / +62 361 9088087
- **Email**: info@rsupayangan.co.id / info@payanganhospital.co.id
- **Website deployed**: GitHub Pages via `github.com/prahlad168/Payangan-Hospital`
- **Google Maps**: g.page/rsu-payangan-gianyar

---

## Struktur Proyek
### File HTML (21 file)
Website static HTML/CSS/JS dengan halaman-halaman berikut:

| File | Deskripsi |
|------|-----------|
| `index.html` | Halaman utama/branda dengan hero slider, layanan, dokter, dll |
| `about.html` | Tentang kami (sejarah, visi misi, standar, mutu, penghargaan) |
| `dokter.html` | Daftar dokter spesialis dengan filter poli |
| `kontak.html` | Halaman kontak dengan info, form, dan testimoni |
| `antrean.html` | Display antrean real-time dan ketersediaan tempat tidur |
| `igd.html` | Instalasi Gawat Darurat 24 jam |
| `rawat-jalan.html` | Layanan rawat jalan dengan daftar poli |
| `rawat-inap.html` | Informasi kamar rawat inap (Kelas III, II, I, VIP) |
| `poli-umum.html` | Poliklinik Umum |
| `poli-saraf.html` | Poliklinik Saraf |
| `poli-anak.html` | Poliklinik Anak |
| `poli-kandungan.html` | Poliklinik Kandungan |
| `poli-tht.html` | Poliklinik THT |
| `poli-gigi.html` | Poliklinik Gigi |
| `poli-dalam.html` | Poliklinik Penyakit Dalam |
| `poli-bedah.html` | Poliklinik Bedah |
| `poli-orthopedic.html` | Poliklinik Orthopedic |
| `poli-jantung.html` | Poliklinik Jantung |
| `ph-update.html` | Berita & Artikel (PH Creative, Info Kesehatan, Info Social) |

### Folder Assets
```
img/
├── logo.png                 # Logo rumah sakit
├── director.jpg            # Foto direktur
├── bg_medical.jpg          # Background image
├── dokter/                 # Foto dokter (22 file, nama sesuai dokter)
├── slider/                  # Slider images (slider-1.png - slider-4.png)
├── partners/               # Logo mitra (BPJS, Pemerintah, dll)
└── wbk/                    # Sertifikat WBK
```

### Partner/Mitra
- BPJS Kesehatan
- Kabupaten Gianyar
- Kominfo
- Jasa Raharja
- JR Putera
- WIKA
- MHC
- APG
- OMSA MEDIC
- Alila Ubud

---

## Daftar Dokter Spesialis (22 dokter)
| No | Nama | Spesialisasi |
|----|------|---------------|
| 1 | dr. I Gusti Putu Hery Sikesa, Sp.PD | Penyakit Dalam |
| 2 | dr. Sang Ketut Widiana, Sp.PD | Penyakit Dalam |
| 3 | dr. Tjokorda Prima Dewi Pemayun, Sp.PD | Penyakit Dalam |
| 4 | dr. Made Ayu Widyaningsih, Sp.A | Anak |
| 5 | dr. Ni Made Ayu Agustini, M.Biomed., SpA | Anak |
| 6 | dr. I Gede Agus Hendra Sujana, Sp.OG | Kandungan |
| 7 | dr. I Made Brammartha Kusuma, Sp.OG | Kandungan |
| 8 | dr. Pande Made Suwanpramana, Sp.OG | Kandungan |
| 9 | dr. Kade Agus Sudha Naryana, Sp.N | Saraf |
| 10 | dr. Ni Komang Dewi Mahayani, Sp.N | Saraf |
| 11 | dr. I G N Bagus Arimanjaya, Sp.An | Anestesi |
| 12 | dr. Manik Dirgayunitri, M.Biomed., Sp.An | Anestesi |
| 13 | dr. I Wayan Eka Arnawa, Sp.An-TI | Anestesi |
| 14 | dr. I Wayan Suwarna, S.Ked., Sp.B | Bedah |
| 15 | dr. I Putu Swastika Kepakisan, M.Biomed., Sp.B | Bedah |
| 16 | dr. I Ketut Wahyu Tri Saputra, Sp.OT | Orthopedic |
| 17 | dr. I Gede Ketut Alit Satria Nugraha, SpOT | Orthopedic |
| 18 | dr. Anak Agung Ayu Ngurah Desy Widya Putri, Sp.JP | Jantung |
| 19 | dr. Herry Juniada, Sp.Rad | Radiologi |
| 20 | dr. Ika Nurvidha Mahayanthi Mantra, Sp.MK | Patologi Klinik |
| 21 | dr. Made Minarti Witarini Dewi, Sp.PK | Patologi Klinik |
| 22 | dr. Theresia Maharani Sari Nastiti, Sp.PK | Patologi Klinik |

### Filter Poli di dokter.html
`umum`, `saraf`, `anak`, `kandung`, `tht`, `gigi`, `dalam`, `bedah`, `ortho`, `jantung`, `radiologi`, `anestesi`, `laboratorium`

---

## Link Standards (WAJIB DIPATUH!)

### Logo Link
**Selalu gunakan `href="index.html"` untuk link logo (ke branda/beranda)**

| ❌ SALAH | ✅ BENAR |
|----------|----------|
| `href="#"` | `href="index.html"` |
| `href="about.html"` | `href="index.html"` |

### Link Halaman Dokter
**Selalu gunakan `href="dokter.html"` untuk navigasi ke halaman daftar dokter**

| ❌ SALAH | ✅ BENAR |
|----------|----------|
| `href="#dokter"` | `href="dokter.html"` |
| `href="index.html#dokter"` | `href="dokter.html"` |

### Link Halaman Kontak
**Selalu gunakan `href="kontak.html"` untuk navigasi ke halaman kontak**

| ❌ SALAH | ✅ BENAR |
|----------|----------|
| `href="#kontak"` | `href="kontak.html"` |
| `href="index.html#kontak"` | `href="kontak.html"` |

### Verifikasi Link
Sebelum commit, selalu jalankan:
```bash
# Cek link dokter
grep -rn 'href.*#dokter' *.html

# Cek link kontak
grep -rn 'href.*#kontak' *.html

# Cek link logo
grep -rn 'href="#" class="logo"' *.html
```
Jika ada hasil, berarti ada link yang salah.

---

## Checklist Sebelum Commit HTML
1. ✅ Semua link logo mengarah ke `index.html`
2. ✅ Semua link "Dokter" mengarah ke `dokter.html`
3. ✅ Semua link "Kontak" mengarah ke `kontak.html`
4. ✅ Semua foto dokter ada di folder `img/dokter/`
5. ✅ Nama file foto sesuai dengan referensi di HTML
6. ✅ Tidak ada link rusak (`href="#"` pada logo/nav)

---

## Design System

### Color Palette
```css
--primary: #0d7377 / #1a5f5a (teal)
--primary-dark: #095456 / #0f3d3a
--primary-light: #14919b / #4d9d97
--secondary: #f4c430 / #c9a86c (gold)
--accent: #e85d04 / #f59e0b (orange)
--bg-light: #f8f9fa
--text-dark: #212529 / #2c3e3c
--text-muted: #6c757d / #8a9a9a
--white: #ffffff
--emergency: #dc3545
```

### Typography
- **Heading**: Playfair Display (serif)
- **Body**: Montserrat (sans-serif)
- Font weights: 300 (light), 400 (regular), 500, 600, 700, 800, 900

### Libraries
- Google Fonts (Montserrat, Playfair Display)
- Font Awesome 6.4.0 (CDN)

---

## Fitur Khusus

### Halaman Antrean (antrean.html)
- Display antrean poliklinik real-time (simulasi)
- Ketersediaan tempat tidur (Kelas I: 20, Kelas II: 25, Kelas III: 55)
- IGD counter
- Auto-refresh setiap 30 detik

### Slider Hero (index.html)
- 4 slide dengan gambar di `img/slider/`
- Auto-rotate setiap 6 detik
- Navigasi dots dan arrows

### Mega Menu Navigation
- Dropdown dengan grid 2 kolom
- Icon untuk setiap menu item
- Animasi hover smooth

---

## Available Skills

### Web Builder Skills (`.agents/skills/`)
| File | Description |
|------|-------------|
| `webbuilder.md` | Modern design patterns, component examples, responsive layouts |
| `beautiful-ui.md` | Advanced UI effects (glassmorphism, neumorphism, animations) |
| `tailwind-ref.md` | Complete Tailwind CSS class reference |

---

## Git Workflow
```bash
# 1. Stage perubahan
git add -A

# 2. Commit dengan pesan deskriptif
git commit -m "Deskripsi perubahan"

# 3. Push untuk deploy
git push origin main
```

## Command Berguna
```bash
# Cek semua link dokter
grep -rn 'href.*dokter' *.html

# Cek link yang salah
grep -rn 'href.*#dokter' *.html

# Hitung jumlah kartu dokter
grep -c '<div class="doctor-card"' dokter.html

# Cek foto dokter
ls img/dokter/ | wc -l

# List semua file HTML
ls *.html | wc -l

# Cek link poli
grep -rn 'href="poli-' *.html | head -20
```

---

## Catatan Pengembangan
- Website menggunakan Bahasa Indonesia (lang="id")
- Responsive design dengan mobile menu
- Navbar transparan di homepage, putih saat scroll
- Smooth scroll behavior
- CSS variables untuk theming
- Support WhatsApp untuk konsultasi darurat
