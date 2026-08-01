# ROADMAP

Payangan Hospital Website — Product Roadmap

---

## Overview

This roadmap outlines the planned evolution of the Payangan Hospital Website over the next 24 months. The plan is structured in 10 phases, each building on the previous one to progressively enhance the platform in terms of stability, security, performance, functionality, and integration.

```
Phase 1  ████████░░░░░░░░░░░░░░  Project Stabilization         Q3 2026
Phase 2  ████████████░░░░░░░░░░  Security Improvements          Q3–Q4 2026
Phase 3  ██████████████░░░░░░░░  Performance Optimization       Q4 2026
Phase 4  ████████████████░░░░░░  SEO Improvements             Q1 2027
Phase 5  ██████████████████░░░░  UI Modernization             Q2 2027
Phase 6  ████████████████████░░  Admin Dashboard Enhancement  Q3 2027
Phase 7  ██████████████████████  Patient Services Expansion   Q4 2027
Phase 8  ██████████████████████  AI Assistant Enhancement     Q1 2028
Phase 9  ██████████████████████  HIS Integration              Q2 2028
Phase 10 ██████████████████████  Long-term Modernization      Ongoing
```

---

## Phase 1: Project Stabilization

### Timeline
Q3 2026 (current)

### Goals
- Stabilize the existing codebase
- Document all known issues and debt
- Establish coding standards and contribution workflow
- Ensure CI/CD pipelines are functional
- Complete audit of all project files

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 1.1 | Audit all HTML, CSS, JS, and PHP files | High | Developer | In Progress |
| 1.2 | Create documentation (README, ARCHITECTURE, etc.) | High | Developer | Complete |
| 1.3 | Fix broken links and missing assets | High | Developer | Pending |
| 1.4 | Remove inline `<style>` blocks duplicated from external CSS | Medium | Developer | Pending |
| 1.5 | Consolidate CSS variables into single source of truth | Medium | Developer | Pending |
| 1.6 | Verify all CI/CD GitHub Actions workflows pass | Medium | Developer | Pending |
| 1.7 | Optimize doctor photo files (compress, convert to WebP) | Medium | Developer | Pending |
| 1.8 | Fix sitemap.xml to remove references to deleted pages | Medium | Developer | Pending |

### Deliverables
- Complete project documentation
- All known issues catalogued in `CHANGELOG.md` and this roadmap
- Stable, deployable baseline

---

## Phase 2: Security Improvements

### Timeline
Q3–Q4 2026

### Goals
- Harden security across the entire application
- Eliminate common vulnerabilities
- Implement proper authentication infrastructure

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 2.1 | Add webhook secret verification to `webhook.php` | Critical | Developer | Pending |
| 2.2 | Enable IP restriction in `deploy.php` | Critical | Developer | Pending |
| 2.3 | Restrict `Access-Control-Allow-Origin` in `rs-admin/api/chat.php` | High | Developer | Pending |
| 2.4 | Move admin passwords to database with `password_hash()` | Critical | Developer | Pending |
| 2.5 | Add CSRF tokens to all admin forms | High | Developer | Pending |
| 2.6 | Implement rate limiting on chat API endpoints | High | Developer | Pending |
| 2.7 | Add `Content-Security-Policy` headers | High | Developer | Pending |
| 2.8 | Remove hardcoded Google Analytics ID from HTML pages | Medium | Developer | Pending |
| 2.9 | Enable HTTPS enforcement (HSTS) | High | DevOps | Pending |
| 2.10 | Add security headers (`X-Content-Type-Options`, `X-Frame-Options`, etc.) | High | Developer | Pending |
| 2.11 | Implement session fixation protection | High | Developer | Pending |
| 2.12 | Secure `logs/` directory with `.htaccess` or `nginx.conf` | High | Developer | Pending |

### Deliverables
- Security audit report
- Hardened admin authentication
- Proper webhook security
- Security headers configured

---

## Phase 3: Performance Optimization

### Timeline
Q4 2026

### Goals
- Reduce page load times significantly
- Improve Core Web Vitals scores
- Optimize asset delivery

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 3.1 | Convert all PNG images to WebP format | High | Developer | Pending |
| 3.2 | Compress all images (target <200KB per image) | High | Developer | Pending |
| 3.3 | Minify CSS and JavaScript files | Medium | Developer | Pending |
| 3.4 | Implement lazy loading for images and iframes | Medium | Developer | Pending |
| 3.5 | Defer non-critical JavaScript | Medium | Developer | Pending |
| 3.6 | Extract inline `<style>` and `<script>` to external files | Medium | Developer | Pending |
| 3.7 | Implement image lazy loading for gallery and doctor photos | Medium | Developer | Pending |
| 3.8 | Enable gzip/brotli compression on server | High | DevOps | Pending |
| 3.9 | Configure browser caching headers for static assets | Medium | DevOps | Pending |
| 3.10 | Add CDN for static assets | Low | DevOps | Pending |
| 3.11 | Achieve Lighthouse Performance score ≥ 85 | High | Developer | Pending |
| 3.12 | Reduce total page size under 1.5MB | Medium | Developer | Pending |

### Deliverables
- Optimized image assets
- Minified and deferred CSS/JS
- Improved Lighthouse scores
- Faster page load times

---

## Phase 4: SEO Improvements

### Timeline
Q1 2027

### Goals
- Improve search engine visibility and ranking
- Ensure all pages are properly indexed
- Fix existing SEO issues

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 4.1 | Fix `sitemap.xml` to remove deleted pages (`berita.html`, `antrean.html`) | Critical | Developer | Pending |
| 4.2 | Generate and submit sitemaps for all active pages | High | Developer | Pending |
| 4.3 | Add Open Graph tags to all pages | Medium | Developer | Pending |
| 4.4 | Add Twitter Card meta tags | Medium | Developer | Pending |
| 4.5 | Add structured data (Schema.org) to all doctor cards | Medium | Developer | Pending |
| 4.6 | Add structured data for LocalBusiness (hospital) | High | Developer | Pending |
| 4.7 | Optimize meta descriptions for all pages | Medium | Developer | Pending |
| 4.8 | Add `hreflang` tags for multilingual support (future) | Low | Developer | Pending |
| 4.9 | Fix canonical URLs for all pages | Medium | Developer | Pending |
| 4.10 | Internal linking audit — add contextual links between pages | Medium | Developer | Pending |
| 4.11 | Submit sitemap to Google Search Console | Medium | Developer | Pending |
| 4.12 | Add FAQ schema to FAQ page | Medium | Developer | Pending |

### Deliverables
- Corrected sitemap.xml
- Complete Open Graph and Schema.org markup
- Improved Google Search Console metrics

---

## Phase 5: UI Modernization

### Timeline
Q2 2027

### Goals
- Bring the design system up to modern standards
- Improve visual consistency and user experience
- Introduce design tokens and component patterns

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 5.1 | Introduce CSS custom properties as single source of truth across all CSS files | High | Developer | Pending |
| 5.2 | Remove duplicate styles across `design-system.css`, `brand.css`, and `premium-upgrade.css` | High | Developer | Pending |
| 5.3 | Add micro-interactions for hover/focus states on all interactive elements | Medium | Developer | Pending |
| 5.4 | Implement smooth scroll-smooth behavior | Low | Developer | Pending |
| 5.5 | Add dark mode support (system preference toggle) | Medium | Developer | Pending |
| 5.6 | Improve typography scale and line heights | Medium | Developer | Pending |
| 5.7 | Add focus-visible styles for keyboard navigation | High | Developer | Pending |
| 5.8 | Improve toast/notification system (replace alerts) | Medium | Developer | Pending |
| 5.9 | Add loading skeleton screens for async content | Low | Developer | Pending |
| 5.10 | Modernize contact page layout (flexbox/grid alignment) | Medium | Developer | Pending |

### Deliverables
- Unified design system
- Dark mode support
- Modernized UI components
- Improved accessibility

---

## Phase 6: Admin Dashboard

### Timeline
Q3 2027

### Goals
- Enhance the admin panel with richer features and better UX
- Add reporting and analytics capabilities
- Improve the management experience

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 6.1 | Add data tables with sorting, filtering, and pagination | High | Developer | Pending |
| 6.2 | Add export to CSV/Excel for all data tables | Medium | Developer | Pending |
| 6.3 | Implement bulk actions (delete, export, update status) | Medium | Developer | Pending |
| 6.4 | Add charts and graphs to dashboard (chart.js or similar) | High | Developer | Pending |
| 6.5 | Add date range filters for all reports | Medium | Developer | Pending |
| 6.6 | Implement activity log (who did what, when) | High | Developer | Pending |
| 6.7 | Add notification system (real-time alerts for new patients, queue) | Medium | Developer | Pending |
| 6.8 | Add user profile page with avatar and preferences | Low | Developer | Pending |
| 6.9 | Implement responsive admin panel (works on tablets) | Medium | Developer | Pending |
| 6.10 | Add data backup/restore UI for database | Medium | Admin | Pending |
| 6.11 | Implement audit trail for all CRUD operations | High | Developer | Pending |
| 6.12 | Add two-factor authentication (2FA) for admin users | High | Developer | Pending |

### Deliverables
- Feature-rich admin dashboard
- Charts and data visualization
- Activity logging and audit trail
- Data export capabilities

---

## Phase 7: Patient Services

### Timeline
Q4 2027

### Goals
- Enhance patient-facing digital services
- Streamline patient journey from home to hospital

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 7.1 | Implement online appointment booking (integrated with queue) | Critical | Developer | Pending |
| 7.2 | Add appointment confirmation and reminder system | High | Developer | Pending |
| 7.3 | Add patient portal for viewing medical records (beta) | High | Developer | Pending |
| 7.4 | Implement prescription upload/download feature | Medium | Developer | Pending |
| 7.5 | Add insurance/BPJS verification page | Medium | Developer | Pending |
| 7.6 | Implement patient feedback and rating system for doctors | Medium | Developer | Pending |
| 7.7 | Add telemedicine booking feature | Medium | Developer | Pending |
| 7.8 | Implement medication reminder system (email/SMS) | Low | Developer | Pending |
| 7.9 | Add digital intake forms (pre-visit questionnaire) | Medium | Developer | Pending |
| 7.10 | Implement patient wait-time display for IGD and poli | High | Developer | Pending |

### Deliverables
- Online appointment booking
- Patient portal (beta)
- Feedback and rating system
- Enhanced queue management

---

## Phase 8: AI Assistant

### Timeline
Q1 2028

### Goals
- Evolve the MahaCare AI chat assistant into a more intelligent system
- Add multilingual support
- Improve response quality and knowledge coverage

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 8.1 | Upgrade knowledge base to use vector embeddings for semantic matching | High | Developer | Pending |
| 8.2 | Integrate LLM API (Gemini/OpenAI) for dynamic responses | High | Developer | Pending |
| 8.3 | Add Bahasa Indonesia and English language switching | Medium | Developer | Pending |
| 8.4 | Implement conversation history persistence (database-backed) | Medium | Developer | Pending |
| 8.5 | Add admin interface for managing knowledge base entries | Medium | Developer | Pending |
| 8.6 | Implement conversation analytics (intent tracking, common questions) | Medium | Developer | Pending |
| 8.7 | Add agent handoff (chat → human staff) | High | Developer | Pending |
| 8.8 | Implement proactive suggestions based on user behavior | Low | Developer | Pending |
| 8.9 | Add typing indicator and read receipts | Low | Developer | Pending |
| 8.10 | Implement sentiment analysis for chat conversations | Low | Developer | Pending |

### Deliverables
- AI-powered knowledge base with semantic search
- LLM integration for dynamic responses
- Multilingual support
- Agent handoff capability

---

## Phase 9: Hospital Information System Integration

### Timeline
Q2 2028

### Goals
- Connect the website to the hospital's core information systems
- Enable real-time data synchronization

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 9.1 | Integrate with HIS/EMR system via API for real-time doctor schedules | Critical | Developer | Pending |
| 9.2 | Integrate patient registration with hospital admission system | High | Developer | Pending |
| 9.3 | Create real-time bed occupancy dashboard | High | Developer | Pending |
| 9.4 | Implement lab result integration (view test results online) | High | Developer | Pending |
| 9.5 | Add pharmacy integration (medication availability) | Medium | Developer | Pending |
| 9.6 | Integrate with BPJS/Kesehatan system for coverage verification | Medium | Developer | Pending |
| 9.7 | Implement HL7/FHIR API interface for interoperability | Medium | Developer | Pending |
| 9.8 | Add radiology/imaging result portal | Low | Developer | Pending |
| 9.9 | Implement billing integration (online payment for services) | Medium | Developer | Pending |
| 9.10 | Create management reporting dashboard for hospital leadership | High | Developer | Pending |

### Deliverables
- HIS/EMR integration
- Real-time data sync
- Management reporting
- Interoperability (HL7/FHIR)

---

## Phase 10: Long-term Modernization

### Timeline
Ongoing (Q3 2028+)

### Goals
- Modernize the entire technology stack
- Improve infrastructure and architecture
- Position the platform for future growth

### Tasks

| # | Task | Priority | Owner | Status |
|---|------|----------|-------|--------|
| 10.1 | Migrate static HTML to a static site generator (e.g., Hugo, Jekyll) | Medium | Developer | Pending |
| 10.2 | Introduce a CSS preprocessing pipeline (SASS/PostCSS) | Medium | Developer | Pending |
| 10.3 | Add TypeScript to JavaScript for type safety | Low | Developer | Pending |
| 10.4 | Containerize admin panel with Docker | Medium | DevOps | Pending |
| 10.5 | Migrate from shared hosting to VPS or cloud platform | Low | DevOps | Pending |
| 10.6 | Implement CI/CD pipelines with automated testing | Medium | DevOps | Pending |
| 10.7 | Add comprehensive test suite (unit, integration, E2E) | Medium | Developer | Pending |
| 10.8 | Migrate image storage to CDN with automatic optimization | Low | DevOps | Pending |
| 10.9 | Implement PWA (Progressive Web App) capabilities | Medium | Developer | Pending |
| 10.10 | Add multi-language support with i18n framework | Low | Developer | Pending |
| 10.11 | Implement accessibility compliance (WCAG 2.1 AA certified) | Medium | Developer | Pending |
| 10.12 | Conduct regular security audits and penetration testing | Medium | Security | Pending |

### Deliverables
- Modernized technology stack
- Containerized deployment
- PWA capabilities
- Test coverage
- Multi-language support

---

## Milestones

| Milestone | Date | Phase |
|-----------|------|-------|
| Initial documentation baseline | 2026-07-30 | Phase 1 |
| All known issues resolved | 2026-09-30 | Phase 1 |
| Security hardening complete | 2026-12-31 | Phase 2 |
| Performance targets met (Lighthouse ≥85) | 2027-03-31 | Phase 3 |
| SEO audit clean (no errors in Search Console) | 2027-04-30 | Phase 4 |
| UI modernization shipped | 2027-06-30 | Phase 5 |
| Admin dashboard v2 launched | 2027-09-30 | Phase 6 |
| Patient portal beta launched | 2027-12-31 | Phase 7 |
| AI Assistant v2 (LLM-powered) | 2028-03-31 | Phase 8 |
| HIS integration live | 2028-06-30 | Phase 9 |
| Platform modernization complete | Ongoing | Phase 10 |
