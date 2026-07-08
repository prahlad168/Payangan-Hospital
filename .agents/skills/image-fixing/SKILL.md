---
name: image-fixing
description: This skill should be used when the user asks to "perbaiki gambar", "fix image", "gambar blurry", "gambar pecah", "gambar kecil", "gambar stretch", "image quality", "gambar tidak muncul", "image optimization", "compress image", atau setiap kali ada masalah dengan gambar di website (tidak tampil, blur, stretch, kecil, atau kualitas buruk).
---

# Image Fixing Skill

## Overview

Skill untuk mendiagnosis dan memperbaiki masalah gambar di website. Dari pengalaman nyata, masalah gambar yang paling umum adalah:

1. **Gambar tidak muncul** - Path salah atau file tidak ada
2. **Gambar kecil/pecah** - Resolusi terlalu rendah
3. **Gambar stretch/blur** - CSS background-size salah
4. **Gambar tidak responsive** - Ukuran fixed pixel
5. **File terlalu besar** - Affects loading time

## Common Issues & Solutions

### Issue 1: Gambar Kecil (Low Resolution)

**Gejala**: Gambar tampil kecil, pecah, atau blur saat di-zoom
**Penyebab**: File gambar resolusinya rendah (biasanya < 100KB untuk hero image)

**Solusi**:
```bash
# Cek ukuran file
ls -lh img/slider/*.png

# Typical sizes untuk hero/slider:
# - Good: 500KB - 2MB
# - Bad: < 100KB (pasti blur/stretched)

# Jika ada backup dengan ukuran lebih besar:
cp img/slider/slider-1-old.png img/slider/slider-1.png
```

**Pendekatan Terbaik**:
1. Cek apakah ada versi lebih besar (biasanya berakhiran `-old` atau di folder backup)
2. Replace dengan versi lebih besar
3. Jika tidak ada, pertimbangkan download dari sumber asli atau buat ulang

### Issue 2: CSS Background-Size Stretch

**Gejala**: Gambar stretch horizontal atau vertikal, rasio aspek rusak
**Penyebab**: `background-size` tidak cocok dengan ukuran gambar

**CSS Solutions**:

```css
/* Pilihan 1: Cover (paling umum untuk hero/slider) */
background-size: cover;
/* Gambar zoom till menutupi seluruh area, mungkin crop */

/* Pilihan 2: Contain (untuk gambar dengan rasio tetap) */
background-size: contain;
/* Gambar tampil penuh tanpa crop/stretch */

/* Pilihan 3: 100% 100% (stretch explicitly) */
background-size: 100% 100%;
/* WARNING: Ini akan stretch gambar! */

/* Untuk gambar kecil: */
.slide-1 .slide-bg {
    background-size: contain; /* Jangan stretch */
    background-repeat: no-repeat;
    background-position: center center;
}
```

### Issue 3: Gambar Tidak Muncul (404/Path Issue)

**Gejala**: Placeholder kosong atau broken image icon
**Penyebab**: 
- Path file salah
- File tidak ada
- Case-sensitive path (Linux case-sensitive!)

**Debug Steps**:
```bash
# Cek file exists
ls -la img/slider/slider-1.png

# Cek case-sensitive (Linux)
# Wrong: slider-1.png
# Right: Slider-1.png (jika aslinya begitu)

# Cek file di folder
ls img/
ls img/slider/
```

**Solusi di HTML**:
```html
<!-- Check path di src/srcset -->
<img src="img/slider/slider-1.png" alt="...">

<!-- Jika local development OK tapi hosting error: -->
<!-- Kemungkinan case-sensitive issue -->
```

### Issue 4: Responsive Image

**Gejala**: Gambar terlalu besar di mobile atau terlalu kecil di desktop
**Penyebab**: Ukuran fixed pixel

**CSS Solution**:
```css
/* Gunakan max-width, bukan width */
img {
    max-width: 100%;
    height: auto; /* Maintain aspect ratio */
}

/* Responsive slider dengan aspect ratio */
.hero-slider {
    aspect-ratio: 16/9;
    /* atau */
    height: 56.25vw; /* 16:9 ratio */
}
```

## Image Quality Guidelines

### Recommended Sizes

| Use Case | Min Resolution | Recommended | Max File Size |
|----------|---------------|-------------|---------------|
| Favicon | 16x16 | 32x32, 64x64 | 5KB |
| Thumbnail | 150x150 | 300x300 | 20KB |
| Card Image | 300x200 | 600x400 | 50KB |
| Blog Post | 600x400 | 1200x800 | 200KB |
| Hero/Slider | 1200x800 | 1920x1080 | 500KB-2MB |
| Background | 1920x1080 | 2560x1440 | 1-3MB |

### Format Decision Tree

```
Apakah gambar perlu transparan?
├── YA → PNG
└── TIDAK
    ├── Apakah gambar foto/realistic?
    │   ├── YA → JPG (quality 80-85%)
    │   └── TIDAK → PNG atau WebP
    └── Apakah perlu animasi?
        ├── YA → GIF atau WebP
        └── TIDAK → JPG atau WebP
```

### Modern Formats

| Format | Browser Support | Use Case | Compression |
|--------|---------------|----------|-------------|
| WebP | Modern browsers | Photos, graphics | 25-35% smaller than JPG |
| AVIF | Chrome, Firefox | Photos | 50% smaller than JPG |
| SVG | All | Icons, logos, vectors | Scales infinitely |

## Diagnostic Workflow

### Step 1: Identify the Problem

```bash
# 1. Cek file exists dan ukuran
ls -lh img/folder/problem-image.png

# 2. Cek dimensi (jika PIL available)
python3 -c "
from PIL import Image
img = Image.open('img/folder/image.png')
print(f'Size: {img.size}')
print(f'Mode: {img.mode}')
"

# 3. Cek file format
file img/folder/image.png
```

### Step 2: Check CSS

```css
/* Temukan rule yang apply ke gambar */
.class-name {
    background-image: url('path/to/image.png');
    background-size: cover|contain|100% 100%; /* Check this! */
    background-position: center;
}
```

### Step 3: Fix

Based on diagnosis:
1. Replace dengan gambar berkualitas lebih tinggi
2. Adjust CSS background-size
3. Fix path
4. Optimize/compress jika perlu

## Quick Reference

### Check Image Quality
```bash
# File size (semakin besar umumnya = lebih berkualitas)
ls -lh *.png *.jpg

# Typical hero image: > 200KB
# Tiny icon: < 10KB
```

### CSS Background-Size Values
| Value | Behavior | Use Case |
|-------|----------|----------|
| `cover` | Zoom to fill (may crop) | Hero, slider |
| `contain` | Show full (may letterbox) | Logo, icon backgrounds |
| `auto` | Natural size | Regular images |
| `100%` | Stretch to width | ❌ AVOID |

### Responsive Image HTML
```html
<img 
    src="image-400.jpg"
    srcset="
        image-400.jpg 400w,
        image-800.jpg 800w,
        image-1200.jpg 1200w
    "
    sizes="(max-width: 600px) 400px, (max-width: 1200px) 800px, 1200px"
    alt="Description"
    loading="lazy"
>
```

## Troubleshooting Checklist

- [ ] File exists di folder yang benar
- [ ] Path case-sensitive (check Linux)
- [ ] Ukuran file masuk akal (> 50KB untuk hero)
- [ ] CSS background-size sesuai
- [ ] Background-position center
- [ ] No CSS overflow/clip issues
- [ ] Image format supported browser

## When to Escalate

Jika masalah tidak bisa di-fix dengan CSS atau replace image, kemungkinan perlu:
1. Download/generate gambar baru dengan resolusi lebih tinggi
2. Redesign layout jika gambar tidak cocok
3. Konsultasi dengan desainer
