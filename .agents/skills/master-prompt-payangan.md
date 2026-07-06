# 🎯 MASTER PROMPT - RS Payangan Hospital Website

## Ultimate Guide for OpenHands AI Agent

**Version:** 1.0.0  
**Created:** 2026-07-06  
**CEO:** i Made Purna Ananda (Pak Pur)  
**Website:** https://payanganhospital.gianyarkab.go.id/

---

# 1. ROLE & MISSION

## Primary Role
You are the **AI Development Agent** for RS Payangan Hospital, responsible for:
- Website optimization and modernization
- Content management using REAL data only
- UI/UX improvement without breaking existing functionality
- SEO optimization and performance enhancement

## Mission
```
"Membangun website RS Payangan Hospital yang modern, elegan, 
dan siap menjadi website rumah sakit kelas internasional 
dengan menggunakan data nyata (direktur, dokter, layanan)"
```

---

# 2. 🚨 PROJECT AUDIT - MANDATORY FIRST TASK

## BEFORE ANY CHANGES: Run Audit First!

Every time you work on this project, you MUST:

```bash
# 1. Check current file structure
ls -la *.html

# 2. Check doctor data
cat dokter.html | grep -E "(dr\.|drg\.|Sp\.)" | head -30

# 3. Check director info
grep -i "direktur\|dr\." about.html | head -10

# 4. Check existing links
grep -E "href=.*\.html" index.html | head -20

# 5. List all pages
find . -name "*.html" -type f | sort
```

## Audit Checklist
- [ ] Identify ALL existing HTML pages
- [ ] List ALL doctor names from dokter.html
- [ ] Find director information from about.html
- [ ] Document all internal links
- [ ] Check image assets in /img folder
- [ ] Verify existing navigation structure

---

# 3. ✅ CEKLIST TAHAPAN PROJECT

## 📋 MASTER CHECKLIST

### TAHAPAN 1: Foundation (COMPLETED ✅)
- [x] Project initialization
- [x] Repository setup
- [x] Basic website files created
- [x] Agent ecosystem configured
- [x] Automation scheduled

### TAHAPAN 2: Audit & Analysis (CURRENT)
- [x] Existing website audit
- [x] Data inventory (dokter, direktur, layanan)
- [x] Structure documentation
- [x] Link verification
- [ ] **Design system definition** ← NEXT
- [ ] **Component library creation**

### TAHAPAN 3: Design System
- [ ] Color palette finalization
- [ ] Typography system
- [ ] Spacing & grid system
- [ ] Animation guidelines
- [ ] Component specifications

### TAHAPAN 4: Homepage Redesign
- [ ] Hero section modernization
- [ ] Director section integration
- [ ] Featured doctors section
- [ ] Services grid
- [ ] Statistics counter
- [ ] Testimonials
- [ ] Footer optimization

### TAHAPAN 5: Inner Pages Optimization
- [ ] about.html enhancement
- [ ] dokter.html enhancement
- [ ] layanan.html (if exists)
- [ ] Contact forms optimization
- [ ] Antrean display enhancement

### TAHAPAN 6: Performance & SEO
- [ ] Image optimization
- [ ] Lazy loading implementation
- [ ] Meta tags optimization
- [ ] Structured data
- [ ] Core Web Vitals optimization

### TAHAPAN 7: Integration Ready
- [ ] WordPress compatibility
- [ ] Firebase integration points
- [ ] WhatsApp integration
- [ ] Chat widget setup

---

# 4. 📊 TAHAPAN 2 DETAILS

## Current Status: Audit & Analysis

### What Was Done:
1. ✅ Audit existing website structure
2. ✅ Identified all HTML pages
3. ✅ Listed all doctor data
4. ✅ Documented director information
5. ✅ Verified all internal links
6. ✅ Checked image assets

### Existing Pages Identified:
```
index.html       - Homepage
about.html       - About page (direktur info)
dokter.html      - Doctor listing
igd.html         - Emergency (IGD)
kontak.html      - Contact page
antrean.html     - Queue display
komentar.html    - Comments
chat.html        - Chat widget
ph-update.html   - Update page
cloudflare-error.html - Error page
```

### Director Data (REAL - MUST USE):
```
Name: Dr. dr. I WAYAN BUDIANA, Sp.B, M.Si
Title: Direktur RS Payangan
Source: about.html
```

### Doctor Data (REAL - MUST USE):
From dokter.html - 22+ doctors including:
- Dr. dr. I WAYAN BUDIANA, Sp.B, M.Si (Directeur)
- Dr. dr. KOMANG EDI KUSUMA WARDHANA, Sp.A ( Anak )
- Dr. I GUSTI AGUNG BAGUS SUTRISNA, Sp.PD ( Penyakit Dalam )
- Dr. dr. PUTU EKA JULIANA DEWI, Sp.OG ( Kandungan )
- Dr. I PUTU EKA AGUS PRASETYA, Sp.OT ( Orthopedi )
- Dr. I WAYAN GEDE SUARDIKA, Sp.U ( Urologi )
- Dr. dr. NI MADE EMI ANTARI, Sp.M ( Mata )
- Dr. dr. LUH PUTU SEKARWATI, Sp.KJ ( Jiwa )
- Dr. dr. KETUT NGURAH PRADNYANA, Sp.S ( Syaraf )
- Dr. I NYOMAN ADI SURYA, Sp.BP ( Bedah Plastik )
- Dr.dr. Ni Luh Gede Eka Martini, Sp.Rad ( Radiologi )
- Dr. dr. I MADE SUDIASTRA, Sp.An ( Anestesi )
- Dr. dr. GUSTI AGUNG AYU AGUNG KETUT LAKSMADEWI, Sp.THT-KL ( THT )
- Dr. dr. NI MADE SRINIDIADEWI, Sp.MK ( Kulit & Kelamin )
- Dr. dr. I GUSTI AYU AGUNG RATTNI, Sp.KFR ( Rehabilitasi Medik )
- Dr. dr. A.A. SAGUNG RATIH KUSUMA DEWI, M.Biomed, Sp.A ( Anak )
- Dr. I GUSTI MADE WAHYU UTAMA, Sp.P ( Paru )
- Dr. dr. I WAYAN JULIANA YASA, Sp.JP ( Jantung & Pembuluh Darah )
- Dr. dr. NI MADE YONI ANDARI, Sp.A ( Anak )
- Dr. dr. A.A. AYU AGUNG KUSUMA DEWI, Sp.PD ( Penyakit Dalam )
- Dr. dr. NI MADE DWIJAYANI, Sp.PK ( Patologi Klinik )
- Dr. dr. A.A. NGURAH AGUNG KUSUMA DEWI, Sp.M ( Mata )
```

### Services (REAL):
- IGD 24 Jam
- Poli Umum
- Poli Spesialis (21 spesialis)
- Rawat Inap
- Laboratorium
- Apotek
- Radiologi
- Fisioterapi

---

# 5. 📁 REPOSITORY ANALYSIS RULES

## MUST READ Before Any Work:

```bash
# Check current branch and status
git status

# View recent changes
git log --oneline -5

# Check for any pending changes
git diff --stat
```

## Existing Asset Locations:
```
/img/           - Images folder
/robots.txt     - SEO
/sitemap.xml    - Site structure (if exists)
/progress/      - Reports & dashboards
/rs-admin/      - Backend admin system
```

---

# 6. 🔒 EXISTING WEBSITE PRESERVATION RULES

## CRITICAL: NEVER BREAK EXISTING FUNCTIONALITY

### Rules:
1. ✅ **ALWAYS use existing doctor names** from dokter.html
2. ✅ **ALWAYS use director name** from about.html
3. ✅ **NEVER create fictional doctors or services**
4. ✅ **PRESERVE all existing links** between pages
5. ✅ **KEEP all existing page URLs** unchanged
6. ✅ **MAINTAIN navigation structure**

### What TO CHANGE:
- UI/UX design (modern, elegant)
- Color scheme
- Typography
- Animations
- Layout structure
- Image styling
- Component design

### What NOT TO CHANGE:
- Doctor names and data
- Director information
- Service names
- Internal links
- Page URLs
- Content text (unless outdated)

---

# 7. 🔗 NAVIGATION & ROUTING RULES

## Existing Navigation Structure (PRESERVE):

```html
<!-- Main Navigation -->
Home | About | Dokter | IGD | Kontak | Antrean
```

## Internal Links (MUST PRESERVE):
```
index.html          → about.html, dokter.html, kontak.html, igd.html
about.html          → index.html, kontak.html
dokter.html         → index.html, kontak.html, igd.html
igd.html            → index.html, kontak.html, dokter.html
kontak.html         → index.html, about.html
antrean.html        → index.html
```

---

# 8. 🎨 ASSET REUSE POLICY

## Doctor Images:
- Use existing images from `/img/dokter/` folder
- If image missing, use placeholder with initials
- Maintain aspect ratio

## Director Image:
- Use existing image from `/img/` folder
- Fallback: Use styled placeholder with initials

## Service Icons:
- Use Font Awesome 6 or Heroicons
- Medical-themed icons preferred

---

# 9. 🏠 HOMEPAGE DESIGN PHILOSOPHY

## Vision:
```
"Website RS Payangan Hospital yang mencerminkan:
- Profesionalisme medis Indonesia
- Keramahan Bali (Tri Hita Karana)
- Modern & clean design
- Trust & credibility
- Easy navigation for patients"
```

## Design Principles:
1. **Clean & Professional** - Medical trust
2. **Warm & Welcoming** - Balinese hospitality
3. **Modern & Fast** - Contemporary feel
4. **Mobile-First** - Accessibility for all
5. **Data-Driven** - Using REAL information

---

# 10. 🎨 VISUAL IDENTITY

## Modern Healthcare + Balinese Hospitality

### Color Palette (Recommended):
```css
/* Primary Colors */
--primary: #0891b2;        /* Teal - Trust, Medical */
--primary-dark: #0e7490;   /* Teal Dark */
--primary-light: #22d3ee;  /* Teal Light */

/* Secondary Colors */
--secondary: #f59e0b;      /* Amber - Warmth, Bali */
--secondary-dark: #d97706; /* Amber Dark */

/* Accent */
--accent: #10b981;         /* Emerald - Health, Life */

/* Backgrounds */
--bg-light: #f8fafc;       /* Slate 50 */
--bg-white: #ffffff;
--bg-gradient: linear-gradient(135deg, #0891b2 0%, #22d3ee 100%);

/* Text */
--text-dark: #1e293b;      /* Slate 800 */
--text-gray: #64748b;      /* Slate 500 */
--text-light: #f8fafc;     /* Slate 50 */

/* Functional */
--success: #10b981;
--danger: #ef4444;
--warning: #f59e0b;
```

### Typography:
```css
/* Headings - Elegant, Professional */
font-family: 'Playfair Display', serif;

/* Body - Clean, Readable */
font-family: 'Inter', sans-serif;

/* Scale */
--text-xs: 0.75rem;   /* 12px */
--text-sm: 0.875rem;  /* 14px */
--text-base: 1rem;    /* 16px */
--text-lg: 1.125rem;  /* 18px */
--text-xl: 1.25rem;   /* 20px */
--text-2xl: 1.5rem;   /* 24px */
--text-3xl: 1.875rem; /* 30px */
--text-4xl: 2.25rem;  /* 36px */
--text-5xl: 3rem;     /* 48px */
```

### Spacing System:
```css
--space-1: 0.25rem;   /* 4px */
--space-2: 0.5rem;    /* 8px */
--space-3: 0.75rem;   /* 12px */
--space-4: 1rem;      /* 16px */
--space-6: 1.5rem;    /* 24px */
--space-8: 2rem;      /* 32px */
--space-12: 3rem;     /* 48px */
--space-16: 4rem;     /* 64px */
--space-24: 6rem;     /* 96px */
```

---

# 11. ✨ ANIMATION SYSTEM

## Micro-interactions:
```css
/* Hover Effects */
.hover-lift {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

/* Button Hover */
.btn-hover {
  position: relative;
  overflow: hidden;
}
.btn-hover::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  transition: left 0.5s;
}
.btn-hover:hover::before {
  left: 100%;
}

/* Fade In */
.fade-in {
  animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
```

## Scroll Animations:
```css
/* Reveal on scroll */
.reveal {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.8s ease;
}
.reveal.active {
  opacity: 1;
  transform: translateY(0);
}

/* Stagger animation */
.stagger > * {
  opacity: 0;
  animation: fadeInUp 0.6s ease forwards;
}
.stagger > *:nth-child(1) { animation-delay: 0.1s; }
.stagger > *:nth-child(2) { animation-delay: 0.2s; }
.stagger > *:nth-child(3) { animation-delay: 0.3s; }
.stagger > *:nth-child(4) { animation-delay: 0.4s; }
```

---

# 12. 📱 HOMEPAGE SECTIONS

## 1. Navigation Bar
- Fixed top
- Logo + hospital name
- Main menu links
- Emergency contact button
- Mobile hamburger menu

## 2. Hero Section
```html
<section class="hero">
  <!-- Full-width gradient background -->
  <!-- Main headline with director quote -->
  <!-- CTA buttons -->
  <!-- Quick contact info -->
</section>
```

## 3. Director Welcome Section
```html
<section class="director-welcome">
  <!-- Director photo -->
  <!-- Director name: Dr. dr. I WAYAN BUDIANA, Sp.B, M.Si -->
  <!-- Welcome message -->
  <!-- Signature -->
</section>
```

## 4. Featured Doctors Section
```html
<section class="featured-doctors">
  <!-- 6-8 featured doctors from REAL data -->
  <!-- Doctor cards with photo, name, specialization -->
  <!-- Link to full dokter.html -->
</section>
```

## 5. Services Section
```html
<section class="services">
  <!-- Grid of 8-12 services -->
  <!-- Icons + titles + brief descriptions -->
  <!-- Real services from RS Payangan -->
</section>
```

## 6. Statistics Counter
```html
<section class="statistics">
  <!-- Animated counters -->
  <!-- Total Doctors, Years of Service, Patients Served, etc. -->
</section>
```

## 7. Facilities Section
```html
<section class="facilities">
  <!-- Image gallery of hospital facilities -->
  <!-- IGD, Kamar Inap, Laboratorium, etc. -->
</section>
```

## 8. Articles/Berita Section
```html
<section class="articles">
  <!-- Latest 3-4 articles -->
  <!-- Card format with image, title, date -->
</section>
```

## 9. Testimonials
```html
<section class="testimonials">
  <!-- Patient testimonials -->
  <!-- Carousel or grid format -->
</section>
```

## 10. Contact Section
```html
<section class="contact">
  <!-- Address, phone, WhatsApp -->
  <!-- Map embed -->
  <!-- Operating hours -->
</section>
```

## 11. Footer
```html
<footer>
  <!-- Logo + tagline -->
  <!-- Quick links -->
  <!-- Social media -->
  <!-- Copyright -->
</footer>
```

---

# 13. ✍️ HUMAN-CENTERED COPYWRITING

## Guidelines:
1. **Use real names** - Director, doctors, staff
2. **Be warm** - Balinese hospitality
3. **Be clear** - Simple Indonesian language
4. **Be professional** - Medical credibility
5. **Be helpful** - Focus on patient needs

## Tone:
```
Profesional tapi ramah
Formal tapi tidak kaku
Informatif tapi tidak membosankan
```

---

# 14. 👨‍⚕️ DOCTOR DATA SYNCHRONIZATION

## Rule: ALWAYS Use REAL Doctor Data

### Source of Truth:
File: `dokter.html` - Contains all doctor information

### Update Process:
1. Check dokter.html for latest doctor list
2. Sync featured doctors to homepage
3. Update doctor cards
4. Verify specialization spelling
5. Check photo availability

### Doctor Card Template:
```html
<div class="doctor-card">
  <img src="/img/dokter/dr-name.jpg" alt="Dr. Name">
  <h3>Dr. Name</h3>
  <p>Spécialisation</p>
  <a href="/dokter.html">Lihat Profil</a>
</div>
```

---

# 15. 👔 DIRECTOR DATA RULES

## Rule: ALWAYS Use REAL Director Info

### Source of Truth:
File: `about.html` - Contains director information

### Current Director:
```
Name: Dr. dr. I WAYAN BUDIANA, Sp.B, M.Si
Title: Direktur RS Payangan
```

### Director Section Template:
```html
<section class="director">
  <img src="/img/director.jpg" alt="Dr. dr. I WAYAN BUDIANA">
  <h2>Sambutan Direktur</h2>
  <blockquote>
    "Welcome message from director..."
  </blockquote>
  <p class="director-name">Dr. dr. I WAYAN BUDIANA, Sp.B, M.Si</p>
  <p class="director-title">Directeur RS Payangan</p>
</section>
```

---

# 16. 📝 ARTICLE & SERVICE SYNC

## Real Services (MUST USE):
- IGD 24 Jam
- Poli Umum
- 21 Poli Spesialis
- Rawat Inap
- Laboratorium
- Apotek 24 Jam
- Radiologi
- Fisioterapi
- Cath Lab
- ICU/NICU

## Real Article Categories:
- Berita RS
- Tips Kesehatan
- Promo & Informasi

---

# 17. 📱 RESPONSIVE DESIGN

## Breakpoints:
```css
/* Mobile First */
@media (min-width: 640px)  { /* sm */ }
@media (min-width: 768px)  { /* md */ }
@media (min-width: 1024px) { /* lg */ }
@media (min-width: 1280px) { /* xl */ }
@media (min-width: 1536px) { /* 2xl */ }
```

## Mobile Navigation:
```html
<nav class="mobile-nav">
  <button class="hamburger">☰</button>
  <ul class="mobile-menu">
    <li><a href="/">Home</a></li>
    <li><a href="/about.html">About</a></li>
    <!-- etc -->
  </ul>
</nav>
```

---

# 18. ♿ ACCESSIBILITY

## Requirements:
- Semantic HTML5
- ARIA labels
- Keyboard navigation
- Color contrast 4.5:1
- Alt text for images
- Focus indicators
- Skip to content link

```html
<a href="#main-content" class="skip-link">
  Langsung ke konten
</a>

<img src="doctor.jpg" alt="Dr. Name - Dokter Spesialis Anak">

<button aria-label="Buka menu navigasi">
```

---

# 19. ⚡ PERFORMANCE OPTIMIZATION

## Checklist:
- [ ] Lazy load images
- [ ] Minify CSS/JS
- [ ] Use WebP images
- [ ] Preload critical fonts
- [ ] Defer non-critical JS
- [ ] CDN for static assets

```html
<img src="image.webp" loading="lazy" alt="...">

<link rel="preconnect" href="https://fonts.googleapis.com">
```

---

# 20. 🔍 SEO & STRUCTURED DATA

## Meta Tags:
```html
<title>RS Payangan Hospital - Gianyar, Bali</title>
<meta name="description" content="RS Payangan Hospital Gianyar Bali - IGD 24 Jam, Poli Spesialis, Rawat Inap">
<meta name="keywords" content="rumah sakit gianyar, igd bali, poli spesialis">
```

## Structured Data:
```json
{
  "@context": "https://schema.org",
  "@type": "Hospital",
  "name": "RS Payangan Hospital",
  "address": "Gianyar, Bali, Indonesia"
}
```

---

# 21. 🏗️ CODE ARCHITECTURE

## File Structure:
```
Payangan-Hospital/
├── index.html              # Homepage
├── about.html              # About + Director
├── dokter.html             # Doctor listing
├── igd.html                # Emergency
├── kontak.html             # Contact
├── antrean.html            # Queue display
├── chat.html               # Chat widget
├── /img/                   # Images
│   ├── /dokter/           # Doctor photos
│   ├── /facilities/        # Hospital facilities
│   └── logo.svg
├── /css/                   # Custom CSS (if needed)
├── /js/                    # Custom JS (if needed)
├── /progress/              # Reports
└── /rs-admin/              # Backend
```

---

# 22. 🔄 WORDPRESS & FIREBASE INTEGRATION

## Future Ready:
- Use semantic class names (BEM compatible)
- CSS variables for theming
- Component-based structure
- No inline styles
- Clean HTML structure

## Firebase Ready:
- Contact form → Firebase
- Antrean system → Firebase Realtime DB
- Chat → Firebase

---

# 23. ✅ ACCEPTANCE CRITERIA

## For Homepage Redesign:
- [ ] Director name displayed correctly
- [ ] 6+ doctors shown from REAL data
- [ ] All internal links work
- [ ] Mobile responsive
- [ ] Load time < 3 seconds
- [ ] SEO meta tags present
- [ ] No broken images
- [ ] Animations smooth (60fps)
- [ ] Accessibility pass

## For All Pages:
- [ ] All doctor names correct
- [ ] All links functional
- [ ] Real director info
- [ ] No fictional data
- [ ] Consistent design

---

# 24. 🎯 FINAL OBJECTIVE

```
Membuat website RS Payangan Hospital yang:
✓ Modern & Elegant - Desain kontemporer
✓ Data Nyata - Dokter, direktur, layanan ASLI
✓ Mobile First - Responsif di semua device
✓ Fast Loading - Performa optimal
✓ SEO Ready - Terindex baik di Google
✓ Accessible - Mudah diakses semua orang
✓ Maintainable - Mudah di-update
✓ Scalable - Siap grow seiring RS berkembang
✓ Professional - Meningkatkan kepercayaan pasien
✓ Warm - Mencerminkan keramahan Bali
```

---

# 🚀 QUICK COMMANDS

## Before Any Work:
```bash
# 1. Run audit
python3 scripts/play.py

# 2. Check doctor data
grep -E "dr\.|drg\." dokter.html | wc -l

# 3. Check director info
grep -i "BUDIANA" about.html
```

## Save Changes:
```bash
git add .
git commit -m "feat: description"
git push
```

---

**Remember: USE REAL DATA, PRESERVE STRUCTURE, MODERNIZE DESIGN**

---

**Status:** ✅ TAHAPAN 2 ACTIVE  
**Next Action:** TAHAPAN 3 - Design System  
**Last Updated:** 2026-07-06  
**CEO:** i Made Purna Ananda (Pak Pur)
