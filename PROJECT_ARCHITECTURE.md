# PROJECT ARCHITECTURE

Payangan Hospital Website — System Architecture Documentation

---

## Overall Architecture

```
┌─────────────────────────────────────────────────────────┐
│                    CLIENT LAYER                          │
│  ┌─────────────────────────────────────────────────┐   │
│  │  Browser (HTML5 + CSS3 + Vanilla JS)           │   │
│  │  ┌─────────┐ ┌──────────┐ ┌────────────────┐  │   │
│  │  │ Static  │ │ Design   │ │ MahaCare AI    │  │   │
│  │  │ HTML    │ │ System   │ │ Chat Widget    │  │   │
│  │  │ Pages   │ │ CSS      │ │ (Vanilla JS)   │  │   │
│  │  └─────────┘ └──────────┘ └────────────────┘  │   │
│  └─────────────────────────────────────────────────┘   │
└───────────────────────┬───────────────────────────────┘
                        │ HTTP/HTTPS
                        ▼
┌─────────────────────────────────────────────────────────┐
│                  HOSTING LAYER                          │
│  ┌─────────────────────────────────────────────────┐   │
│  │  Idwebhost (cPanel — Shared Hosting)           │   │
│  │  ┌────────────┐  ┌────────────────────────┐   │   │
│  │  │ Nginx/Apache│  │  PHP-FPM / PHP CLI    │   │   │
│  │  └────────────┘  └────────────────────────┘   │   │
│  └─────────────────────────────────────────────────┘   │
└───────────────────────┬───────────────────────────────┘
                        │
                        ▼
┌─────────────────────────────────────────────────────────┐
│                  DATA LAYER                             │
│  ┌──────────────┐  ┌──────────────┐  ┌────────────┐  │
│  │  MySQL DB    │  │  File System │  │  GitHub     │  │
│  │  (Admin)     │  │  (Logs,      │  │  (Source    │  │
│  │              │  │   Chat logs) │  │   Control)   │  │
│  └──────────────┘  └──────────────┘  └────────────┘  │
└─────────────────────────────────────────────────────────┘
```

### Architecture Characteristics

- **Static-first**: All public pages are pure HTML/CSS/JS
- **Server-rendered admin**: PHP with sessions for the admin panel
- **No build step**: No bundler, transpiler, or compiler
- **File-based logging**: Chat and activity logs stored as JSON/text files
- **Git-backed deployment**: Content is version-controlled and deployed via webhook

---

## Frontend Architecture

### Page Model

Each page is a standalone HTML file with:
- Inline `<style>` block (page-specific overrides)
- External CSS includes (design-system.css, premium-upgrade.css, brand.css)
- External JS includes (premium-ui.js, mahacare-ai.js)
- Inline `<script>` block (page-specific logic)
- Inline Font Awesome and Google Fonts CDN imports

### Page Hierarchy

```
Homepage (index.html)
├── Hero Section
├── Director Welcome
├── Doctor Slider
├── Why Choose Us
├── Services Grid
├── Facilities Preview
├── News Preview
├── Gallery Preview
├── Emergency CTA
└── Contact Preview

About → Sambutan, Sejarah, Visi Misi, Standar Pelayanan, Maklumat, Mutu, Budaya Kerja

Doctor List → Doctor cards with specialties and schedules

Contact → Contact form, Google Maps, Reviews, Social Links

Queue (antrean.html) → Registration form for online queue

Health Info (info-kesehatan-1..5.html) → Article pages
```

### Component Model (Implicit)

Since there is no component framework, shared UI patterns are duplicated across pages:

| Component | Implementation |
|-----------|---------------|
| **Navigation** | Inline `<nav>` + `.mega-menu` in each HTML file |
| **Footer** | Inline `<footer>` in each HTML file |
| **Contact Cards** | Repeated `<div class="contact-item">` pattern |
| **Section Headers** | `.section-label` + `.section-title` + `.section-subtitle` |
| **Cards** | `.card` / `.card-service` / `.card-doctor` patterns |
| **Buttons** | `.btn`, `.btn-primary`, `.btn-outline` classes |

### Data Flow

```
User Interaction
    │
    ▼
┌─────────────────────────────────────────┐
│  premium-ui.js                          │
│  • Scroll animations (IntersectionObs)  │
│  • Header scroll effect                 │
│  • Mobile menu toggle                   │
│  • Smooth scroll to anchors             │
│  • Counter animation                    │
│  • Doctor slider (drag/touch)           │
│  • Back-to-top button                   │
│  • Form validation                      │
│  • Tabs, Accordion, Parallax            │
│  • Lazy loading images                  │
└─────────────────┬───────────────────────┘
                  │
                  ▼
┌─────────────────────────────────────────┐
│  mahacare-ai.js                         │
│  • Chat widget (floating button)        │
│  • Knowledge base matching              │
│  • Quick replies                        │
│  • Typing indicator                     │
│  • Conversation history (in-memory)     │
│  • Rating system                        │
└─────────────────────────────────────────┘
```

---

## CSS Architecture

### File Structure

```
css/
├── design-system.css    (1315 lines) — Core design tokens & components
├── brand.css            (562 lines)   — Brand identity & logo styles
└── premium-upgrade.css  (unknown)    — Premium enhancements
```

### Design Tokens (CSS Custom Properties)

Both `design-system.css` and `brand.css` define their own sets of CSS custom properties (`:root`). Key tokens include:

| Token Category | Variables |
|---------------|-----------|
| **Colors** | `--primary`, `--primary-light`, `--primary-dark`, `--secondary`, `--accent`, `--success`, `--warning`, `--danger`, `--info` |
| **Backgrounds** | `--bg-white`, `--bg-light`, `--bg-warm`, `--bg-dark`, `--bg-darker` |
| **Text** | `--text-dark`, `--text-muted`, `--text-light`, `--text-white` |
| **Gradients** | `--gradient-primary`, `--gradient-dark`, `--gradient-warm`, `--gradient-accent` |
| **Shadows** | `--shadow-xs` through `--shadow-2xl`, `--shadow-primary`, `--shadow-glow` |
| **Border Radius** | `--radius-xs` through `--radius-full` |
| **Spacing** | `--space-1` through `--space-32` |
| **Typography** | `--font-sans`, `--font-display`, `--text-*` (size scale) |
| **Transitions** | `--transition-fast`, `--transition-base`, `--transition-slow`, `--transition-smooth` |

### CSS Methodology

- **Naming**: BEM-inspired (`.block__element--modifier`) but not strictly enforced
- **Specificity**: Mostly single-class selectors; some compound selectors in components
- **Preprocessing**: None (no SASS/LESS)
- **Minification**: None (development builds only)
- **Responsive**: Mobile-first with `@media (max-width: ...)` breakpoints

### Key Breakpoints

| Breakpoint | Target |
|-----------|--------|
| `max-width: 1024px` | Tablet landscape |
| `max-width: 768px` | Tablet portrait / large phone |
| `max-width: 480px` | Mobile phone |
| `min-width: 1024px` | Desktop nav expansion |

---

## JavaScript Architecture

### File Structure

```
js/
├── premium-ui.js          (469 lines) — Core UI interactions
└── mahacare-ai.js         (852 lines) — AI chat widget
```

### premium-ui.js — Module Pattern

```
premium-ui.js (IIFE)
├── initScrollAnimations()       — IntersectionObserver for .animate-on-scroll
├── initHeaderScroll()           — Header bg change on scroll
├── initMobileMenu()             — Hamburger toggle + close on link click
├── initSmoothScroll()           — Anchor link smooth scroll with offset
├── initCounterAnimation()       — Animated number counters
├── initRippleEffect()           — Material ripple on .btn clicks
├── initLanguageSwitcher()       — ID/EN toggle (placeholder content)
├── initDoctorSlider()           — Touch/drag/swipe slider
├── initBackToTop()              — Scroll-to-top button
├── initFormValidation()         — Required field validation
├── initTabs()                   — Tab switching
├── initAccordion()              — Accordion expand/collapse
├── initParallax()               — Parallax scroll effect
├── initLazyLoading()            — IntersectionObserver lazy load images
└── init()                       — DOMContentLoaded initializer
```

### mahacare-ai.js — Chat Widget

```
mahacare-ai.js (IIFE)
├── MAHACARE_CONFIG              — Configuration (name, avatar, greetings, quick replies)
├── KNOWLEDGE_BASE               — Keyword→response mapping (6 intents)
│   ├── jadwal_dokter
│   ├── layanan_rs
│   ├── bpjs
│   ├── igd
│   ├── kontak
│   └── janji
│   └── umum
├── MahaCareAI class
│   ├── createWidget()           — DOM creation for chat button + window
│   ├── addStyles()              — Injects CSS for chat widget into <head>
│   ├── bindEvents()             — Toggle, send, quick reply events
│   ├── sendMessage()            — User message → findResponse() → bot reply
│   ├── findResponse()           — Keyword matching against knowledge base
│   ├── addMessage()             — Append message to chat window
│   ├── showTyping() / hideTyping() — Typing indicator animation
│   ├── populateQuickReplies()   — Render quick reply buttons
│   ├── toggle()                 — Open/close chat window
│   ├── updateBadge()            — Message count badge
│   ├── formatTime()             — Indonesian time formatting
│   ├── getConversationHistory() — In-memory conversation log
│   └── getSessionDuration()     — Session timer
└── DOMContentLoaded initialization
```

### JS Conventions

- **Pattern**: IIFE (Immediately Invoked Function Expression) for encapsulation
- **Strict mode**: `'use strict'` enabled in both files
- **Global scope**: `window.toggleLanguage`, `window.slideDoctors` deliberately exposed
- **No external dependencies** (except Font Awesome icons via CDN)
- **DOM manipulation**: Direct `document.getElementById`, `querySelector`, `innerHTML`
- **No framework**: No React, Vue, Angular, or jQuery

---

## API Architecture

### Endpoints

| Endpoint | Method | Purpose | Auth | Location |
|----------|--------|---------|------|----------|
| `/rs-admin/api/chat.php` | POST/GET | Chat response for MahaCare AI | None | rs-admin/ |
| `/api/chat-log.php` | POST | Log chat conversations to JSON | None (rate-limited) | api/ |
| `/api/daily-report.php` | GET/CLI | Generate daily analytics report | None (CLI only) | api/ |

### Chat API (chat.php)

```
Knowledge Base → Keyword Matching → Response
         │
         ▼
Actions: chat, quick_reply, history, clear_history, stats, agent_connect
```

### Chat Logging (chat-log.php)

- **Storage**: JSON files in `/logs/` directory (one per day)
- **Rate limiting**: 10 requests/minute per session
- **Input sanitization**: `htmlspecialchars()` + `trim()`
- **Data stored**: session_id, user_name, user_contact, user_message, bot_response, page_url, duration, rating, IP address, user agent
- **Analytics**: total conversations, common questions, average rating, peak hours

### Daily Report (daily-report.php)

- **Trigger**: Cron job (`59 23 * * *`) or manual `?run` parameter
- **Output**: Markdown file in `progress/` directory + optional email
- **Metrics**: visitors, page views, chat conversations, appointments, errors, ratings
- **Recommendations**: Auto-generated based on chat analytics and error counts

### Future API Plan
- MySQL database integration for session persistence
- RESTful API with JSON responses for all CRUD operations
- JWT or OAuth2 authentication for API endpoints

---

## Admin Panel Architecture

### Authentication Flow

```
User visits rs-admin/login.php
    │
    ▼
Session initialized with HTTPS-only, HttpOnly, SameSite=Lax cookies
    │
    ▼
Compare username/password against $demo_users array (hardcoded)
    │         (In production: should use database + password_hash())
    │
    ▼
On success: session_regenerate_id(true) → set session variables → redirect to dashboard.php
On failure: Set $error → show error message
    │
    ▼
dashboard.php includes includes/auth.php → require_login() → check session timeout (1 hour)
```

### Role-Based Access

| Role | Permissions |
|------|------------|
| **direktur** | View all dashboard stats (patients, revenue, occupancy), Laporan Direksi access |
| **admin** | Manage doctors, poli, users, all CRUD operations |
| **karyawan** | Manage queue (antrean), view dashboard stats for their role |

### Admin Panel Component Structure

```
header.php (shared)
├── Top navbar (logo, notification bell, user dropdown)
├── Sidebar (navigation menu, role-conditional items)
└── Main content wrapper
    │
    ├── login.php        — Login form
    ├── dashboard.php    — Role-specific statistics
    ├── dokter.php       — Doctor CRUD
    ├── poli.php         — Poli department management
    ├── pasien.php       — Patient records
    ├── kamar.php        — Room/bed management
    ├── antrean.php      — Queue management
    ├── igd.php          — Emergency department
    ├── users.php        — User management (admin only)
    ├── logout.php       — Session destruction
    └── setup-password.php — Initial password setup
```

### Database Schema

Located at `rs-admin/config/schema.sql` — defines tables for users, doctors, poli, patients, rooms, queues, and activities. The schema is designed for MySQL/MariaDB.

### Session Management

- Cookie params: `secure=true`, `httponly=true`, `samesite=Lax`
- Timeout: 1 hour of inactivity
- Activity tracking via `$_SESSION['last_activity']`

---

## Deployment Architecture

### Auto-Deploy Flow

```
Developer pushes to GitHub
    │
    ▼
GitHub webhook POST → webhook.php on server
    │
    ▼
webhook.php logs IP + payload
    │
    ▼
webhook.php executes: cd /home/payangan/public_html && git pull
    │
    ▼
webhook.php logs result
    │
    ▼
Website updated with latest code
```

### Manual Deploy Flow

```
Visit https://payanganhospital.gianyarkab.go.id/deploy.php
    │
    ▼
deploy.php fetches each file from GitHub raw content API
    │
    ▼
Creates directories, writes files to server filesystem
    │
    ▼
Prints deploy summary (success/failure per file)
```

### CI/CD (GitHub Actions)

Located at `.github/workflows/`:

| Workflow | Purpose |
|----------|---------|
| `00-all-agents.yml` | Run all 13 QA agents |
| `01-link-checker.yml` | Broken link detection |
| `02-pr-reviewer.yml` | Automated PR review |
| `03-qa-checker.yml` | Quality assurance checks |
| `04-deploy.yml` | Production deployment pipeline |
| `05-content-validator.yml` | Content validation |
| `06-auto-update-progress.yml` | Auto-update progress reports |
| `cloudflare-deploy.yml` | Cloudflare deployment |
| `dependabot-auto-merge.yml` | Dependabot auto-merge |
| `deploy-manual.yml` | Manual deploy trigger |
| `deploy-simple.yml` | Simple deploy workflow |
| `ssh-deploy.yml` | SSH-based deployment |
| `vercel-deploy.yml` | Vercel deployment |

### Hosting Architecture

```
┌──────────────────────────────────────────┐
│  Idwebhost (cPanel — Shared Hosting)    │
│  ┌────────────────────────────────────┐  │
│  │  /home/payangan/public_html/       │  │
│  │  ├── index.html                   │  │
│  │  ├── about.html                   │  │
│  │  ├── css/                         │  │
│  │  ├── js/                          │  │
│  │  ├── rs-admin/                    │  │
│  │  ├── api/                         │  │
│  │  ├── img/                         │  │
│  │  ├── video/                       │  │
│  │  ├── webhook.php                  │  │
│  │  ├── deploy.php                   │  │
│  │  ├── .git/ (bare or working tree) │  │
│  │  └── logs/                        │  │
│  └────────────────────────────────────┘  │
│                                          │
│  MySQL Database (if configured)          │
│  └── rs_payangan (or similar)            │
│                                          │
│  SSL/TLS (Let's Encrypt or Idwebhost)    │
└──────────────────────────────────────────┘
```

### Asset Storage

- **Images stored on server filesystem** (not in CDN)
- **Doctor photos**: `img/dokter/` (original PNG, 1–1.5MB each)
- **Optimized WebP**: `img/optimized/` (newer, smaller files)
- **Gallery photos**: `img/Galeri/` (various directories)
- **Videos**: `video/` (5 files, not git-tracked)
- **SVG icons**: `img/assistant-nurse.svg`, `img/dokter/dr-placeholder-female.svg`

### Future Architecture Considerations

1. **CDN integration** for static assets (images, CSS, JS)
2. **MySQL production database** replacing file-based auth
3. **API gateway** for all backend endpoints
4. **OAuth2 / JWT** for secure API authentication
5. **Content Delivery Network** for global image caching
6. **Redis/Memcached** for session and cache storage
7. **Containerization** (Docker) for environment consistency
8. **CI/CD pipeline** with automated testing and staging deployment
