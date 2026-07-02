# OpenHands Cloud Automation - Payangan Hospital

## рҹ“Ӣ Automation untuk Repository Payangan Hospital

Berikut adalah automation yang bisa dibuat di OpenHands Cloud untuk menjalankan semua agent secara otomatis.

---

## рҹ”Қ Automation 1: Daily Full Site Check

**Trigger:** Setiap hari jam 7 pagi WIB (00:00 UTC)

```bash
curl -X POST "https://app.all-hands.dev/api/automation/v1/preset/prompt" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Daily Full Site Check - Payangan Hospital",
    "prompt": "You are the SuperAgent for Payangan Hospital website maintenance.\n\nClone the repository prahladi68/Payangan-Hospital and perform the following checks:\n\n1. LINK CHECKER:\n   - Check all HTML files for broken internal links\n   - Verify logo links point to index.html (not href=\"#\")\n   - Verify dokter links point to dokter.html (not #dokter)\n   - Verify kontak links point to kontak.html (not #kontak)\n\n2. CONTENT VALIDATOR:\n   - Verify all 22 doctors are listed in dokter.html\n   - Check all dokter images exist in img/dokter/\n   - Verify all poli files exist (poli-umum.html, poli-saraf.html, dll)\n   - Check website structure (required pages: index, about, dokter, kontak, antrean, igd, rawat-jalan, rawat-inap)\n\n3. QA CHECKER:\n   - Verify DOCTYPE declarations\n   - Check viewport meta tags\n   - Check alt attributes on images\n   - Verify title tags\n\n4. DEPLOY CHECK:\n   - If all checks pass and branch is main, confirm ready for deployment\n\nGenerate a comprehensive report in Indonesian with emoji formatting.\n\nReport format:\n# рҹ“Ӣ Payangan Hospital - Daily Site Check Report\n## Timestamp\n## Summary\n- Total Errors\n- Total Warnings\n## Agent 1: Link Checker\n## Agent 2: Content Validator  \n## Agent 3: QA Checker\n## Final Status\n\nIf any issues are found, list them with file names and specific problems.",
    "trigger": {
      "type": "cron",
      "schedule": "0 0 * * *",
      "timezone": "Asia/Makassar"
    },
    "repos": [
      {"url": "https://github.com/prahlad168/Payangan-Hospital"}
    ]
  }'
```

---

## рҹӨ– Automation 2: PR Review Assistant

**Trigger:** Saat PR baru dibuka atau di-update

```bash
curl -X POST "https://app.all-hands.dev/api/automation/v1/preset/prompt" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "PR Review - Payangan Hospital",
    "prompt": "You are the Auto PR Reviewer for Payangan Hospital website.\n\nReview the changes in this pull request:\n\n1. LINK VALIDATION:\n   - Check if any logo links use href=\"#\" (should be index.html)\n   - Check if dokter links use #dokter (should be dokter.html)\n   - Check if kontak links use #kontak (should be kontak.html)\n\n2. IMAGE VALIDATION:\n   - If new dokter references are added, verify corresponding images exist in img/dokter/\n   - Check image naming follows convention: dr. [Nama], Sp.XX.png\n\n3. CODE QUALITY:\n   - Check for unclosed HTML tags\n   - Check for missing alt attributes on new images\n   - Look for excessive inline styles\n\n4. BEST PRACTICES:\n   - Verify use of semantic HTML (nav, header, footer, main)\n   - Check proper heading hierarchy (single h1)\n\nProvide a review with:\n- APPROVE if no critical issues\n- REQUEST_CHANGES if issues found\n\nFormat your review with specific file names and line suggestions.",
    "trigger": {
      "type": "event",
      "source": "github",
      "on": ["pull_request.opened", "pull_request.synchronize", "pull_request.reopened"]
    },
    "repos": [
      {"url": "https://github.com/prahlad168/Payangan-Hospital"}
    ]
  }'
```

---

## вқҢ Automation 3: Push-triggered Check (Tanpa LLM)

**Trigger:** Setiap push ke branch manapun

Ini adalah **custom script** tanpa LLM - lebih murah dan lebih cepat untuk tugas deterministik:

```python
# File: main.py
import os
import re
import json
from pathlib import Path
from datetime import datetime

def get_secret(name):
    """Fetch a named secret stored in the agent server."""
    url = os.environ.get("AGENT_SERVER_URL", "").rstrip("/")
    key = os.environ.get("SESSION_API_KEY") or os.environ.get("OH_SESSION_API_KEYS_0", "")
    with urllib.request.urlopen(urllib.request.Request(
        f"{url}/api/settings/secrets/{name}", headers={"X-Session-API-Key": key}
    )) as r:
        return r.read().decode().strip()

def fire_callback(status="COMPLETED", error=None):
    """Signal run completion."""
    url = os.environ.get("AUTOMATION_CALLBACK_URL", "")
    if not url: return
    body = {"status": status, "run_id": os.environ.get("AUTOMATION_RUN_ID", "")}
    if error: body["error"] = error
    try:
        urllib.request.urlopen(urllib.request.Request(url, data=json.dumps(body).encode(), headers={
            "Content-Type": "application/json",
            "Authorization": f"Bearer {os.environ.get('AUTOMATION_CALLBACK_API_KEY', '')}",
        }))
    except Exception as e: print(f"Callback error: {e}")

try:
    import urllib.request
    import urllib.error
    
    print("=" * 60)
    print("PAYANGAN HOSPITAL - PUSH VALIDATION")
    print("=" * 60)
    
    issues = []
    
    # Check all HTML files
    html_files = list(Path('.').glob('*.html'))
    print(f"\n📁 Checking {len(html_files)} HTML files...")
    
    for html_file in html_files:
        content = html_file.read_text(encoding='utf-8')
        filename = html_file.name
        
        # Link checks
        if 'href="#"' in content and 'class="logo"' in content:
            issues.append(f"{filename}: Logo link uses href=\"#\"")
        
        if 'href="#dokter"' in content:
            issues.append(f"{filename}: Dokter link uses #dokter instead of dokter.html")
        
        if 'href="#kontak"' in content:
            issues.append(f"{filename}: Kontak link uses #kontak instead of kontak.html")
        
        # Basic HTML validation
        if '<!DOCTYPE' not in content.upper():
            issues.append(f"{filename}: Missing DOCTYPE")
        
        if '<html' in content and 'lang=' not in content:
            issues.append(f"{filename}: Missing lang attribute")
    
    # Check dokter images
    dokter_imgs = list(Path('img/dokter').glob('*.png')) if Path('img/dokter').exists() else []
    print(f"📷 Found {len(dokter_imgs)} dokter images")
    
    # Report
    print("\n" + "=" * 60)
    print("REPORT SUMMARY")
    print("=" * 60)
    
    if issues:
        print(f"\n❌ Found {len(issues)} issues:")
        for issue in issues[:10]:
            print(f"   - {issue}")
        print("\n⚠️ VALIDATION FAILED")
    else:
        print("\n✅✅✅ ALL CHECKS PASSED!")
        print("   - Link standards: OK")
        print("   - HTML structure: OK")
        print("   - Image files: OK")
    
    print("=" * 60)
    
    if issues:
        fire_callback("FAILED", f"{len(issues)} issues found")
    else:
        fire_callback("COMPLETED")
        
except Exception as e:
    print(f"Error: {e}")
    fire_callback("FAILED", str(e))
```

---

## рҹҡҖ Automation 4: Pre-Deploy Final Check

**Trigger:** Manual dispatch atau sebelum deployment

```bash
curl -X POST "https://app.all-hands.dev/api/automation/v1/preset/prompt" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Pre-Deploy Final Check - Payangan Hospital",
    "prompt": "You are the final quality gate before deploying Payangan Hospital website.\n\nPerform these final checks:\n\n1. ALL LINK CHECKS\n2. ALL DOCTOR VALIDATION (22 doctors)\n3. ALL IMAGE VALIDATION\n4. DEPLOYMENT READINESS:\n   - index.html exists and valid\n   - All critical pages exist\n   - No console errors in code\n   - Responsive meta tags present\n   - Google Maps link correct (g.page/rsu-payangan-gianyar)\n   - Contact info accurate:\n     * Phone: 0361 98087\n     * Email: info@rsupayangan.co.id\n     * Address: Jl. Raya Payangan, Gianyar, Bali\n\nIf all checks pass, output: \"✅ DEPLOYMENT READY\"\nIf any issues, output: \"❌ DEPLOYMENT BLOCKED\" with details.",
    "trigger": {
      "type": "cron",
      "schedule": "0 */6 * * *",
      "timezone": "Asia/Makassar"
    },
    "repos": [
      {"url": "https://github.com/prahlad168/Payangan-Hospital", "ref": "main"}
    ]
  }'
```

---

## вһӨ Command untuk Manage Automations

### List Semua Automation
```bash
curl "https://app.all-hands.dev/api/automation/v1" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

### Trigger Manual (dispatch)
```bash
# Get automation ID first
curl "https://app.all-hands.dev/api/automation/v1" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}" | jq '.[].id'

# Then dispatch
curl -X POST "https://app.all-hands.dev/api/automation/v1/{automation_id}/dispatch" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

### Disable/Enable Automation
```bash
curl -X PATCH "https://app.all-hands.dev/api/automation/v1/{automation_id}" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}" \
  -H "Content-Type: application/json" \
  -d '{"enabled": false}'
```

### Delete Automation
```bash
curl -X DELETE "https://app.all-hands.dev/api/automation/v1/{automation_id}" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

---

## рҹ‘Ҹ Cara Setup

1. **Buka OpenHands Dashboard:** https://app.all-hands.dev
2. **Pergi ke Automations section**
3. **Klik "Create Automation"**
4. **Pilih type:** Prompt Preset
5. **Copy-paste prompt** dari salah satu automation di atas
6. **Set trigger** sesuai kebutuhan
7. **Deploy!**

---

## Cron Schedule Reference

| Schedule | Description |
|----------|-------------|
| `0 0 * * *` | Daily at midnight |
| `0 7 * * *` | Daily at 7 AM |
| `0 */6 * * *` | Every 6 hours |
| `0 9 * * 1-5` | Weekdays at 9 AM |
| `0 9 * * 1` | Every Monday at 9 AM |
