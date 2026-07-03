---
Title: Website Maintenance SOP
Category: Hospital
Difficulty: Medium
Keywords: website, maintenance, deployment, webhook, hosting
Date: 2026-07-03
Version: 1.0
Author: AI Agent System
Status: Active
Related: webhook-auto-deploy, hosting-deploy
---

# Website Maintenance SOP

## 1. Overview

SOP ini menjelaskan prosedur maintenance website RS Payangan Hospital dari development hingga deployment ke hosting Idwebhost.

## 2. Workflow

```
Development в†“ GitHub Push в†“ Webhook Trigger в†“ Hosting Update в†“ Live
```

## 3. Development Process

### 3.1 Local Development
```bash
# Clone repository
git clone https://github.com/prahlad168/Payangan-Hospital.git

# Create new branch
git checkout -b feature/new-feature

# Make changes
# ... edit files ...

# Commit
git add .
git commit -m "feat(description): add new feature"

# Push
git push origin feature/new-feature
```

### 3.2 Code Standards
- Use semantic HTML5
- Include proper meta tags
- Optimize images before upload
- Test locally before push
- Follow naming conventions

## 4. Deployment Process

### 4.1 Automatic Deployment (Recommended)
```
GitHub Push в†“ GitHub Webhook в†“ Hosting webhook.php в†“ git pull в†“ Live
```

**Step by Step:**
1. Push changes to GitHub
2. GitHub sends webhook to hosting
3. webhook.php receives request
4. Execute `git pull` in hosting
5. Files updated automatically

### 4.2 Manual Deployment (Backup)
```
Access cPanel в†“ File Manager в†“ Upload files в†“ Verify
```

**URL:** `https://payanganhospital.gianyarkab.go.id/deploy.php?key=PAYANGAN_DEPLOY_2026`

## 5. File Structure

```
/
рҹ”ӣ index.html           # Homepage
рҹ”ӣ about.html           # About page
рҹ”ӣ dokter.html          # Doctor list
рҹ”ӣ igd.html            # Emergency (IGD)
рҹ”ӣ kontak.html          # Contact page
рҹ”ӣ poli-*.html         # Poli pages
рҹ”ӣ rawat-*.html        # Treatment pages
рҹ”ӣ img/                # Images
рҹ”ӣ progress/           # Progress reports
рҹ”ӣ webhook.php         # Auto-deploy webhook
рҹ”ӣ deploy.php          # Manual deploy script
```

## 6. Quality Checklist

- [ ] All links work correctly
- [ ] Images load properly
- [ ] Mobile responsive
- [ ] Fast loading time
- [ ] SEO meta tags present
- [ ] No console errors
- [ ] Accessibility checked

## 7. Rollback Procedure

If deployment fails:

```bash
# 1. Check git log
git log --oneline

# 2. Identify last good commit
git revert <commit_hash>

# 3. Push revert
git push origin main

# 4. Verify rollback
# Check live site
```

## 8. Monitoring

### 8.1 Webhook Logs
```bash
# Check log file
cat /home/payangan/public_html/webhook.log
```

### 8.2 Uptime Monitoring
- Check website every hour
- Monitor for errors
- Log downtime events

## 9. Security

- [ ] No credentials in code
- [ ] Environment variables used
- [ ] Webhook secret configured (production)
- [ ] SSL/TLS enabled
- [ ] Regular backups configured

## 10. Contacts

| Role | Contact |
|------|---------|
| GitHub Owner | prahlad168 |
| cPanel User | payangan |
| Domain Admin | Idwebhost Team |

## 11. Related Documentation

- `.agents/skills/webhook-auto-deploy.md`
- `.agents/skills/hosting-deploy.md`

---

## Learning Points

### What Worked
- GitHub webhook integration for auto-deploy
- Simple PHP webhook script
- OpenHands automation for daily reports

### What Can Be Improved
- Add secret verification to webhook
- Implement staging environment
- Add automated testing before deployment

### Next Improvements
1. Add pre-deployment testing
2. Implement staging environment
3. Add deployment notifications
