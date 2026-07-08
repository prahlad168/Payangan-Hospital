# 📋 MASTER PROJECT DOCUMENTATION
## Payangan Hospital - MGOS Enterprise Implementation
**Version:** 1.0.0
**Last Updated:** 2026-07-07
**Owner:** i Made Purna Ananda (Pak Pur)
**AI Partner:** OpenHands Agent

---

## 📑 TABLE OF CONTENTS

1. [Chapter 1: Executive Summary](#chapter-1-executive-summary)
2. [Chapter 2: Business Vision](#chapter-2-business-vision)
3. [Chapter 3: Project Overview](#chapter-3-project-overview)
4. [Chapter 4: Technical Architecture](#chapter-4-technical-architecture)
5. [Chapter 5: Repository Structure](#chapter-5-repository-structure)
6. [Chapter 6: Design System](#chapter-6-design-system)
7. [Chapter 7: Frontend Architecture](#chapter-7-frontend-architecture)
8. [Chapter 8: Backend Preparation](#chapter-8-backend-preparation)
9. [Chapter 9: Homepage Specification](#chapter-9-homepage-specification)
10. [Chapter 10: Module Specifications](#chapter-10-module-specifications)
11. [Chapter 11: Quality Standards](#chapter-11-quality-standards)
12. [Chapter 12: Git Workflow](#chapter-12-git-workflow)
13. [Chapter 13: Deployment Guide](#chapter-13-deployment-guide)
14. [Chapter 14: Maintenance](#chapter-14-maintenance)
15. [Chapter 15: Future Development](#chapter-15-future-development)

---

## Chapter 1: Executive Summary

### 1.1 Project Name
**Payangan Hospital Website** - Sistem Informasi Manajemen Rumah Sakit (SIMRS) Web Portal

### 1.2 Organization
**Owner:** i Made Purna Ananda (Pak Pur) - CEO & Admin IT
**Institution:** RS Payangan Hospital, Gianyar, Bali, Indonesia
**Domain:** https://payanganhospital.gianyarkab.go.id/

### 1.3 Mission Statement
Membangun presence digital profesional untuk RS Payangan Hospital yang memberikan kemudahan akses informasi kesehatan bagi masyarakat Gianyar dan sekitarnya.

### 1.4 Target Audience
| Segment | Description | Needs |
|---------|-------------|-------|
| Pasien Baru | Masyarakat umum | Informasi layanan, jadwal dokter |
| Pasien Lama | Pasien kontrol | Antrean online, hasil lab |
| Keluarga Pasien | Kerabat | Info kamar, jam besuk |
| Tenaga Medis | Dokter & perawat | Dashboard internal |
| Manajemen | Direktur & staf | Laporan, statistik |

### 1.5 Success Metrics
- **Website Uptime:** 99.9%
- **Page Load Speed:** < 3 detik
- **Mobile Responsiveness:** 100%
- **SEO Score:** > 90
- **Accessibility:** WCAG 2.1 AA compliant

---

## Chapter 2: Business Vision

### 2.1 Long-term Vision
```
RS Payangan Hospital → Smart Hospital → Digital Health Ecosystem
```

### 2.2 Digital Transformation Roadmap
```
Phase 1: Website (2026-Q2) ✅
    ↓
Phase 2: RS Admin Backend (2026-Q3) →
    ↓
Phase 3: Patient Portal (2026-Q4) →
    ↓
Phase 4: Mobile App (2027-Q1) →
    ↓
Phase 5: Telemedicine (2027-Q2)
```

### 2.3 Revenue Model
| Source | Target | Status |
|--------|--------|--------|
| Government Budget | Rp 100jt/bulan | Active |
| Patient Services | Growing | Phase 2 |
| Digital Products | Rp 10jt/bulan | Planning |

### 2.4 Brand Identity
- **Tagline:** "Melayani dengan Sepenuh Hati"
- **Colors:** Teal (#0d7377), White, Gold accent
- **Tone:** Professional, Friendly, Trustworthy
- **Bahasa:** Indonesia (formal) + English (medical terms)

---

## Chapter 3: Project Overview

### 3.1 Website Pages

#### Public Pages (Frontend)
| Page | File | Purpose | Priority |
|------|------|---------|----------|
| Homepage | index.html | Landing page utama | P1 |
| About | about.html | Profil RS, direktur | P1 |
| Doctors | dokter.html | Daftar dokter spesialis | P1 |
| Services | layanan.html | Layanan yang tersedia | P1 |
| Facilities | fasilitas.html | Fasilitas RS | P2 |
| Contact | kontak.html | Info kontak & maps | P1 |
| Antrean | antrean.html | Display antrean live | P1 |
| IGD | igd.html | Emergency info | P1 |
| Poli Pages | poli-*.html | Detail per poli | P2 |

#### Admin Pages (Backend)
| Page | File | Purpose | Access |
|------|------|---------|--------|
| Login | rs-admin/login.php | Auth | All |
| Dashboard | rs-admin/dashboard.php | Stats | All |
| Doctors | rs-admin/dokter.php | CRUD dokter | Admin |
| Patients | rs-admin/pasien.php | Data pasien | Staff |
| Queue | rs-admin/antrean.php | Antrean system | Staff |
| IGD | rs-admin/igd.php | Emergency cases | Admin |
| Users | rs-admin/users.php | User management | Director |

### 3.2 Current Website Stats
```
📊 Website Statistics (as of 2026-07-07):
- Total Pages: 25+
- Total Doctors: 22+
- Total Images: 50+
- CSS Files: Embedded
- JavaScript: Minimal/Inline
- Framework: Vanilla HTML/CSS/JS
- Backend: PHP 7.4+
- Database: MySQL (prepared)
```

### 3.3 Known Issues
| Issue | Priority | Status |
|-------|----------|--------|
| Cloudflare blocking webhook | High | Pending |
| Image optimization needed | Medium | In Progress |
| SEO meta tags incomplete | Medium | Pending |
| Mobile responsive issues | Medium | Pending |
| No lazy loading | Low | Planned |

---

## Chapter 4: Technical Architecture

### 4.1 Technology Stack

#### Frontend
```
┌─────────────────────────────────────┐
│            CLIENT                   │
├─────────────────────────────────────┤
│  HTML5     │  Semantic, Accessible │
│  CSS3      │  Tailwind CDN + Custom│
│  JavaScript│  Vanilla ES6+         │
│  Icons     │  Font Awesome 6       │
│  Fonts     │  Google Fonts         │
└─────────────────────────────────────┘
```

#### Backend (Prepared)
```
┌─────────────────────────────────────┐
│            SERVER                   │
├─────────────────────────────────────┤
│  PHP 7.4+   │  Backend Logic       │
│  MySQL      │  Database            │
│  Apache     │  Web Server          │
└─────────────────────────────────────┘
```

#### Infrastructure
```
┌─────────────────────────────────────┐
│           HOSTING                   │
├─────────────────────────────────────┤
│  Provider: Idwebhost (cPanel)      │
│  Domain: payanganhospital.gianyarkab.go.id │
│  SSL: Let's Encrypt (Cloudflare)   │
│  Git: GitHub + Webhook Auto-Deploy │
└─────────────────────────────────────┘
```

### 4.2 API Endpoints (Prepared)

#### RS Admin API
```
GET  /rs-admin/api/dokter.php?action=list
POST /rs-admin/api/dokter.php?action=create
POST /rs-admin/api/dokter.php?action=update
POST /rs-admin/api/dokter.php?action=delete

GET  /rs-admin/api/antrean.php?action=list
POST /rs-admin/api/antrean.php?action=create
POST /rs-admin/api/antrean.php?action=update-status
GET  /rs-admin/api/antrean.php?action=display

GET  /rs-admin/api/users.php?action=list
POST /rs-admin/api/users.php?action=create
POST /rs-admin/api/users.php?action=update
```

### 4.3 Database Schema (Prepared)

```sql
-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    role ENUM('direktur', 'admin', 'karyawan') NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dokter Table
CREATE TABLE dokter (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nip VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    spesialisasi VARCHAR(100) NOT NULL,
    poli_id INT,
    foto VARCHAR(255),
    jadwal TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Poli Table
CREATE TABLE poli (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    dokter_id INT,
    kapasitas_harian INT DEFAULT 50,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Antrean Table
CREATE TABLE antrean (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nomor_antrean VARCHAR(10) NOT NULL,
    pasien_id INT,
    poli_id INT,
    dokter_id INT,
    status ENUM('waiting', 'called', 'serving', 'done', 'cancelled') DEFAULT 'waiting',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Pasien Table
CREATE TABLE pasien (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nik VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    tgl_lahir DATE,
    alamat TEXT,
    no_hp VARCHAR(20),
    email VARCHAR(100),
    gol_darah ENUM('A', 'B', 'AB', 'O'),
    alergi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## Chapter 5: Repository Structure

### 5.1 Current Structure
```
Payangan-Hospital/
├── index.html              # Homepage
├── about.html              # About page
├── dokter.html             # Doctor list
├── layanan.html            # Services
├── kontak.html             # Contact
├── antrean.html           # Queue display
├── igd.html               # Emergency
├── poli-*.html            # 11 poli pages
├── rs-admin/              # Backend system
│   ├── config/
│   ├── includes/
│   ├── api/
│   ├── dashboard.php
│   └── login.php
├── img/                   # Images
├── progress/              # Reports
└── webhook.php           # Auto-deploy
```

### 5.2 Proposed Structure (For Future)
```
Payangan-Hospital/
│
├── docs/                  # DOCUMENTATION
│   ├── constitution/
│   │   └── 00-PROJECT-CONSTITUTION.md
│   ├── specifications/
│   │   ├── PH-001-Homepage.md
│   │   ├── PH-002-Doctors.md
│   │   └── ...
│   ├── roadmap/
│   │   └── ROADMAP.md
│   └── reports/
│       └── MONTHLY-REPORTS/
│
├── website/               # SOURCE CODE
│   ├── src/
│   │   ├── components/
│   │   │   ├── Header.js
│   │   │   ├── Footer.js
│   │   │   ├── DoctorCard.js
│   │   │   └── ...
│   │   ├── pages/
│   │   │   ├── Home.js
│   │   │   ├── About.js
│   │   │   └── ...
│   │   └── styles/
│   │       └── main.css
│   ├── public/
│   │   ├── index.html
│   │   ├── about.html
│   │   └── ...
│   └── dist/              # Compiled output
│
├── tasks/                 # TASK MANAGEMENT
│   ├── backlog/
│   ├── in-progress/
│   └── completed/
│
├── prompts/               # AI PROMPTS
│   ├── implementation/
│   ├── review/
│   └── deployment/
│
├── tests/                 # TESTING
│   ├── unit/
│   ├── integration/
│   └── e2e/
│
├── .github/
│   └── workflows/
│       ├── ci.yml
│       └── deploy.yml
│
├── README.md
├── LICENSE
└── .gitignore
```

### 5.3 File Naming Convention
```
📁 Pages:
- index.html (lowercase, no prefix)
- about.html
- dokter.html
- [feature]-[name].html (kebab-case)

📁 Components:
- Header.js (PascalCase)
- Footer.js
- DoctorCard.js

📁 Styles:
- main.css
- components.css
- [module]-styles.css (kebab-case)

📁 Images:
- hero-bg.jpg
- doctor-[name].jpg
- logo.svg
- icon-[name].png
```

---

## Chapter 6: Design System

### 6.1 Color Palette

```css
:root {
    /* Primary Colors */
    --primary: #0d7377;           /* Teal 700 - Main brand */
    --primary-dark: #0a5a5d;      /* Teal 800 - Hover states */
    --primary-light: #14ffec;     /* Teal Accent - Highlights */
    
    /* Secondary Colors */
    --secondary: #f4c430;         /* Gold - CTAs, accents */
    --secondary-dark: #d4a017;    /* Gold Dark - Hover */
    
    /* Neutral Colors */
    --white: #ffffff;
    --gray-50: #f8f9fa;
    --gray-100: #f1f3f5;
    --gray-200: #e9ecef;
    --gray-300: #dee2e6;
    --gray-400: #ced4da;
    --gray-500: #adb5bd;
    --gray-600: #6c757d;
    --gray-700: #495057;
    --gray-800: #343a40;
    --gray-900: #212529;
    --black: #000000;
    
    /* Semantic Colors */
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
}
```

### 6.2 Typography

```css
/* Font Families */
--font-heading: 'Playfair Display', serif;
--font-body: 'Inter', sans-serif;
--font-mono: 'JetBrains Mono', monospace;

/* Font Sizes */
--text-xs: 0.75rem;      /* 12px */
--text-sm: 0.875rem;     /* 14px */
--text-base: 1rem;       /* 16px */
--text-lg: 1.125rem;     /* 18px */
--text-xl: 1.25rem;      /* 20px */
--text-2xl: 1.5rem;      /* 24px */
--text-3xl: 1.875rem;    /* 30px */
--text-4xl: 2.25rem;     /* 36px */
--text-5xl: 3rem;        /* 48px */
--text-6xl: 3.75rem;     /* 60px */

/* Line Heights */
--leading-tight: 1.25;
--leading-normal: 1.5;
--leading-relaxed: 1.75;

/* Font Weights */
--font-light: 300;
--font-normal: 400;
--font-medium: 500;
--font-semibold: 600;
--font-bold: 700;
--font-extrabold: 800;
```

### 6.3 Spacing System

```css
/* Spacing Scale (4px base) */
--space-0: 0;
--space-1: 0.25rem;      /* 4px */
--space-2: 0.5rem;       /* 8px */
--space-3: 0.75rem;      /* 12px */
--space-4: 1rem;         /* 16px */
--space-5: 1.25rem;      /* 20px */
--space-6: 1.5rem;       /* 24px */
--space-8: 2rem;         /* 32px */
--space-10: 2.5rem;      /* 40px */
--space-12: 3rem;        /* 48px */
--space-16: 4rem;        /* 64px */
--space-20: 5rem;        /* 80px */
--space-24: 6rem;        /* 96px */

/* Container Widths */
--container-sm: 640px;
--container-md: 768px;
--container-lg: 1024px;
--container-xl: 1280px;
--container-2xl: 1536px;
--container-max: 1440px;
```

### 6.4 Border Radius

```css
--radius-none: 0;
--radius-sm: 0.125rem;   /* 2px */
--radius: 0.25rem;       /* 4px */
--radius-md: 0.375rem;  /* 6px */
--radius-lg: 0.5rem;    /* 8px */
--radius-xl: 0.75rem;   /* 12px */
--radius-2xl: 1rem;     /* 16px */
--radius-3xl: 1.5rem;   /* 24px */
--radius-full: 9999px;
```

### 6.5 Shadows

```css
--shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
--shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
--shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
--shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
--shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
--shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
--shadow-inner: inset 0 2px 4px 0 rgb(0 0 0 / 0.05);
--shadow-none: none;
```

### 6.6 Breakpoints

```css
/* Mobile First */
--breakpoint-sm: 640px;    /* @media (min-width: 640px) */
--breakpoint-md: 768px;    /* @media (min-width: 768px) */
--breakpoint-lg: 1024px;   /* @media (min-width: 1024px) */
--breakpoint-xl: 1280px;   /* @media (min-width: 1280px) */
--breakpoint-2xl: 1536px;  /* @media (min-width: 1536px) */
```

---

## Chapter 7: Frontend Architecture

### 7.1 Component Library Structure

```javascript
// components/Header.js
class Header {
    constructor(options = {}) {
        this.container = options.container || document.body;
        this.theme = options.theme || 'light';
    }

    render() {
        return `
            <header class="header header--${this.theme}">
                <div class="container">
                    ${this.renderLogo()}
                    ${this.renderNav()}
                    ${this.renderCTA()}
                </div>
            </header>
        `;
    }

    renderLogo() {
        return `
            <a href="index.html" class="header__logo">
                <img src="img/logo.png" alt="RS Payangan">
                <span>RS Payangan</span>
            </a>
        `;
    }

    renderNav() {
        const navItems = [
            { label: 'Beranda', href: 'index.html' },
            { label: 'Tentang', href: 'about.html' },
            { label: 'Dokter', href: 'dokter.html' },
            { label: 'Layanan', href: 'layanan.html' },
            { label: 'Kontak', href: 'kontak.html' }
        ];
        return `
            <nav class="header__nav">
                ${navItems.map(item => `
                    <a href="${item.href}" class="nav-link">${item.label}</a>
                `).join('')}
            </nav>
        `;
    }
}
```

### 7.2 Page Template

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="[PAGE DESCRIPTION]">
    <meta name="keywords" content="[KEYWORDS]">
    <title>[PAGE TITLE] | RS Payangan Hospital</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        /* CSS Variables */
        :root { /* ... */ }
        
        /* Custom Styles */
    </style>
</head>
<body class="font-body text-gray-900 bg-white">
    <!-- Header -->
    <header>...</header>
    
    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section id="hero">...</section>
        
        <!-- Content Sections -->
        <section id="content">...</section>
    </main>
    
    <!-- Footer -->
    <footer>...</footer>
    
    <!-- Scripts -->
    <script src="js/main.js"></script>
</body>
</html>
```

### 7.3 JavaScript Architecture

```javascript
// js/main.js
/**
 * RS Payangan Hospital - Main JavaScript
 * Version: 1.0.0
 */

(function() {
    'use strict';

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', init);

    function init() {
        initNavigation();
        initAnimations();
        initForms();
        initCounters();
    }

    function initNavigation() {
        // Mobile menu toggle
        const menuBtn = document.querySelector('.mobile-menu-btn');
        if (menuBtn) {
            menuBtn.addEventListener('click', toggleMobileMenu);
        }

        // Active link highlighting
        highlightActiveLink();
    }

    function toggleMobileMenu() {
        const nav = document.querySelector('.nav-menu');
        nav.classList.toggle('hidden');
    }

    function highlightActiveLink() {
        const currentPage = window.location.pathname.split('/').pop() || 'index.html';
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            if (link.getAttribute('href') === currentPage) {
                link.classList.add('text-primary');
            }
        });
    }

    // ... more functions
})();
```

---

## Chapter 8: Backend Preparation

### 8.1 RS Admin System

**Location:** `/rs-admin/`

**Login Credentials:**
| Role | Username | Password |
|------|----------|----------|
| Direktur | direktur | welcomehome |
| Admin | admin | admin123 |
| Karyawan | karyawan | staf2026 |

**Features:**
- Dashboard with statistics
- Doctor management (CRUD)
- Patient management
- Queue/Antrean system
- IGD management
- User management (Director only)
- Activity logging

### 8.2 Authentication Flow

```php
<?php
// rs-admin/includes/auth.php

session_start();

// Check if user is logged in
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

// Check if user has specific role
function require_role($roles) {
    require_login();
    if (!in_array($_SESSION['role'], $roles)) {
        header('Location: dashboard.php?error=unauthorized');
        exit;
    }
}

// Get current user info
function get_current_user() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'nama' => $_SESSION['nama'] ?? null,
        'role' => $_SESSION['role'] ?? null
    ];
}
```

---

## Chapter 9: Homepage Specification

### 9.1 Hero Section
```
┌─────────────────────────────────────────────────────────────┐
│                    HERO SECTION                             │
├─────────────────────────────────────────────────────────────┤
│  Background: Gradient teal or medical image overlay        │
│  Content:                                                  │
│    - Badge: "Melayani dengan Sepenuh Hati"                 │
│    - H1: "RS Payangan Hospital"                            │
│    - Subtitle: "Melayani kesehatan masyarakat Gianyar..."   │
│    - CTA Button 1: "Jadwal Dokter" → dokter.html           │
│    - CTA Button 2: "Ambil Antrean" → antrean.html         │
│  Animation: Fade in on scroll                              │
└─────────────────────────────────────────────────────────────┘
```

### 9.2 Quick Stats Section
```
┌─────────────────────────────────────────────────────────────┐
│                    STATISTICS                              │
├─────────────────────────────────────────────────────────────┤
│  ┌─────────┐  ┌─────────┐  ┌─────────┐  ┌─────────┐       │
│  │ 22+     │  │ 11      │  │ 24/7    │  │ 1000+   │       │
│  │ Dokter  │  │ Poli    │  │ IGD     │  │ Pasien  │       │
│  │ Spesial │  │ Spesial │  │ Service │  │ /Bulan  │       │
│  └─────────┘  └─────────┘  └─────────┘  └─────────┘       │
└─────────────────────────────────────────────────────────────┘
```

### 9.3 Featured Doctors Section
```
┌─────────────────────────────────────────────────────────────┐
│                  DOKTER SPESIALIS                          │
├─────────────────────────────────────────────────────────────┤
│  Title: "Tim Dokter Spesialis Kami"                         │
│  Subtitle: "Dokter berpengalaman siap melayani Anda"        │
│                                                             │
│  Grid: 3 columns on desktop, 1 on mobile                   │
│  Card Content:                                              │
│    - Photo (rounded, 200x200)                              │
│    - Name (dr. [Nama], Sp.[Spesialis])                     │
│    - Specialty                                             │
│    - Schedule info                                         │
│    - "Lihat Profil" button                                 │
│                                                             │
│  CTA: "Lihat Semua Dokter" → dokter.html                   │
└─────────────────────────────────────────────────────────────┘
```

### 9.4 Services Section
```
┌─────────────────────────────────────────────────────────────┐
│                    LAYANAN KAMI                             │
├─────────────────────────────────────────────────────────────┤
│  Grid: 3x2 or 4x2 on desktop                               │
│  Card Content:                                              │
│    - Icon (Font Awesome)                                    │
│    - Title                                                 │
│    - Short description                                     │
│    - "Selengkapnya" link                                   │
│                                                             │
│  Services:                                                 │
│    1. Rawat Jalan (Umum, Spesialis)                        │
│    2. Rawat Inap (Kamar suites)                            │
│    3. IGD 24 Jam                                           │
│    4. Laboratorium                                         │
│    5. Radiologi                                            │
│    6. Apotek                                               │
└─────────────────────────────────────────────────────────────┘
```

### 9.5 Call to Action Section
```
┌─────────────────────────────────────────────────────────────┐
│              AMBIL NOMOR ANTREAN                           │
├─────────────────────────────────────────────────────────────┤
│  Background: Gradient or medical illustration              │
│  Content:                                                  │
│    - Title: "Dapatkan Antrean Online"                       │
│    - Description: "Hindari antrean panjang..."              │
│    - Button: "Ambil Antrean Sekarang"                      │
└─────────────────────────────────────────────────────────────┘
```

### 9.6 Footer
```
┌─────────────────────────────────────────────────────────────┐
│                        FOOTER                               │
├─────────────────────────────────────────────────────────────┤
│  Columns:                                                   │
│    1. Logo & Description                                    │
│    2. Quick Links                                           │
│    3. Layanan                                               │
│    4. Kontak Info                                          │
│                                                             │
│  Bottom:                                                    │
│    - Copyright © 2026 RS Payangan Hospital                  │
│    - Alamat: [Address]                                      │
│    - Telepon: [Phone] | Email: [Email]                      │
└─────────────────────────────────────────────────────────────┘
```

---

## Chapter 10: Module Specifications

### 10.1 Doctors Module

**File:** `dokter.html`

**Data Structure:**
```javascript
const doctors = [
    {
        id: 1,
        nip: "198501152010011001",
        nama: "dr. Putu Gede Mahendra, Sp.PD",
        spesialis: "Penyakit Dalam",
        poli: "Poli Penyakit Dalam",
        jadwal: {
            senin: "08:00 - 12:00",
            rabu: "08:00 - 12:00",
            jumat: "08:00 - 12:00"
        },
        foto: "img/dokter/dr-mahendra.jpg",
        pengalaman: "10 tahun"
    },
    // ... more doctors
];
```

**Display:**
- Grid layout (3 columns desktop, 1 mobile)
- Filter by specialty
- Search by name
- Sort options

### 10.2 Antrean Module

**File:** `antrean.html`

**Features:**
- Real-time queue display
- Estimated wait time
- Current serving number
- Queue statistics

**Data Flow:**
```
User → Form → API → Database
                   ↓
             WebSocket/HTTP
                   ↓
             Display Page
```

### 10.3 IGD Module

**File:** `igd.html`

**Features:**
- 24/7 Emergency contact
- Quick response info
- Emergency procedures
- Hotlines display

---

## Chapter 11: Quality Standards

### 11.1 Code Quality

```javascript
// GOOD: Clear naming, documented
/**
 * Calculate estimated wait time for queue
 * @param {number} currentPosition - Current queue position
 * @param {number} avgServiceTime - Average service time per patient (minutes)
 * @returns {string} Formatted wait time string
 */
function calculateWaitTime(currentPosition, avgServiceTime = 15) {
    const totalMinutes = currentPosition * avgServiceTime;
    const hours = Math.floor(totalMinutes / 60);
    const minutes = totalMinutes % 60;
    
    if (hours > 0) {
        return `${hours} jam ${minutes} menit`;
    }
    return `${minutes} menit`;
}

// BAD: Unclear, undocumented
function calc(p, t) {
    return p * t;
}
```

### 11.2 Accessibility Standards

```html
<!-- Images must have alt text -->
<img src="doctor.jpg" alt="Dr. Smith, Spesialis Jantung">

<!-- Forms must have labels -->
<label for="name">Nama Lengkap</label>
<input type="text" id="name" name="name">

<!-- Links must be descriptive -->
<a href="article.html">Baca selengkapnya tentang flu</a>
<!-- NOT: <a href="article.html">Selengkapnya</a> -->

<!-- Headings must be hierarchical -->
<h1>Main Title</h1>
    <h2>Section 1</h2>
        <h3>Subsection 1.1</h3>
```

### 11.3 Performance Standards

| Metric | Target | Current |
|--------|--------|---------|
| First Contentful Paint | < 1.8s | TBD |
| Largest Contentful Paint | < 2.5s | TBD |
| Time to Interactive | < 3.4s | TBD |
| Cumulative Layout Shift | < 0.1 | TBD |
| Image Optimization | WebP, lazy load | Pending |

### 11.4 Testing Requirements

```bash
# Before any deployment, verify:
1. All links work (no 404)
2. All images load
3. Forms submit correctly
4. Mobile responsive
5. Cross-browser compatibility
6. Accessibility (WAVE tool)
7. Lighthouse score > 90
```

---

## Chapter 12: Git Workflow

### 12.1 Branch Strategy

```
┌─────────────────────────────────────────────────────────────┐
│                     BRANCH STRUCTURE                       │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  main (production)                                         │
│    │                                                        │
│    └── develop (development)                               │
│          │                                                  │
│          ├── feature/PH-XXX-description                    │
│          ├── fix/PH-XXX-issue                             │
│          └── improvement/description                       │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### 12.2 Commit Convention

```
<type>(<scope>): <description>

Types:
- feat:     New feature
- fix:      Bug fix
- docs:     Documentation
- style:    Formatting (no code change)
- refactor: Code refactoring
- test:     Adding tests
- chore:    Maintenance tasks

Examples:
- feat(dashboard): add patient statistics chart
- fix(registration): resolve validation error
- docs(readme): update installation guide
- style(homepage): format code with prettier
```

### 12.3 Pull Request Process

```bash
# 1. Create feature branch
git checkout -b feature/PH-010-new-feature

# 2. Make changes and commit
git add .
git commit -m "feat(module): add new feature description"

# 3. Push to remote
git push origin feature/PH-010-new-feature

# 4. Create Pull Request on GitHub
#    - Title: "feat: Add new feature [PH-010]"
#    - Description: What, Why, How
#    - Assign reviewer

# 5. After approval, merge and delete branch
```

---

## Chapter 13: Deployment Guide

### 13.1 Deployment Pipeline

```
┌─────────────────────────────────────────────────────────────┐
│                   DEPLOYMENT FLOW                          │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  Local Dev → Git Push → GitHub                             │
│                           │                                 │
│                           ▼                                 │
│                    GitHub Webhook                           │
│                           │                                 │
│                           ▼                                 │
│              webhook.php on Hosting                         │
│                           │                                 │
│                           ▼                                 │
│                  git pull origin main                      │
│                           │                                 │
│                           ▼                                 │
│                   Website Updated ✅                        │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### 13.2 Manual Deployment (If Webhook Fails)

```bash
# Via cPanel Terminal:
cd /home/payangan/public_html
git pull origin main

# Or via File Manager:
# 1. Download files from GitHub
# 2. Upload to public_html
```

### 13.3 Rollback Procedure

```bash
# Find last good commit
git log --oneline

# Revert problematic commit
git revert <commit-hash>

# Push to trigger webhook
git push origin main
```

---

## Chapter 14: Maintenance

### 14.1 Regular Tasks

| Task | Frequency | Owner |
|------|-----------|-------|
| Update doctor schedules | Weekly | Admin |
| Check broken links | Weekly | QA |
| Update content | As needed | Admin |
| Security updates | Monthly | IT |
| Performance audit | Monthly | IT |
| Backup verification | Weekly | IT |

### 14.2 Monitoring

```bash
# Check website uptime:
# - Use uptime monitoring service
# - Set up alerts for downtime

# Check performance:
# - Google PageSpeed Insights
# - GTmetrix
# - WebPageTest

# Check SEO:
# - Google Search Console
# - Ahrefs/Semrush
```

### 14.3 Backup Strategy

| Type | Frequency | Retention |
|------|-----------|-----------|
| Code (Git) | On every push | Forever |
| Database | Daily | 30 days |
| Media files | Weekly | 90 days |
| Config files | On change | Forever |

---

## Chapter 15: Future Development

### 15.1 Phase 2: RS Admin Backend (Q3 2026)

**Features:**
- [ ] Setup MySQL database
- [ ] Complete user authentication
- [ ] Doctor CRUD
- [ ] Patient management
- [ ] Queue management
- [ ] Reports generation

### 15.2 Phase 3: Patient Portal (Q4 2026)

**Features:**
- [ ] Online registration
- [ ] Appointment booking
- [ ] Medical records access
- [ ] Payment integration
- [ ] Chat with doctor

### 15.3 Phase 4: Mobile App (Q1 2027)

**Features:**
- [ ] React Native app
- [ ] iOS & Android
- [ ] Push notifications
- [ ] Offline support
- [ ] Telemedicine integration

### 15.4 Phase 5: Telemedicine (Q2 2027)

**Features:**
- [ ] Video consultation
- [ ] E-prescription
- [ ] Digital signature
- [ ] Integration with lab results

---

## Appendix A: Quick Commands

```bash
# Development
git status
git add .
git commit -m "message"
git push origin main

# Deployment
# Push to main → webhook triggers automatically

# Testing
python3 scripts/play.py

# Check webhook
curl -X POST "https://api.github.com/repos/prahlad168/Payangan-Hospital/hooks/HOOK_ID/tests"
```

---

## Appendix B: Important URLs

| URL | Purpose |
|-----|---------|
| https://payanganhospital.gianyarkab.go.id/ | Website |
| https://payanganhospital.gianyarkab.go.id/rs-admin/ | Admin Panel |
| https://github.com/prahlad168/Payangan-Hospital | GitHub Repo |
| https://payanganhospital.gianyarkab.go.id:2083 | cPanel |

---

## Appendix C: Contact Information

| Role | Name | Access |
|------|------|--------|
| CEO | i Made Purna Ananda (Pak Pur) | Full |
| Admin IT | Pak Pur | Full |
| Hosting Support | Idwebhost | Technical |

---

**Document Status:** ✅ Complete
**Version:** 1.0.0
**Next Review:** 2026-08-07
**Owner:** Pak Pur + OpenHands Agent

---

*This document is the primary reference for all OpenHands agents working on the Payangan Hospital project.*
