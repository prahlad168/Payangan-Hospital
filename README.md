# RS Payangan Hospital — Website

![Payangan Hospital](img/logo-official.png)

## Project Overview

RS Payangan Hospital is a government-owned regional hospital website built as a static HTML/CSS/JS frontend with a PHP-based admin panel. The site serves as the primary digital presence for Payangan Hospital in Gianyar, Bali — providing information about services, doctors, facilities, and online patient engagement tools.

The project is hosted on Idwebhost (cPanel) with GitHub-backed auto-deployment via webhook.

**Domain:** [https://payanganhospital.gianyarkab.go.id/](https://payanganhospital.gianyarkab.go.id/)
**Repository:** [prahlad168/Payangan-Hospital](https://github.com/prahlad168/Payangan-Hospital)
**Type:** Government Healthcare — Non-Commercial

---

## Purpose

The website provides:

- **Public-facing hospital information** — services, doctors, facilities, contact
- **Online queue registration** — patients can register for appointments
- **AI chat assistant** — MahaCare AI helps visitors find information
- **Admin backend** — staff can manage doctors, patients, rooms, queues, and users
- **Health information** — articles and health tips for the community
- **Galery & media** — photo gallery and video content showcasing the hospital

---

## Technology Stack

| Layer | Technology |
|-------|-----------|
| **Frontend** | HTML5, CSS3, Vanilla JavaScript |
| **CSS Framework** | Custom design system (CSS custom properties) |
| **Backend (Admin)** | PHP 7+/8+ |
| **Chat Widget** | Custom vanilla JS (MahaCare AI) |
| **Chat API** | PHP (knowledge-base driven) |
| **Database (Admin)** | MySQL (schema provided, file-based auth by default) |
| **Deployment** | GitHub + Webhook + Idwebhost (cPanel) |
| **Analytics** | Google Analytics 4 |
| **Search Console** | Google Search Console |
| **Hosting** | Idwebhost (cPanel) |
| **Version Control** | Git / GitHub |

---

## Folder Structure

```
D:\PayanganWeb\
├── index.html                    # Homepage
├── about.html                    # About hospital
├── kontak.html                   # Contact page
├── galeri.html                   # Photo gallery
├── dokter.html                   # Doctor list
├── igd.html                      # Emergency room
├── layanan.html                  # Services overview
├── rawat-jalan.html             # Outpatient care
├── rawat-inap.html              # Inpatient care
├── laboratorium.html            # Laboratory
├── poli-*.html (10 files)       # Specialty pages
├── info-kesehatan-1..5.html     # Health info articles
├── faq.html                      # FAQ page
├── kepuasan-pasien.html         # Patient satisfaction
├── ph-update.html                # Health update page
├── 404.html                      # Error page
│
├── css/
│   ├── design-system.css         # Core design system (variables, layout, components)
│   ├── brand.css                 # Brand identity styles (logo, typography)
│   └── premium-upgrade.css       # Premium enhancements
│
├── js/
│   ├── premium-ui.js             # UI interactions (scroll, menu, slider)
│   └── mahacare-ai.js            # AI chat widget
│
├── rs-admin/                     # Admin panel (PHP)
│   ├── login.php                 # Authentication page
│   ├── dashboard.php             # Admin dashboard
│   ├── dokter.php                # Doctor management
│   ├── poli.php                  # Poli (department) management
│   ├── pasien.php                # Patient management
│   ├── kamar.php                 # Room management
│   ├── antrean.php               # Queue management
│   ├── igd.php                   # IGD management
│   ├── users.php                 # User management
│   ├── logout.php                # Session termination
│   ├── install.php               # Initial setup wizard
│   ├── setup-password.php        # Password configuration
│   ├── includes/
│   │   ├── auth.php              # Authentication functions
│   │   ├── header.php            # Admin header/nav component
│   │   └── footer.php            # Admin footer component
│   ├── api/
│   │   ├── chat.php              # Chat API endpoint
│   │   └── setup-api.php         # API initialization
│   └── config/
│       ├── database.php          # DB connection config
│       └── schema.sql            # MySQL database schema
│
├── api/                          # Public APIs
│   ├── chat-log.php              # Chat conversation logging
│   └── daily-report.php          # Daily report generation
│
├── img/                          # Images (logos, photos, gallery, icons)
│   ├── logo-official.png
│   ├── dokter/                   # Doctor profile photos
│   ├── slider/                   # Hero slider images
│   ├── Galeri/                   # Hospital gallery photos
│   ├── optimized/               # WebP-optimized images
│   └── ...
│
├── video/                        # Hospital videos
│
├── progress/                     # Reports, docs, marketing content
│
├── deploy.php                    # Manual deployment script
│   webhook.php                   # GitHub auto-deploy webhook
│   deploy-full.php               # Full deployment from GitHub
│
├── sitemap.xml                   # XML sitemap for SEO
├── robots.txt                    # Crawler directives
└── AGENTS.md                     # Agent workspace configuration
```

---

## Main Features

### Public Website
- **Hero section** with hospital branding, tagline, and statistics
- **Doctor slider** — horizontal scroll of specialist doctors with schedules
- **Services overview** — outpatient, inpatient, emergency, laboratory
- **Facilities gallery** — hospital building and room highlights
- **News section** — latest updates and articles
- **Online queue registration** — `antrean.html` for appointment booking
- **AI Chat Assistant (MahaCare)** — floating chat widget for visitor questions
- **Contact page** — address, phone, WhatsApp, email, Google Maps, reviews
- **Health information pages** — `info-kesehatan-*.html`
- **Responsive design** — mobile, tablet, and desktop

### Admin Panel (`rs-admin/`)
- **Role-based authentication** — Direktur, Admin, Karyawan
- **Dashboard** — role-specific statistics and recent activity
- **Doctor management** — add, edit, delete doctor profiles
- **Poly-clinic management** — configure poli departments
- **Patient management** — patient records
- **Room management** — bed/inap room configuration
- **Queue management** — antrean (appointment queue) system
- **IGD management** — emergency department management
- **User management** — admin-only user administration

### APIs
- **Chat logging** — stores conversations to JSON files
- **Daily report** — generates daily markdown reports with analytics

---

## Current Architecture

```
┌─────────────────────────────────────────────────┐
│                   USER BROWSER                   │
│  ┌──────────┐  ┌──────────┐  ┌──────────────┐  │
│  │  HTML    │  │  CSS     │  │  JavaScript   │  │
│  │  Pages   │  │  Files   │  │  (Vanilla JS) │  │
│  └────┬─────┘  └────┬─────┘  └──────┬───────┘  │
│       │              │               │           │
└───────┼──────────────┼───────────────┼───────────┘
        │              │               │
        ▼              ▼               ▼
┌─────────────────────────────────────────────────┐
│              IDWEBHOST (cPanel)                  │
│  ┌──────────────┐  ┌─────────────────────────┐ │
│  │  Static HTML │  │  PHP Backend (rs-admin/) │ │
│  │  CSS/JS      │  │  MySQL (optional)        │ │
│  │  Images      │  │  Session-based Auth      │ │
│  └──────────────┘  └─────────────────────────┘ │
└────────────────────────┬────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────┐
│               GITHUB (Remote)                    │
│  git pull via webhook.php on push              │
│  CI/CD via GitHub Actions workflows             │
└─────────────────────────────────────────────────┘
```

---

## How to Run Locally

### Prerequisites
- A web server with PHP 7.4+ (for admin panel)
- A browser for frontend viewing
- Git (for version control)
- MySQL (optional, for database-backed admin features)

### Quick Start (Frontend Only)

1. Open `index.html` in a browser, or serve the directory with any static web server:

```powershell
# PowerShell
php -S localhost:8000
```

Then visit `http://localhost:8000`.

### Running the Admin Panel

1. Ensure PHP is installed and a web server is running
2. Copy the project to your web server's document root
3. Import `rs-admin/config/schema.sql` into MySQL (if using database features)
4. Configure database connection in `rs-admin/config/database.php`
5. Access `http://localhost/rs-admin/login.php`
6. Use demo credentials:
   - **Direktur**: `direktur` / `welcomehome`
   - **Admin**: `admin` / `admin123`
   - **Karyawan**: `karyawan` / `staf2026`

---

## Deployment Overview

Development → GitHub push → Webhook triggers `webhook.php` → Server runs `git pull` → Website updated

### Deployment Methods

| Method | Trigger | Description |
|--------|---------|-------------|
| **Auto Deploy** | GitHub push | Webhook calls `webhook.php` which runs `git pull` |
| **Manual Deploy** | Visit URL | `deploy.php` downloads all files from GitHub |
| **Full Deploy** | Visit URL | `deploy-full.php` + doctor images deploy |
| **Image Deploy** | Visit URL | `deploy-image.php` updates image assets |

### Deployment Files

| File | Purpose |
|------|---------|
| `webhook.php` | GitHub webhook receiver — triggers auto-deploy |
| `deploy.php` | Manual deploy — downloads files from GitHub |
| `deploy-full.php` | Full deploy including doctor images |
| `deploy-image.php` | Image-only deploy |
| `deploy-dokter-images.php` | Doctor photo deploy |
| `.deploy-timestamp` | Records last deployment time |
| `.deploy-trigger` | Deployment trigger marker |

---

## Contribution Workflow

1. **Clone the repository**
2. **Create a feature branch** from `main`
3. **Make your changes** following coding standards
4. **Test locally** — open pages in browser, check responsiveness
5. **Commit** with a conventional commit message
6. **Push** to your feature branch
7. **Open a Pull Request** against `main`
8. **Wait for review** — at least one reviewer approval required
9. **Merge** after approval
10. **Verify deployment** — check that the website updates correctly

### Commit Message Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

**Types:** `feat`, `fix`, `docs`, `style`, `refactor`, `test`, `chore`

**Examples:**
- `feat(kontak): tambah halaman kontak dengan peta Google Maps`
- `fix(dokter): perbaiki tampilan foto dokter di slider`
- `chore(deploy): update webhook.php untuk auto-deploy`

---

## Coding Standards Summary

- **HTML5** semantic elements, Indonesian language (`lang="id"`)
- **CSS**: Use CSS custom properties (variables) from `design-system.css`
- **JavaScript**: IIFE pattern, no global pollution, ES5+ compatible
- **PHP**: PSR-style indentation, session-based auth, prepared statements for DB
- **Naming**: kebab-case for files and CSS classes, camelCase for JS variables
- **Git**: Conventional commits, branch per feature

---

## Roadmap Summary

| Phase | Focus | Timeline |
|-------|-------|----------|
| **1** | Project Stabilization | Now — Q3 2026 |
| **2** | Security Hardening | Q3 — Q4 2026 |
| **3** | Performance Optimization | Q4 2026 |
| **4** | SEO Improvements | Q1 2027 |
| **5** | UI Modernization | Q2 2027 |
| **6** | Admin Dashboard Enhancement | Q3 2027 |
| **7** | Patient Services Expansion | Q4 2027 |
| **8** | AI Assistant Enhancement | Q1 2028 |
| **9** | HIS Integration | Q2 2028 |
| **10** | Long-term Modernization | Ongoing |

See [ROADMAP.md](./ROADMAP.md) for detailed breakdown.

---

## License

This project is licensed under the [MIT License](./LICENSE).

---

## Contact

**RS Payangan Hospital**
Jl. Raya Payangan No.104, Melinggih, Kec. Payangan, Kabupaten Gianyar, Bali 80572
📞 (0361) 9088087
📧 info@payanganhospital.gianyarkab.go.id
🌐 https://payanganhospital.gianyarkab.go.id/
