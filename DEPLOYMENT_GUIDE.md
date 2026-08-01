# DEPLOYMENT GUIDE

Payangan Hospital Website — Deployment & Operations Manual

---

## Development Environment

### Local Setup

| Component | Version | Purpose |
|-----------|---------|---------|
| PHP | 7.4+ | Admin panel backend |
| MySQL / MariaDB | 5.7+ / 10.3+ | Database (optional for auth) |
| Git | 2.x | Version control |
| Web Server | Apache 2.4+ / Nginx 1.18+ | Serves static HTML/PHP |
| Browser | Chrome, Firefox, Edge, Safari | Testing |

### Required Tools

```powershell
# Install PHP from https://www.php.net/downloads
# Install MySQL from https://dev.mysql.com/downloads/
# Install Git from https://git-scm.com/download/win
```

### Local Testing

```powershell
# Serve the project with PHP built-in server
php -S localhost:8000

# Open in browser
start http://localhost:8000
```

### Admin Panel Local Setup

1. Start MySQL service
2. Import `rs-admin/config/schema.sql` into MySQL
3. Edit `rs-admin/config/database.php` with local DB credentials
4. Start PHP server
5. Access `http://localhost:8000/rs-admin/login.php`
6. Login with demo credentials:
   - **Direktur**: `direktur` / `welcomehome`
   - **Admin**: `admin` / `admin123`
   - **Karyawan**: `karyawan` / `staf2026`

---

## Testing Checklist

### Frontend Testing

- [ ] All HTML pages load without 404 or 500 errors
- [ ] Navigation works between all pages
- [ ] Hero section images and sliders render correctly
- [ ] Doctor cards display with correct photos and info
- [ ] Contact form validates and submits (or opens WhatsApp)
- [ ] Google Maps embeds load correctly
- [ ] AI chat widget opens and responds
- [ ] Quick replies work in chat widget
- [ ] Scroll animations trigger on scroll (IntersectionObserver)
- [ ] Mobile menu opens and closes on hamburger click
- [ ] Back-to-top button appears after scrolling
- [ ] Forms show required field validation
- [ ] Tabs and accordions switch correctly
- [ ] Doctor slider is draggable/swipeable
- [ ] Counter animations play on scroll
- [ ] All images have `alt` attributes

### Responsive Testing

| Viewport | Expected |
|----------|----------|
| 320px (iPhone SE) | No horizontal scroll, menu works, text readable |
| 375px (iPhone 12/13) | Layout adapts, touch targets ≥ 44px |
| 414px (iPhone 12 Pro Max) | All sections visible |
| 768px (iPad) | Navigation expands to desktop, sidebar visible |
| 1024px (Laptop) | Full layout, no overflow |
| 1440px (Desktop) | Max-width container, centered content |

### Accessibility Testing

- [ ] All images have descriptive `alt` text
- [ ] All form inputs have associated `<label>` elements
- [ ] All interactive elements are keyboard accessible (Tab navigation)
- [ ] Color contrast meets WCAG AA (4.5:1 for normal text, 3:1 for large text)
- [ ] Focus indicators visible on all interactive elements
- [ ] Page has a single `<h1>` element
- [ ] Heading hierarchy is logical (H1 → H2 → H3)
- [ ] `<main>` element wraps primary content
- [ ] `lang="id"` is set on `<html>` tag

### SEO Testing

- [ ] Every page has a unique `<title>` tag
- [ ] Every page has a unique `<meta name="description">` tag
- [ ] All pages reference `sitemap.xml`
- [ ] Schema.org structured data on homepage (Organization)
- [ ] Open Graph tags on all pages (og:title, og:description, og:image)
- [ ] Canonical URLs are correct
- [ ] `robots.txt` allows crawling of public pages
- [ ] All internal links are functional (no broken links)
- [ ] Page load time < 3 seconds on 3G

### Admin Panel Testing

- [ ] Login page loads correctly
- [ ] Authentication successful for all three roles
- [ ] Role-based menu items display correctly per role
- [ ] Dashboard shows role-specific statistics
- [ ] CRUD operations work for doctors, poli, patients, rooms, queue
- [ ] Session timeout after 1 hour of inactivity
- [ ] Logout destroys session properly
- [ ] Error messages display for failed operations
- [ ] Database connections work (if configured)

### Performance Testing

- [ ] Lighthouse score ≥ 80 for Performance
- [ ] Lighthouse score ≥ 90 for Accessibility
- [ ] Lighthouse score ≥ 90 for Best Practices
- [ ] Lighthouse score ≥ 80 for SEO
- [ ] First Contentful Paint < 1.8s
- [ ] Largest Contentful Paint < 2.5s
- [ ] Total page size < 2MB per page
- [ ] No external resources block rendering

---

## Git Workflow

### Branch Strategy

```
main ────────────────────────────●──────────────────● (release)
     ↑                            ↑                  ↑
     │                     hotfix/w.x.y         release/vX.Y.Z
     │                     ↑                        ↑
feature/feat-name ──────┐   │                   staging
     ↑                 │   │                        ↑
     │                 │   └── release/vX.Y.Z      │
     │                 │                           │
     └──── feature branches ──────────────────────┘
```

### Workflow

1. **Start**: Pull latest `main`
2. **Branch**: Create feature/branch from `main`
3. **Develop**: Make changes, commit frequently
4. **Test**: Run locally, verify all checklist items
5. **Push**: Push branch to GitHub
6. **PR**: Open Pull Request against `main`
7. **Review**: At least one reviewer approves
8. **Merge**: Squash merge into `main`
9. **Deploy**: Webhook triggers auto-deploy

### Protected Branches

- `main` — No direct push, requires PR + review
- `release/*` — No direct push, requires PR + review

### Force Push Policy

Force push to `main` is allowed **only** when:
- CI checks pass
- PR has been approved
- Team is notified in Slack/Discord
- Reason is documented in commit message

**Note**: A force push has already been performed in this project's history, overwriting remote commit `005390c` with local commit `10f2e9f`.

---

## Production Deployment

### Auto-Deploy (Recommended)

```
GitHub Push → Webhook POST → webhook.php → git pull on server
```

**Trigger**: Every push to `main` calls the GitHub webhook.

**Webhook URL**: `https://payanganhospital.gianyarkab.go.id/webhook.php`

**Security**: The webhook currently does NOT verify a shared secret. This is a known vulnerability — see Security section below.

### Manual Deploy

1. Visit `https://payanganhospital.gianyarkab.go.id/deploy.php`
2. The script downloads all tracked files from GitHub
3. Writes files to the server filesystem
4. Prints success/failure status per file

### Full Deploy

For deployments that include doctor images and other assets:

1. Visit `https://payanganhospital.gianyarkab.go.id/deploy-full.php`
2. Downloads all files including doctor images
3. Verifies image file integrity
4. Prints deployment summary

### Image Deploy

To update only image assets without code changes:

1. Visit `https://payanganhospital.gianyarkab.go.id/deploy-image.php`
2. Downloads only images from `img/` directory
3. Optimizes and replaces existing images on server

### Steps After Deploy

1. Visit the homepage and verify it loads
2. Click through all navigation links (no 404 errors)
3. Test the AI chat widget
4. Test the admin panel login
5. Check Google Search Console for crawl errors
6. Review deployment log

---

## Rollback Strategy

### Git Rollback

```bash
# View recent commits
git log --oneline -10

# Revert to previous commit
git revert HEAD

# Or reset to specific commit (force push required)
git reset --hard <commit-hash>
git push --force origin main
```

### File-Level Rollback

```bash
# Restore a single file from last commit
git checkout HEAD~1 -- path/to/file.html

# Restore entire directory
git checkout HEAD~1 -- rs-admin/
```

### Database Rollback

If database schema changes are needed:

1. Export current database: `mysqldump -u user -p dbname > backup.sql`
2. Apply rollback SQL from `rs-admin/config/schema.sql` or a revert script
3. Verify data integrity

### Rollback Checklist

- [ ] Identify the issue (error logs, user reports)
- [ ] Determine rollback target (commit hash or release tag)
- [ ] Perform git revert or reset
- [ ] Force push to `main`
- [ ] Verify webhook triggers auto-deploy
- [ ] Test all critical paths on production
- [ ] Confirm no data loss (database backup verified)
- [ ] Notify stakeholders
- [ ] Document the incident and root cause

---

## Backup Strategy

### Backup Types

| Type | Frequency | Retention | Method |
|------|-----------|-----------|--------|
| **Code** | On every push | 90 days | GitHub (remote repo) |
| **Database** | Daily | 30 days | MySQL dump via cron |
| **Files** | Weekly | 90 days | rsync/sync to secondary storage |
| **Full site** | Monthly | 12 months | Snapshot of entire directory |
| **Chat logs** | Weekly | 30 days | Compress and archive |

### Database Backup (Manual)

```bash
mysqldump -u root -p rs_payangan > rs_payangan_$(date +%Y%m%d_%H%M%S).sql
```

### File Backup (Manual)

```powershell
# PowerShell example
Copy-Item -Path "D:\PayanganWeb\*" -Destination "D:\Backups\PayanganWeb-$(Get-Date -Format 'yyyyMMdd')\" -Recurse
```

### Backup Verification

- [ ] Backup file exists and is non-empty
- [ ] Backup can be restored to a test environment
- [ ] Database backup contains all expected tables
- [ ] File backup includes all critical directories

---

## Hosting Architecture

```
┌─────────────────────────────────────────────────────────┐
│                   Idwebhost (cPanel)                     │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │  Public HTML (/home/payangan/public_html)         │ │
│  │  ├── index.html, about.html, kontak.html, ...     │ │
│  │  ├── .git/ (working tree for git pull)            │ │
│  │  ├── webhook.php                                  │ │
│  │  ├── deploy.php                                   │ │
│  │  ├── deploy-full.php                              │ │
│  │  ├── .deploy-timestamp                            │ │
│  │  ├── .deploy-trigger                              │ │
│  │  ├── css/                                         │ │
│  │  ├── js/                                          │ │
│  │  ├── rs-admin/                                    │ │
│  │  ├── api/                                         │ │
│  │  ├── img/                                         │ │
│  │  └── video/                                       │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │  MySQL Database (if configured)                    │ │
│  │  └── rs_payangan                                   │ │
│  │      ├── users                                    │ │
│  │      ├── doctors                                  │ │
│  │      ├── poli                                     │ │
│  │      ├── patients                                 │ │
│  │      ├── rooms                                    │ │
│  │      ├── antrean (queue)                          │ │
│  │      ├── aktivitas (activity log)                 │ │
│  │      └── ...                                      │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │  SSL/TLS Certificate                               │ │
│  │  └── HTTPS enforced (Let's Encrypt or Idwebhost) │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │  Cron Jobs (cPanel → Cron Jobs)                   │ │
│  │  └── Daily report at 23:59 WIB (or 17:59 UTC)    │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │  Email (cPanel → Email Accounts)                   │ │
│  │  └── info@payanganhospital.gianyarkab.go.id       │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  Resource Limits (Shared Hosting):                      │
│  ├── CPU: Shared (25% per process typical)             │
│  ├── Memory: 512MB–2GB typical                         │
│  ├── Storage: Depends on plan (usually 10–50GB)       │
│  ├── Bandwidth: Depends on plan                        │
│  ├── MySQL Connections: ~50–100                        │
│  └── Max Execution Time: 30–120 seconds                │
└─────────────────────────────────────────────────────────┘
```

### Idwebhost cPanel Details

- **Username**: `payangan`
- **Document Root**: `/home/payangan/public_html/`
- **Database**: MySQL (cPanel → MySQL Databases)
- **Email**: cPanel → Email → Email Accounts
- **Cron Jobs**: cPanel → Cron Jobs
- **SSL**: Auto-SSL via Let's Encrypt or cPanel SSL/TLS Manager

---

## Troubleshooting

### Common Issues

| Issue | Cause | Solution |
|-------|-------|----------|
| **Webhook not triggering** | GitHub webhook secret mismatch or URL mismatch | Verify webhook URL in GitHub Settings → Webhooks; check `webhook.php` is accessible via browser |
| **Git pull fails on server** | Authentication error or branch mismatch | Check `.git/config` on server; ensure `origin` remote points to GitHub; verify SSH key or HTTPS credentials |
| **Deploy script shows permission denied** | PHP lacks write permissions to deployment directory | Set directory permissions: `chmod -R 755 /home/payangan/public_html/` |
| **Admin panel shows blank page** | PHP error suppressed or session not started | Enable `display_errors` in `php.ini`; check `session_start()` is called before any output |
| **Chat widget not loading** | JS file blocked by cache or not found | Hard-refresh browser (`Ctrl+Shift+R`); verify `js/mahacare-ai.js` is present on server |
| **Images not loading** | Image files not deployed or wrong path | Check `img/` directory on server has correct files; verify paths in HTML match server paths |
| **MySQL connection error** | Wrong credentials or database not created | Verify `rs-admin/config/database.php` credentials; import `schema.sql` |
| **Session not persisting** | Cookie settings prevent session | Verify `session.cookie_secure` and `session.cookie_samesite` in `php.ini` |
| **CORS errors in chat API** | `Access-Control-Allow-Origin: *` or missing CORS headers | Ensure `chat.php` sends correct CORS headers; use specific origin if possible |
| **Slow page load** | Large images, unoptimized CSS/JS, many external requests | Run Lighthouse audit; compress images to WebP; defer non-critical JS |
| **404 on new page** | Page not committed to git or not pulled | Push changes to GitHub; verify webhook triggers pull; check file exists on server |

### Debug Mode

Enable debug mode by editing `rs-admin/config/database.php` (if applicable) or adding to `php.ini`:

```ini
display_errors = On
error_reporting = E_ALL
log_errors = On
error_log = /home/payangan/logs/php_errors.log
```

### Checking Logs

```bash
# Server access logs
tail -f /home/payangan/logs/access.log

# Server error logs
tail -f /home/payangan/logs/error.log

# PHP error log
tail -f /home/payangan/logs/php_errors.log

# Deployment log (check for recent activity)
cat /home/payangan/public_html/.deploy-trigger
cat /home/payangan/public_html/.deploy-timestamp
```

### Rollback in an Emergency

If the site is broken after a deploy:

1. **Immediate**: Access cPanel → File Manager → navigate to `public_html/`
2. **Rename** the current `.git` folder to `.git.bak` (preserves it)
3. **Re-clone** or restore from backup
4. **Restore** database if needed: `mysql -u root -p rs_payangan < backup.sql`
5. **Verify**: Open homepage and test critical paths
6. **Investigate**: Review what caused the issue (code change, config, etc.)
7. **Fix and re-deploy** when ready
