# Advanced Image Fixing Techniques

## Real Cases from Experience

### Case 1: Slider Image Blur (Payangan Hospital)

**Problem**: Hero slider-1 tidak muncul dengan benar karena gambar terlalu kecil (39KB vs 500KB+ untuk slider lain)

**Diagnosis**:
```bash
ls -lh img/slider/
# Output:
# slider-1.png    39KB  ← Too small!
# slider-1-old.png 669KB  ← Backup available
# slider-2.png  519KB
# slider-3.png  1.8MB
# slider-4.png  1.9MB
```

**Root Cause**: Versi kecil dari slider-1 yang digunakan

**Solution**:
```bash
# Replace dengan versi lebih besar
cp img/slider/slider-1-old.png img/slider/slider-1.png
rm img/slider/slider-1-old.png
```

**CSS Adjusment**:
```css
/* Semua slider gunakan cover */
.slide-1 .slide-bg {
    background-size: cover; /* Original */
}
```

**Lesson Learned**: Selalu cek ukuran file! Hero images butuh minimal 500KB untuk kualitas bagus.

---

### Case 2: Background Image Stretch

**Problem**: Gambar stretch horizontal, rasio aspek rusak

**Original CSS**:
```css
background-image: url('image.jpg');
background-size: 100% 100%; /* ❌ Stretch explicit! */
```

**Fixed CSS**:
```css
background-image: url('image.jpg');
background-size: cover; /* ✅ Zoom to fill */
background-position: center center;
```

**Alternative untuk gambar dengan rasio tetap**:
```css
background-size: contain; /* ✅ Show full without stretch */
background-repeat: no-repeat;
```

---

### Case 3: Image Path Case Sensitivity (Linux)

**Problem**: Gambar muncul di Windows/Mac tapi tidak di Linux hosting

**Root Cause**: Linux case-sensitive!
- `img/Logo.png` ≠ `img/logo.png`

**Debug**:
```bash
# Cek folder
ls -la img/

# Jika HTML pakai:
<img src="img/logo.png">

# Tapi file sebenarnya:
Logo.png (dengan L besar)
```

**Solution**: Samakan case atau rename file

---

### Case 4: Favicon/Logo Blur

**Problem**: Favicon/logo blur di retina displays

**Solution**:
```html
<!-- Multi-size favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16.png">

<!-- Atau gunakan SVG -->
<link rel="icon" href="logo.svg" type="image/svg+xml">
```

**Best Practice**: Favicon minimum 32x32, logo 2x size untuk retina

---

### Case 5: Lazy Load Image

**Problem**: Gambar tidak load saat scroll (lazy loading bermasalah)

**Solution**:
```html
<!-- Native lazy loading -->
<img src="image.jpg" loading="lazy" alt="...">

<!-- Fallback untuk browser lama -->
<img src="image.jpg" loading="lazy" alt="..."
     onerror="this.onerror=null; this.src='fallback.jpg'">
```

---

### Case 6: Background Gradient Fallback

**Problem**: Gambar background tidak load, tampilan kosong

**Solution**:
```css
.hero {
    /* Gradient fallback */
    background: linear-gradient(135deg, #0d7377 0%, #14919b 100%);
    /* Image dengan overlay */
    background-image: url('hero.jpg');
    background-size: cover;
    background-position: center;
}
```

---

## Image Optimization Tools

### CLI Tools

```bash
# ImageMagick - resize dan optimize
convert input.jpg -resize 1920x1080 -quality 85 output.jpg

# PNG optimization
optipng -o7 image.png

# JPG optimization  
jpegoptim --max=85 image.jpg

# WebP conversion
cwebp -q 80 input.jpg -o output.webp
```

### Python (Pillow)

```python
from PIL import Image

# Resize
img = Image.open('input.jpg')
img = img.resize((1920, 1080), Image.LANCZOS)
img.save('output.jpg', quality=85, optimize=True)

# Convert to WebP
img.save('output.webp', format='WEBP', quality=80)
```

### Online Services

| Service | Features | URL |
|---------|----------|-----|
| TinyPNG | PNG/JPG compression | tinypng.com |
| Squoosh | Browser-based, modern | squoosh.app |
| Cloudinary | CDN + optimization | cloudinary.com |
| ImageOptim | Mac app | imageoptim.com |

---

## Responsive Images Pattern

### HTML5 Picture Element

```html
<picture>
    <!-- AVIF untuk browser yang support -->
    <source 
        type="image/avif"
        srcset="image-400.avif 400w, image-800.avif 800w">
    
    <!-- WebP sebagai fallback -->
    <source 
        type="image/webp"
        srcset="image-400.webp 400w, image-800.webp 800w">
    
    <!-- JPG sebagai final fallback -->
    <img 
        src="image-800.jpg"
        srcset="image-400.jpg 400w, image-800.jpg 800w"
        sizes="(max-width: 600px) 400px, 800px"
        alt="Description"
        loading="lazy">
</picture>
```

### CSS Background Responsive

```css
.hero-background {
    /* Mobile first */
    background-image: url('hero-mobile.jpg');
    background-size: cover;
    background-position: center;
}

/* Tablet */
@media (min-width: 768px) {
    .hero-background {
        background-image: url('hero-tablet.jpg');
    }
}

/* Desktop */
@media (min-width: 1200px) {
    .hero-background {
        background-image: url('hero-desktop.jpg');
    }
}
```

---

## CSS Image Effects Reference

### Overlay dengan Gradient

```css
.hero {
    background: 
        linear-gradient(
            to bottom,
            rgba(0,0,0,0.3) 0%,
            rgba(0,0,0,0.6) 100%
        ),
        url('hero.jpg');
    background-size: cover;
    background-position: center;
}
```

### Blur Background

```css
.blur-bg {
    filter: blur(100px);
    transform: scale(1.2); /* Prevent edge artifacts */
}
```

### Grayscale Hover

```css
img {
    filter: grayscale(0%);
    transition: filter 0.3s ease;
}
img:hover {
    filter: grayscale(0%);
}
```

---

## Checklist Sebelum Push ke Production

### File Verification
- [ ] Semua gambar ada di folder yang benar
- [ ] Path sudah benar dan case-matched
- [ ] Ukuran file masuk akal
- [ ] Format sudah optimal (WebP dengan fallback)

### CSS Verification
- [ ] background-size sesuai use case
- [ ] background-position center
- [ ] Fallback gradient/color ada
- [ ] Mobile responsive (media queries)

### Performance
- [ ] Images di-optimize (< 200KB per gambar)
- [ ] Lazy loading untuk below-fold images
- [ ] Critical images preloaded

---

## Quick Debug Commands

```bash
# Cek semua gambar di folder
find . -name "*.png" -o -name "*.jpg" -o -name "*.webp" | head -20

# Cek ukuran file
ls -lh img/**/*.{png,jpg}

# Cek broken links (jika ada link checker)
# Cari reference ke gambar yang mungkin tidak ada

# Test di browser berbeda
# Chrome, Firefox, Safari - beda rendering
```
