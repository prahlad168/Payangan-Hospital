# CHANGELOG

Payangan Hospital Website — Version History

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [0.1.0] — 2026-07-30

### Initial Baseline

First documented release of the Payangan Hospital Website. This version represents the current state of the project as committed.

#### Added

- Public-facing hospital website with responsive design
- Homepage with hero section, doctor slider, services overview, and statistics
- Doctor list page with specialist profiles and schedules
- Contact page with form, Google Maps embed, and social media links
- Photo gallery page
- About page (Sambutan Direktur, Sejarah, Visi Misi, Standar Pelayanan, Maklumat, Mutu, Budaya Kerja)
- Emergency room (IGD) information page
- Online queue registration (`antrean.html`)
- Health information articles (`info-kesehatan-1..5.html`)
- FAQ page and patient satisfaction page
- Health update page (`ph-update.html`)
- AI chat assistant (MahaCare AI widget — `js/mahacare-ai.js`)
- Premium UI interactions (`js/premium-ui.js` — scroll animations, sliders, forms)
- CSS design system (`css/design-system.css` — variables, layout, components)
- Brand identity CSS (`css/brand.css` — logo, typography)
- Premium upgrade CSS (`css/premium-upgrade.css`)
- Admin panel (`rs-admin/`) with role-based authentication
  - Direktur, Admin, and Karyawan roles
  - Dashboard with role-specific statistics
  - Doctor, poli, patient, room, queue, IGD management
  - User management (admin-only)
- Chat API endpoint (`rs-admin/api/chat.php`) with knowledge base
- Chat conversation logging (`api/chat-log.php`)
- Daily analytics report (`api/daily-report.php`)
- Auto-deploy webhook (`webhook.php` — GitHub push triggers `git pull`)
- Manual deployment scripts (`deploy.php`, `deploy-full.php`, `deploy-image.php`)
- MySQL database schema (`rs-admin/config/schema.sql`) and DB config (`rs-admin/config/database.php`)
- SEO assets: `sitemap.xml`, `robots.txt`
- Google Analytics 4 integration (G-J1reQucPQjag7_qykixErA)
- Google Search Console verification
- 404 error page
- Deployment configuration (`.deploy-timestamp`, `.deploy-trigger`)
- GitHub Actions workflows (13 QA/CI/CD pipelines)

#### Known Issues

- `sitemap.xml` references deleted pages (`berita.html`, `antrean.html`)
- `webhook.php` does not verify a shared secret token
- `deploy.php` IP restriction is commented out
- Chat API uses `Access-Control-Allow-Origin: *` (overly permissive for production)
- Admin auth uses hardcoded credentials (should use database + hashed passwords in production)
- Three CSS files have overlapping custom properties and duplicate styles
- Many HTML pages contain inline `<style>` blocks duplicating external CSS
- Google Analytics snippet is hardcoded in each page (not via external script file)
- `css/premium-upgrade.css` contents not fully audited
- Doctor photos are large PNG files (1–1.5MB each) requiring optimization
- `video/` directory is not git-tracked

#### Security Notes

This is an initial baseline release. Security hardening is planned for a future release (see Phase 2 in the roadmap).

#### Documentation

This changelog is part of the initial documentation set.
