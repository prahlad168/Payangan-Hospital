---
name: hosting-deploy
description: This skill should be used when the user asks to "deploy", "push ke hosting", "update website", "sync hosting", "pull dari github", "webhook tidak jalan", "hosting tidak update", "manual deploy", "direct deploy", "download dari github", atau setiap kali perlu sync file dari GitHub ke hosting Idwebhost.
---

# Hosting Deploy Skill

## Overview

Skill untuk deploy file dari GitHub repository ke hosting Idwebhost. Termasuk troubleshooting webhook, manual deploy, dan SSH access.

## Current Setup

| Component | Detail |
|-----------|--------|
| **Hosting** | Idwebhost (cPanel) |
| **Domain** | payanganhospital.gianyarkab.go.id |
| **Username** | payangan |
| **Repository** | prahlad168/Payangan-Hospital |
| **Auto-Deploy** | GitHub Webhook → webhook.php |

## Deploy Methods

### Method 1: GitHub Webhook (Otomatis)

**URL:** `https://payanganhospital.gianyarkab.go.id/webhook.php`

GitHub push otomatis trigger webhook ini. Setup:
```php
<?php
// webhook.php
$output = shell_exec('cd /home/payangan/public_html && git pull 2>&1');
file_put_contents('/home/payangan/public_html/webhook.log', date('Y-m-d H:i:s') . " - $output\n", FILE_APPEND);
echo "OK: $output";
?>
```

**Cek Status Webhook:**
```bash
curl "https://api.github.com/repos/prahlad168/Payangan-Hospital/hooks" \
  -H "Authorization: token ${GITHUB_TOKEN}"
```

### Method 2: Manual Deploy Script

**URL:** `https://payanganhospital.gianyarkab.go.id/deploy.php?key=PAYANGAN_DEPLOY_2026`

Download file langsung dari GitHub tanpa git pull.

**File deploy.php:**
```php
<?php
$secret_key = 'PAYANGAN_DEPLOY_2026';
$provided_key = $_GET['key'] ?? '';
if ($provided_key !== $secret_key) {
    http_response_code(403);
    die('Access denied');
}

// Download files dari GitHub
$files = [
    'img/slider/slider-1.png' => 'https://raw.githubusercontent.com/prahlad168/Payangan-Hospital/main/img/slider/slider-1.png',
    // ... other files
];

foreach ($files as $relative_path => $url) {
    $content = @file_get_contents($url);
    if ($content !== false) {
        file_put_contents(__DIR__ . '/' . $relative_path, $content);
    }
}
echo "Deploy complete";
?>
```

### Method 3: SSH (Jika Tersedia)

**Credentials:**
- Host: payanganhospital.gianyarkab.go.id
- User: payangan
- Password: (dari user - GITHUB_TOKEN tidak bisa digunakan)

**SSH Command:**
```bash
ssh payangan@payanganhospital.gianyarkab.go.id
# Password: (dari user)

# Navigate ke public_html
cd /home/payangan/public_html

# Git pull
git pull origin main
```

### Method 4: cPanel File Manager

1. Login ke cPanel: `https://payanganhospital.gianyarkab.go.id:2083`
2. Go to **File Manager** → `public_html`
3. Upload file manual atau **Terminal** → `git pull`

## Deployment Workflow

### Standard Flow (Recommended)
```
User: "deploy ke hosting"
    ↓
Push ke GitHub (git push origin main)
    ↓
GitHub Webhook → Hosting webhook.php
    ↓
git pull otomatis
    ↓
Website updated ✅
```

### Manual Flow (If Webhook Failed)
```
User: "deploy manual"
    ↓
Buka deploy.php?key=DEPLOY_KEY
    ↓
File didownload langsung
    ↓
Website updated ✅
```

## Troubleshooting

### Issue: Webhook Tidak Jalan

**Cekapan:**
1. GitHub → Settings → Webhooks
2. Lihat "Last delivery" status
3. Klik "Recent Deliveries" untuk error details

**Test Webhook:**
```bash
# Via GitHub API
curl -X POST "https://api.github.com/repos/OWNER/REPO/hooks/HOOK_ID/tests" \
  -H "Authorization: token ${GITHUB_TOKEN}"
```

**Common Issues:**
| Issue | Cause | Solution |
|-------|-------|----------|
| 403 Forbidden | Cloudflare blocking | Whitelist IP atau tunggu |
| 200 OK but no update | Git not in PATH | Cek webhook.php path |
| Timeout | Server slow | Gunakan deploy.php |

### Issue: Hosting Blocked by Cloudflare

**Problem:** Environment IP masuk blacklist Cloudflare

**Solution:**
1. Gunakan browser user untuk test
2. Atau deploy.php untuk direct download
3. Atau tunggu - biasanya whitelist otomatis

### Issue: Git Pull Failed

**Error:** "fatal: not a git repository"

**Cause:** Folder bukan git clone

**Solution:**
```bash
# Clone ulang jika perlu
git clone https://github.com/prahlad168/Payangan-Hospital.git /home/payangan/public_html
```

## Quick Reference

### Trigger Webhook via GitHub
1. https://github.com/prahlad168/Payangan-Hospital/settings/hooks
2. Klik webhook → **Edit**
3. Scroll ke "Recent Deliveries" → **Test** → **Deliver**

### Manual Deploy URL
```
https://payanganhospital.gianyarkab.go.id/deploy.php?key=PAYANGAN_DEPLOY_2026
```

### Check GitHub API Status
```bash
curl "https://api.github.com/repos/prahlad168/Payangan-Hospital/hooks" \
  -H "Authorization: token ${GITHUB_TOKEN}"
```

## SSH Access Notes

**When SSH is needed:**
- git pull manually
- Fix broken git repo
- Check server logs
- Direct file editing

**Security:**
- Use SSH only for maintenance
- Prefer webhook for regular deploys
- Never commit SSH credentials to repo

## Security Best Practices

1. **Webhook Secret:** Tambahkan signature verification
2. **Deploy Key:** Jangan expose di public
3. **GitHub Token:** Gunakan read-only access
4. **cPanel:** Enable 2FA jika tersedia

## When to Use Each Method

| Situation | Method |
|-----------|--------|
| Regular deploy | GitHub Push + Webhook |
| Webhook failed | deploy.php URL |
| Git repo broken | SSH + git clone |
| Single file update | cPanel File Manager |
| Can't access hosting | GitHub Actions alternative |
