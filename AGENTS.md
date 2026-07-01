# Payangan Hospital - Website Repository

---

## 🤖 SuperAgent Memory

**Agent Name:** SuperAgent

**Current Date:** July 1, 2026 (WITA/UTC+8)

**Lokasi Project:** Payangan Hospital, Jl. Raya Payangan, Gianyar, Bali, Indonesia

**Timezone:** Asia/Makassar (WITA - UTC+8)

**Catatan:**
- Tanggal dan waktu berdasarkan timezone Bali (WITA)
- Semua timestamp dalam progress report menggunakan waktu lokal Bali
- Estimasi schedule menggunakan quarter tahun 2026

---

## рҹӨ– Auto-Running Agents

Repository ini dilengkapi dengan **5 agent otomatis** yang berjalan via GitHub Actions:

### 1. рҹ”Қ Auto Link Checker
| Property | Value |
|-----------|-------|
| **Trigger** | Setiap 6 jam / On push / Manual |
| **File** | `.github/workflows/01-link-checker.yml` |
| **Fungsi** | Cek broken links dan link standards (logo, dokter, kontak) |

### 2. рҹӨ– Auto PR Reviewer
| Property | Value |
|-----------|-------|
| **Trigger** | Saat PR baru/updated |
| **File** | `.github/workflows/02-pr-reviewer.yml` |
| **Fungsi** | Review PR, cek link standards, validasi gambar |

### 3. вң… Auto QA Checker
| Property | Value |
|-----------|-------|
| **Trigger** | On push ke main/develop / On PR |
| **File** | `.github/workflows/03-qa-checker.yml` |
| **Fungsi** | Validasi HTML, accessibility, SEO, performance |

### 4. рҹҡҖ Auto Deploy
| Property | Value |
|-----------|-------|
| **Trigger** | Push ke branch main |
| **File** | `.github/workflows/04-deploy.yml` |
| **Fungsi** | Pre-deploy validation вҶ’ Deploy ke GitHub Pages |

### 5. рҹ“Ӣ Content Validator
| Property | Value |
|-----------|-------|
| **Trigger** | Harian jam 7 AM WIB / On push HTML / Manual |
| **File** | `.github/workflows/05-content-validator.yml` |
| **Fungsi** | Validasi dokter, poli, gambar, link standards |

---

## Automation Flow

```
в”Ңв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”җ
в”Ӯ                     GITHUB ACTIONS                           в”Ӯ
в”ңв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Ө
в”Ӯ                                                             в”Ӯ
в”Ӯ  рҹ“қ Push/Pull Request                                       в”Ӯ
в”Ӯ       в”Ӯ                                                      в”Ӯ
в”Ӯ       в”ңв”Җв”Җв”¬в”Җв”Җв–ә рҹ”Қ Link Checker в”Җв”Җв”Җв”Җв–ә Report links error       в”Ӯ
в”Ӯ       в”Ӯ                                                      в”Ӯ
в”Ӯ       в”ңв”Җв”Җв”¬в”Җв”Җв–ә вң… QA Checker в”Җв”Җв”Җв”Җв”Җв”Җв–ә Report HTML/SEO issues   в”Ӯ
в”Ӯ       в”Ӯ                                                      в”Ӯ
в”Ӯ       в”ңв”Җв”Җв”¬в”Җв”Җв–ә рҹ“Ӣ Content Validator в”Җв”Җв–ә Report dokter/poli     в”Ӯ
в”Ӯ       в”Ӯ                                                      в”Ӯ
в”Ӯ       в”Ӯ                                                      в”Ӯ
в”Ӯ       в–ј                                                      в”Ӯ
в”Ӯ  Push ke main в”Җв”Җв–ә рҹҡҖ Auto Deploy в”Җв”Җв”Җв”Җв–ә GitHub Pages Live!    в”Ӯ
в”Ӯ                                                             в”Ӯ
в””в”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”Җв”ҳ
```

---

## рҹ“Ҡ Progress Report

Halaman laporan progress development tersedia di: **`/progress/index.html`**

Halaman ini berisi:
- **Overview**: Statistik project dan progress keseluruhan
- **Timeline**: Chronological project timeline dengan fase-fase pengerjaan
- **Roadmap**: Visual roadmap dengan 6 phase
- **Features**: Daftar fitur dengan status (completed/in-progress/pending)
- **Backend Plan**: Rencana pengembangan backend untuk website interaktif
- **Comparison**: Perbandingan static website vs full stack target

---

## рҹӣ пёҸ Available Skills

Repository ini menggunakan skill-skill berikut:

### Default Skills (Pre-installed)
| Skill | Deskripsi |
|-------|-----------|
| `webbuilder.md` | Modern design patterns, component examples, responsive layouts |
| `beautiful-ui.md` | Advanced UI effects (glassmorphism, neumorphism, animations) |
| `tailwind-ref.md` | Complete Tailwind CSS class reference |

### Document Skills (from anthropics/skills)
| Skill | Deskripsi |
|-------|-----------|
| `pdf` | Create, edit, and manipulate PDF documents |
| `docx` | Create and edit Word documents (.docx) |
| `pptx` | Create PowerPoint presentations |
| `xlsx` | Create Excel spreadsheets with formulas |

### Cara Menggunakan Skill
```bash
# Skill dapat di-invoke saat conversation
invoke_skill(name="pdf")   # Untuk generate PDF reports
invoke_skill(name="docx")  # Untuk generate Word documents
invoke_skill(name="pptx")  # Untuk generate presentations
invoke_skill(name="xlsx")  # Untuk generate Excel reports
```

---

## в„№пёҸ Informasi Rumah Sakit
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
в”ңв”Җв”Җ logo.png                 # Logo rumah sakit
в”ңв”Җв”Җ director.jpg            # Foto direktur
в”ңв”Җв”Җ bg_medical.jpg          # Background image
в”ңв”Җв”Җ dokter/                 # Foto dokter (22 file, nama sesuai dokter)
в”ңв”Җв”Җ slider/                  # Slider images (slider-1.png - slider-4.png)
в”ңв”Җв”Җ partners/               # Logo mitra (BPJS, Pemerintah, dll)
в””в”Җв”Җ wbk/                    # Sertifikat WBK
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

| вқҢ SALAH | вң… BENAR |
|----------|----------|
| `href="#"` | `href="index.html"` |
| `href="about.html"` | `href="index.html"` |

### Link Halaman Dokter
**Selalu gunakan `href="dokter.html"` untuk navigasi ke halaman daftar dokter**

| вқҢ SALAH | вң… BENAR |
|----------|----------|
| `href="#dokter"` | `href="dokter.html"` |
| `href="index.html#dokter"` | `href="dokter.html"` |

### Link Halaman Kontak
**Selalu gunakan `href="kontak.html"` untuk navigasi ke halaman kontak**

| вқҢ SALAH | вң… BENAR |
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
1. вң… Semua link logo mengarah ke `index.html`
2. вң… Semua link "Dokter" mengarah ke `dokter.html`
3. вң… Semua link "Kontak" mengarah ke `kontak.html`
4. вң… Semua foto dokter ada di folder `img/dokter/`
5. вң… Nama file foto sesuai dengan referensi di HTML
6. вң… Tidak ada link rusak (`href="#"` pada logo/nav)

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
- **Heading**: Montserrat (sans-serif)
- **Body**: Montserrat (sans-serif)
- Font weights: 300 (light), 400 (regular), 500, 600, 700, 800, 900
- **IMPORTANT**: Semua text termasuk heading, logo, dan section titles HARUS menggunakan Montserrat

### Libraries
- Google Fonts (Montserrat only)
- Font Awesome 6.4.0 (CDN)

---

## рҹҖ-p Image Assets Management

### Complete Image Asset Inventory

#### 1. Logo Files (Root Directory)
| File | Usage | Size | Format |
|------|-------|------|--------|
| `logo.png` | Primary logo (navbar, footer) | ~159KB | PNG |
| `logo_clean.png` | Clean version | ~5KB | PNG |
| `logo_cropped.png` | Cropped version | ~4KB | PNG |
| `logo_original.png` | Original version | ~8KB | PNG |

**Usage in HTML:**
```html
<img src="logo.png" alt="Payangan Hospital">
```

#### 2. Slider Images (`img/slider/`)
| File | Slide | Content | Color Overlay | Size |
|------|-------|---------|---------------|------|
| `slider-1.png` | Slide 1 | Pelayanan Darurat Siap Siaga | rgba(13, 115, 119, 0.85) - teal | ~685KB |
| `slider-2.png` | Slide 2 | Dokter Spesialis Berpengalaman | rgba(30, 58, 95, 0.85) - navy | ~531KB |
| `slider-3.png` | Slide 3 | Fasilitas Medis Canggih | rgba(30, 27, 75, 0.85) - purple | ~1.8MB |
| `slider-4.png` | Slide 4 | Kamar Perawatan Nyaman | rgba(19, 78, 74, 0.85) - dark teal | ~1.9MB |

**CSS Configuration (index.html):**
```css
.slide-1 .slide-bg { background-image: url('img/slider/slider-1.png'); background-color: rgba(13, 115, 119, 0.85); background-blend-mode: overlay; }
.slide-2 .slide-bg { background-image: url('img/slider/slider-2.png'); background-color: rgba(30, 58, 95, 0.85); background-blend-mode: overlay; }
.slide-3 .slide-bg { background-image: url('img/slider/slider-3.png'); background-color: rgba(30, 27, 75, 0.85); background-blend-mode: overlay; }
.slide-4 .slide-bg { background-image: url('img/slider/slider-4.png'); background-color: rgba(19, 78, 74, 0.85); background-blend-mode: overlay; }
```

#### 3. Doctor Images (`img/dokter/`) - 22 Files
Format: `dr. [Nama Lengkap, Sp.XX].png`

| No | File Name | Spesialisasi |
|----|-----------|---------------|
| 1 | `dr. I Gusti Putu Hery Sikesa, Sp.PD.png` | Penyakit Dalam |
| 2 | `dr. Sang Ketut Widiana, Sp.PD.png` | Penyakit Dalam |
| 3 | `dr. Tjokorda Prima Dewi Pemayun, Sp.PD.png` | Penyakit Dalam |
| 4 | `dr. Made Ayu Widyaningsih, Sp.A.png` | Anak |
| 5 | `dr. Ni Made Ayu Agustini, M. Biomed., SpA.png` | Anak |
| 6 | `dr. I Gede Agus Hendra Sujana, Sp.OG.png` | Kandungan |
| 7 | `dr. I Made Brammartha Kusuma, Sp.OG.png` | Kandungan |
| 8 | `dr. Pande Made Suwanpramana, Sp.OG.png` | Kandungan |
| 9 | `dr. Kade Agus Sudha Naryana, Sp.N.png` | Saraf |
| 10 | `dr. Ni Komang Dewi Mahayani, Sp.N.png` | Saraf |
| 11 | `dr. I G N Bagus Arimanjaya, Sp.An.png` | Anestesi |
| 12 | `dr. Manik Dirgayunitri, M.Biomed., Sp.An.png` | Anestesi |
| 13 | `dr. I Wayan Eka Arnawa, Sp.An-TI.png` | Anestesi |
| 14 | `dr. I Wayan Suwarna, S.Ked., Sp.B.png` | Bedah |
| 15 | `dr. I Putu Swastika Kepakisan, M. Biomed., Sp.B.png` | Bedah |
| 16 | `dr. I Ketut Wahyu Tri Saputra, Sp.OT.png` | Orthopedic |
| 17 | `dr. I Gede Ketut Alit Satria Nugraha, SpOT.png` | Orthopedic |
| 18 | `dr. Anak Agung Ayu Ngurah Desy Widya Putri, Sp.JP.png` | Jantung |
| 19 | `dr. Herry Juniada, Sp. Rad.png` | Radiologi |
| 20 | `dr. Ika Nurvidha Mahayanthi Mantra, Sp.MK.png` | Patologi Klinik |
| 21 | `dr. Made Minarti Witarini Dewi, Sp.PK.png` | Patologi Klinik |
| 22 | `dr. Theresia Maharani Sari Nastiti, Sp.PK.png` | Patologi Klinik |

**Usage in HTML:**
```html
<img src="img/dokter/dr. [Nama Lengkap, Sp.XX].png" alt="dr. [Nama Lengkap]">
```

#### 4. Partner/mitra Images (`img/partners/`) - 10 Files
| File | Partner Name |
|------|-------------|
| `BPJS Kesehatan.png` | BPJS Kesehatan |
| `Kabupaten Gianyar.png` | Pemerintah Kabupaten Gianyar |
| `Kominfo.png` | Kominfo |
| `Jasa Raharja.png` | Jasa Raharja |
| `JR Putera.png` | JR Putera |
| `WIKA.png` | WIKA |
| `MHC.png` | MHC |
| `APG.png` | APG |
| `OMSA MEDIC.png` | OMSA MEDIC |
| `Alila Ubud.png` | Alila Ubud |

**Usage in HTML:**
```html
<div class="partner-item"><img src="img/partners/[Partner Name].png" alt="[Partner Name]"></div>
```

#### 5. Other Images
| File | Location | Usage |
|------|----------|-------|
| `director.jpg` | Root | Foto direktur (about.html) |
| `bg_medical.jpg` | Root | Background medical image |
| `img/wbk/WBK.jpg` | wbk folder | Sertifikat WBK (Wilayah Bebas Korupsi) |

---

### Image Naming Conventions

1. **Doctor Photos**: `dr. [Nama Lengkap, Singkatan Sp.].png`
   - Contoh: `dr. I Gusti Putu Hery Sikesa, Sp.PD.png`
   - Spasi dengan koma, spasi sebelum singkatan

2. **Slider Images**: `slider-[nomor].png`
   - Format: `slider-1.png`, `slider-2.png`, dst

3. **Partner Logos**: `[Nama Partner].png`
   - Spasi diizinkan, tanpa koma

4. **Certificate Images**: `[Nama Sertifikat].jpg`
   - Format JPG untuk foto/sertifikat

---

### Image Validation Commands

```bash
# Cek semua gambar dokter ada
ls img/dokter/ | wc -l  # Harus 22

# Cek semua slider ada
ls img/slider/  # Harus slider-1.png sampai slider-4.png

# Cek logo ada
ls logo.png

# Cek partner logos
ls img/partners/ | wc -l  # Harus 10

# Validasi nama file dokter sesuai HTML
grep -o 'img/dokter/[^"]*\.png' dokter.html | sort -u > /tmp/doctor_images.txt
ls img/dokter/ | sort > /tmp/local_images.txt
diff /tmp/doctor_images.txt /tmp/local_images.txt
```

---

### Adding New Images

1. **New Doctor Photo**:
   - Simpan di `img/dokter/`
   - Format: `dr. [Nama Lengkap, Sp.XX].png`
   - Update `dokter.html` dengan tag img baru

2. **New Slider**:
   - Simpan di `img/slider/`
   - Format: `slider-[nomor].png`
   - Update CSS di `index.html`
   - Update slide HTML content

3. **New Partner Logo**:
   - Simpan di `img/partners/`
   - Format: `[Nama Partner].png`
   - Update `index.html` partner section

---

## рҹҖё Logo Editor Skill

### Logo Files in Repository

| File | Dimensions | Size | Usage |
|------|------------|------|-------|
| `logo.png` | 3543x3543 px | ~159KB | **Primary logo** (navbar, footer) |
| `logo_clean.png` | 150x105 px | ~5KB | Clean, resized version |
| `logo_cropped.png` | 150x105 px | ~4KB | Cropped version |
| `logo_original.png` | 150x150 px | ~8KB | Square original |

### Logo Requirements
- **Format**: PNG with transparency (RGBA mode)
- **Primary Logo**: Square or rectangular with padding
- **Background**: Transparent (untuk overlay di hero section)
- **Color Mode**: RGBA (supports transparency)

### Python Logo Editing (Pillow)

```bash
# Install Pillow if needed
pip install Pillow
```

#### 1. Resize Logo
```python
from PIL import Image

img = Image.open('logo.png')
# Resize maintaining aspect ratio
img.thumbnail((200, 200), Image.Resampling.LANCZOS)
img.save('logo_resized.png', optimize=True)
```

#### 2. Create Different Sizes
```python
from PIL import Image

img = Image.open('logo.png')

# Create multiple sizes
sizes = [50, 100, 150, 200]
for size in sizes:
    resized = img.copy()
    resized.thumbnail((size, size), Image.Resampling.LANCZOS)
    resized.save(f'logo_{size}.png', optimize=True)
```

#### 3. Change Logo Background
```python
from PIL import Image

# Add white background
img = Image.open('logo.png')
bg = Image.new('RGBA', img.size, (255, 255, 255, 255))
bg.paste(img, (0, 0), img)  # Use alpha channel as mask
bg.save('logo_with_bg.png')
```

#### 4. Darken/Lighten Logo
```python
from PIL import Image, ImageEnhance

img = Image.open('logo.png')

# Darken by 20%
enhancer = ImageEnhance.Brightness(img)
darker = enhancer.enhance(0.8)
darker.save('logo_dark.png')

# Lighten by 20%
lighter = enhancer.enhance(1.2)
lighter.save('logo_light.png')
```

#### 5. Change Logo Color
```python
from PIL import Image

img = Image.open('logo.png').convert('RGBA')

# Get pixels and modify
pixels = img.load()
for y in range(img.height):
    for x in range(img.width):
        r, g, b, a = pixels[x, y]
        # Make more teal (reduce red, increase blue-green)
        pixels[x, y] = (int(r*0.5), int(g*1.1), int(b*1.1), a)

img.save('logo_teal.png')
```

#### 6. Crop to Content
```python
from PIL import Image

img = Image.open('logo.png')
img = img.convert('RGBA')

# Find bounding box of non-transparent pixels
bbox = img.getbbox()
if bbox:
    cropped = img.crop(bbox)
    cropped.save('logo_cropped.png')
```

#### 7. Add Padding/Border
```python
from PIL import Image

img = Image.open('logo.png')
new_size = (img.width + 40, img.height + 40)  # Add 20px padding all sides
new_img = Image.new('RGBA', new_size, (0, 0, 0, 0))  # Transparent
new_img.paste(img, (20, 20))
new_img.save('logo_padded.png')
```

#### 8. Optimize for Web
```python
from PIL import Image

img = Image.open('logo.png')
img.save('logo_optimized.png', optimize=True, quality=85)
```

### CSS Logo Styling Reference

```css
/* Navbar Logo */
.logo img {
    width: 50px;
    height: auto;
    transition: transform 0.3s ease;
}
.logo img:hover { transform: scale(1.05); }

/* Logo Text Colors */
.logo-text { color: white; }
.navbar.scrolled .logo-text { color: #333333; }
.logo-text-sub { color: rgba(255,255,255,0.7); }
.navbar.scrolled .logo-text-sub { color: #666666; }

/* Footer Logo */
.footer-brand .logo img {
    height: 80px;
    display: block;
    margin: 0 auto 20px;
}
```

### Logo Editing Workflow

1. **Download/Select Logo** - From cPanel or external source
2. **Analyze** - Check dimensions, mode, transparency
3. **Edit** - Resize, crop, adjust colors as needed
4. **Optimize** - Compress for web performance
5. **Upload** - Replace in repository
6. **Verify** - Check in browser on different backgrounds

### Common Logo Fixes

| Issue | Solution |
|-------|----------|
| Too large | Resize with `thumbnail()` |
| Wrong background | Add/remove background with alpha paste |
| Wrong colors | Use `ImageEnhance` or pixel manipulation |
| Poor quality | Ensure high-res source, use LANCZOS resize |
| File too big | Optimize with `save(optimize=True)` |
| Transparent areas | Verify RGBA mode, not RGB |

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
