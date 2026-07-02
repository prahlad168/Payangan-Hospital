# рҹ“Ҡ Command /play - Run All Agents

## рҹ‘Ҹ Opsi untuk /play Command

### Opsi 1: GitHub Actions (workflow_dispatch)
Jika `/play` dijalankan dari GitHub Actions (workflow trigger), gunakan workflow yang sudah dibuat:

**File:** `.github/workflows/00-all-agents.yml`

Trigger dengan push ke branch atau manual dispatch:
```yaml
on:
  workflow_dispatch:  # Manual trigger dari GitHub UI
```

**Cara pakai:**
1. Buka GitHub repository
2. Klik tab "Actions"
3. Pilih "рҹ“Ӣ Run All Agents"
4. Klik "Run workflow"

---

### Opsi 2: Persistent Agent Script (Local)
Jika `/play` dijalankan di local repository, gunakan script yang sudah ada:

```bash
# Di directory repository
cd /workspace/project/Payangan-Hospital

# Jalankan semua agent checks
python scripts/persistent_agent.py --task "run-all-checks"
```

**Cara buat trigger /play:**
```bash
# Buat alias di shell
alias play='/workspace/project/Payangan-Hospital/scripts/play.sh'
```

**File:** `scripts/play.sh`
```bash
#!/bin/bash
# рҹ“Ӣ Payangan Hospital - Play Command
# Jalankan semua agent checks

echo "============================================"
echo "рҹ“Ӣ PAYANGAN HOSPITAL - RUN ALL AGENTS"
echo "============================================"
echo ""

# Change to repo directory
cd "$(dirname "$0")/.." || exit 1

echo "рҹ”Қ Agent 1: Link Checker"
python3 << 'EOF'
import os, re
from pathlib import Path

html_files = list(Path('.').glob('*.html'))
issues = []

for f in html_files:
    content = f.read_text()
    if 'href="#"' in content and 'class="logo"' in content:
        issues.append(f"Logo link error in {f.name}")
    if 'href="#dokter"' in content:
        issues.append(f"Dokter link error in {f.name}")

if issues:
    print(f"❌ Found {len(issues)} issues")
    for i in issues[:5]: print(f"   - {i}")
else:
    print("✅ All links OK")
EOF

echo ""
echo "вң… Agent 2: QA Checker"
python3 << 'EOF'
import re
from pathlib import Path

html_files = list(Path('.').glob('*.html'))
errors = []

for f in html_files:
    content = f.read_text()
    if '<!DOCTYPE' not in content.upper():
        errors.append(f"Missing DOCTYPE in {f.name}")
    if '<html' in content and 'lang=' not in content:
        errors.append(f"Missing lang in {f.name}")

if errors:
    print(f"❌ Found {len(errors)} errors")
    for e in errors[:5]: print(f"   - {e}")
else:
    print("✅ HTML validation OK")
EOF

echo ""
echo "рҹ“Ӣ Agent 3: Content Validator"
python3 << 'EOF'
from pathlib import Path

required = ['index.html', 'about.html', 'dokter.html', 'kontak.html', 'antrean.html', 'igd.html']
missing = [p for p in required if not Path(p).exists()]

if missing:
    print(f"❌ Missing files: {missing}")
else:
    print("✅ All required pages exist")

# Check dokter images
img_dir = Path('img/dokter')
if img_dir.exists():
    imgs = list(img_dir.glob('*.png'))
    print(f"📷 Found {len(imgs)} dokter images")
EOF

echo ""
echo "============================================"
echo "рҹ“Ӣ ALL AGENTS COMPLETED"
echo "============================================"
```

---

### Opsi 3: OpenHands Cloud (Remote Trigger)

Buat automation di OpenHands Cloud yang bisa di-trigger dari mana saja:

**Trigger URL:**
```
https://app.all-hands.dev/api/automation/v1/{automation_id}/dispatch
```

**Setup:**
```bash
# 1. Create automation
curl -X POST "https://app.all-hands.dev/api/automation/v1/preset/prompt" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Play - Run All Agents",
    "prompt": "Run all quality checks on Payangan Hospital website",
    "trigger": {"type": "cron", "schedule": "0 0 * * *"}
  }'

# 2. Get automation ID
curl "https://app.all-hands.dev/api/automation/v1" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"

# 3. Trigger dengan /play
curl -X POST "https://app.all-hands.dev/api/automation/v1/{id}/dispatch" \
  -H "Authorization: Bearer ${OPENHANDS_API_KEY}"
```

---

## рҹӘі Integrated /play Script (Terbaik)

Buat script unified yang menjalankan semua agent:

**File:** `scripts/play.py`
```python
#!/usr/bin/env python3
"""
Payangan Hospital - /play Command
================================
Jalankan semua 5 agent dengan satu command!
"""

import os
import sys
import re
import json
from pathlib import Path
from datetime import datetime

# Colors
GREEN = '\033[92m'
RED = '\033[91m'
YELLOW = '\033[93m'
BLUE = '\033[94m'
BOLD = '\033[1m'
RESET = '\033[0m'

def print_header(text):
    print(f"\n{BLUE}{BOLD}{'='*60}{RESET}")
    print(f"{BLUE}{BOLD}  {text}{RESET}")
    print(f"{BLUE}{BOLD}{'='*60}{RESET}\n")

def print_success(text):
    print(f"{GREEN}✅ {text}{RESET}")

def print_error(text):
    print(f"{RED}❌ {text}{RESET}")

def print_warning(text):
    print(f"{YELLOW}⚠️  {text}{RESET}")

def agent_link_checker():
    """Agent 1: Link Checker"""
    print(f"{BOLD}рҹ”Қ Agent 1: Link Checker{RESET}")
    
    html_files = list(Path('.').glob('*.html'))
    issues = []
    
    for f in html_files:
        content = f.read_text(encoding='utf-8')
        
        # Check logo links
        if 'href="#"' in content and 'class="logo"' in content:
            issues.append(f"Logo link harus index.html, bukan # ({f.name})")
        
        # Check dokter links
        if 'href="#dokter"' in content:
            issues.append(f"Dokter link harus dokter.html ({f.name})")
        
        # Check kontak links
        if 'href="#kontak"' in content:
            issues.append(f"Kontak link harus kontak.html ({f.name})")
        
        # Check internal links
        internal_links = re.findall(r'href="([^"#]+\.html)"', content)
        for link in internal_links:
            if not Path(link).exists():
                issues.append(f"Broken link: {link} ({f.name})")
    
    if issues:
        for issue in issues[:10]:
            print_error(issue)
        return False, len(issues)
    else:
        print_success("Semua link benar!")
        return True, 0

def agent_qa_checker():
    """Agent 2: QA Checker"""
    print(f"{BOLD}вң… Agent 2: QA Checker{RESET}")
    
    html_files = [f for f in Path('.').glob('*.html')]
    errors = []
    warnings = []
    
    for f in html_files:
        content = f.read_text(encoding='utf-8')
        
        # HTML Validation
        if '<!DOCTYPE' not in content.upper():
            errors.append(f"Missing DOCTYPE ({f.name})")
        
        if 'viewport' not in content.lower():
            errors.append(f"Missing viewport ({f.name})")
        
        if '<html' in content and 'lang=' not in content:
            warnings.append(f"Missing lang attribute ({f.name})")
        
        # Accessibility
        imgs = re.findall(r'<img[^>]+>', content)
        for img in imgs:
            if 'alt=' not in img.lower():
                warnings.append(f"Image missing alt ({f.name})")
        
        # SEO
        if 'meta name="description"' not in content.lower():
            warnings.append(f"Missing meta description ({f.name})")
    
    if errors:
        for err in errors[:5]:
            print_error(err)
        return False, len(errors), len(warnings)
    else:
        print_success("QA Check Passed!")
        if warnings:
            print_warning(f"{len(warnings)} warnings (non-blocking)")
        return True, 0, len(warnings)

def agent_content_validator():
    """Agent 3: Content Validator"""
    print(f"{BOLD}рҹ“Ӣ Agent 3: Content Validator{RESET}")
    
    # Check dokter list
    dokter_resmi = [
        "dr. I Gusti Putu Hery Sikesa", "dr. Sang Ketut Widiana",
        "dr. Tjokorda Prima Dewi Pemayun", "dr. Made Ayu Widyaningsih",
        "dr. Ni Made Ayu Agustini", "dr. I Gede Agus Hendra Sujana",
        "dr. I Made Brammartha Kusuma", "dr. Pande Made Suwanpramana",
        "dr. Kade Agus Sudha Naryana", "dr. Ni Komang Dewi Mahayani",
        "dr. I G N Bagus Arimanjaya", "dr. Manik Dirgayunitri",
        "dr. I Wayan Eka Arnawa", "dr. I Wayan Suwarna",
        "dr. I Putu Swastika Kepakisan", "dr. I Ketut Wahyu Tri Saputra",
        "dr. I Gede Ketut Alit Satria Nugraha", "dr. Anak Agung Ayu Ngurah Desy Widya Putri",
        "dr. Herry Juniada", "dr. Ika Nurvidha Mahayanthi Mantra",
        "dr. Made Minarti Witarini Dewi", "dr. Theresia Maharani Sari Nastiti"
    ]
    
    dokter_html = Path('dokter.html')
    missing_dokter = []
    
    if dokter_html.exists():
        content = dokter_html.read_text(encoding='utf-8')
        for dokter in dokter_resmi:
            if dokter not in content:
                missing_dokter.append(dokter)
    
    # Check required pages
    required_pages = ['index.html', 'about.html', 'dokter.html', 'kontak.html', 
                      'antrean.html', 'igd.html', 'rawat-jalan.html', 'rawat-inap.html']
    missing_pages = [p for p in required_pages if not Path(p).exists()]
    
    # Check dokter images
    img_dir = Path('img/dokter')
    img_count = len(list(img_dir.glob('*.png'))) if img_dir.exists() else 0
    
    issues = missing_dokter + missing_pages
    
    if issues:
        for issue in issues[:10]:
            print_error(f"Missing: {issue}")
        return False, len(issues)
    else:
        print_success(f"All content valid! ({img_count} dokter images)")
        return True, 0

def generate_report(lc_result, qa_result, cv_result):
    """Generate summary report"""
    print_header("рҹ“Ӣ SUMMARY REPORT")
    
    print(f"{BOLD}Agent Results:{RESET}")
    print(f"  рҹ”Қ Link Checker:    {'✅ Pass' if lc_result[0] else f'❌ {lc_result[1]} errors'}")
    print(f"  вң… QA Checker:      {'✅ Pass' if qa_result[0] else f'❌ {qa_result[1]} errors'}")
    print(f"  рҹ“Ӣ Content Validator: {'✅ Pass' if cv_result[0] else f'❌ {cv_result[1]} errors'}")
    
    total_errors = lc_result[1] + qa_result[1] + cv_result[1]
    total_warnings = qa_result[2]
    
    print(f"\n{BOLD}Total: {RESET}")
    print(f"  Errors: {total_errors}")
    print(f"  Warnings: {total_warnings}")
    
    if total_errors == 0:
        print(f"\n{GREEN}{BOLD}🎉🎉🎉 ALL AGENTS PASSED!{RESET}")
        return True
    else:
        print(f"\n{RED}{BOLD}⚠️⚠️⚠️ SOME AGENTS FAILED{RESET}")
        return False

def main():
    print_header("рҹ“Ӣ PAYANGAN HOSPITAL - /play COMMAND")
    print(f"{BOLD}Timestamp:{RESET} {datetime.now().strftime('%Y-%m-%d %H:%M:%S WITA')}")
    
    # Run all agents
    print_header("рҹ”Қ AGENT 1: LINK CHECKER")
    lc_result = agent_link_checker()
    
    print_header("вң… AGENT 2: QA CHECKER")
    qa_result = agent_qa_checker()
    
    print_header("рҹ“Ӣ AGENT 3: CONTENT VALIDATOR")
    cv_result = agent_content_validator()
    
    # Generate report
    success = generate_report(lc_result, qa_result, cv_result)
    
    # Exit code
    sys.exit(0 if success else 1)

if __name__ == "__main__":
    main()
```

---

## рҹ‘Ҹ Cara Pakai

### Setup (sekali saja):
```bash
cd /workspace/project/Payangan-Hospital
chmod +x scripts/play.py

# Tambahkan ke PATH atau buat alias
echo 'alias play="/workspace/project/Payangan-Hospital/scripts/play.py"' >> ~/.bashrc
source ~/.bashrc
```

### Jalankan /play:
```bash
# Command simple
play

# Atau langsung
python3 scripts/play.py

# Atau dari anywhere
python3 /workspace/project/Payangan-Hospital/scripts/play.py
```

---

## рҹ“Ӣ Output Contoh

```
============================================================
  рҹ“Ӣ PAYANGAN HOSPITAL - /play COMMAND
============================================================

Timestamp: 2026-07-02 00:15:00 WITA

============================================================
  рҹ”Қ AGENT 1: LINK CHECKER
============================================================

✅ Semua link benar!

============================================================
  вң… AGENT 2: QA CHECKER
============================================================

✅ QA Check Passed!
⚠️  5 warnings (non-blocking)

============================================================
  рҹ“Ӣ AGENT 3: CONTENT VALIDATOR
============================================================

✅ All content valid! (22 dokter images)

============================================================
  рҹ“Ӣ SUMMARY REPORT
============================================================

Agent Results:
  рҹ”Қ Link Checker:    ✅ Pass
  вң… QA Checker:      ✅ Pass
  рҹ“Ӣ Content Validator: ✅ Pass

Total:
  Errors: 0
  Warnings: 5

🎉🎉🎉 ALL AGENTS PASSED!
```

---

## рҹ“„ Workflow Lengkap

1. **Local:** `python3 scripts/play.py` atau ketik `play`
2. **GitHub Actions:** Buka Actions tab → Run All Agents
3. **OpenHands Cloud:** Dispatch automation dari dashboard
