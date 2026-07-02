#!/usr/bin/env python3
"""
Payangan Hospital - /play Command
================================
Jalankan semua agent dengan satu command!
Usage: python3 play.py
"""

import os
import sys
import re
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

def print_info(text):
    print(f"{BLUE}ℹ️  {text}{RESET}")

def agent_link_checker():
    """Agent 1: Link Checker"""
    print(f"{BOLD}🔍 Agent 1: Link Checker{RESET}")
    
    html_files = list(Path('.').glob('*.html'))
    print_info(f"Checking {len(html_files)} HTML files...")
    
    issues = []
    
    for f in html_files:
        content = f.read_text(encoding='utf-8')
        
        # Check logo links - CAREFUL: harus cek element yang punya KEDUA attribute
        # Pattern: <a ... class="logo" ... href="#">
        logo_wrong = re.search(r'<a[^>]+class="[^"]*logo[^"]*"[^>]+href="#"', content, re.I)
        if logo_wrong:
            issues.append(f"Logo link harus index.html, bukan # ({f.name})")
        
        # Check dokter links
        if 'href="#dokter"' in content:
            issues.append(f"Dokter link harus dokter.html ({f.name})")
        
        # Check kontak links
        if 'href="#kontak"' in content:
            issues.append(f"Kontak link harus kontak.html ({f.name})")
        
        # Check internal links (exclude external URLs and anchors)
        internal_links = re.findall(r'href="([^"#]+\.html)"', content)
        for link in internal_links:
            if not Path(link).exists():
                issues.append(f"Broken link: {link} ({f.name})")
    
    if issues:
        for issue in issues[:10]:
            print_error(issue)
        if len(issues) > 10:
            print_warning(f"...and {len(issues) - 10} more issues")
        return False, len(issues)
    else:
        print_success("Semua link benar!")
        return True, 0

def agent_qa_checker():
    """Agent 2: QA Checker"""
    print(f"{BOLD}✅ Agent 2: QA Checker{RESET}")
    
    html_files = [f for f in Path('.').glob('*.html')]
    print_info(f"Checking {len(html_files)} HTML files...")
    
    errors = []
    warnings = []
    
    for f in html_files:
        content = f.read_text(encoding='utf-8')
        
        # HTML Validation
        if '<!DOCTYPE' not in content.upper():
            errors.append(f"Missing DOCTYPE ({f.name})")
        
        if 'viewport' not in content.lower():
            errors.append(f"Missing viewport meta ({f.name})")
        
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
    print(f"{BOLD}📋 Agent 3: Content Validator{RESET}")
    
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
        print_info(f"Checking {len(dokter_resmi)} dokter...")
    else:
        missing_dokter.append("dokter.html not found")
    
    # Check required pages
    required_pages = ['index.html', 'about.html', 'dokter.html', 'kontak.html', 
                      'antrean.html', 'igd.html', 'rawat-jalan.html', 'rawat-inap.html']
    missing_pages = [p for p in required_pages if not Path(p).exists()]
    
    # Check dokter images
    img_dir = Path('img/dokter')
    img_count = len(list(img_dir.glob('*.png'))) if img_dir.exists() else 0
    print_info(f"Found {img_count} dokter images")
    
    issues = missing_dokter + missing_pages
    
    if issues:
        for issue in issues[:10]:
            print_error(f"Missing: {issue}")
        return False, len(issues)
    else:
        print_success("All content valid!")
        return True, 0

def generate_report(lc_result, qa_result, cv_result):
    """Generate summary report"""
    print_header("📋 SUMMARY REPORT")
    
    print(f"{BOLD}Agent Results:{RESET}")
    print(f"  🔍 Link Checker:      {'✅ Pass' if lc_result[0] else f'❌ {lc_result[1]} errors'}")
    print(f"  ✅ QA Checker:        {'✅ Pass' if qa_result[0] else f'❌ {qa_result[1]} errors'}")
    print(f"  📋 Content Validator: {'✅ Pass' if cv_result[0] else f'❌ {cv_result[1]} errors'}")
    
    total_errors = lc_result[1] + qa_result[1] + cv_result[1]
    total_warnings = qa_result[2]
    
    print(f"\n{BOLD}Total:{RESET}")
    print(f"  Errors: {total_errors}")
    print(f"  Warnings: {total_warnings}")
    
    if total_errors == 0:
        print(f"\n{GREEN}{BOLD}🎉🎉🎉 ALL AGENTS PASSED!{RESET}")
        return True
    else:
        print(f"\n{RED}{BOLD}⚠️⚠️⚠️ SOME AGENTS FAILED{RESET}")
        return False

def main():
    print_header("📋 PAYANGAN HOSPITAL - /play COMMAND")
    print(f"{BOLD}Timestamp:{RESET} {datetime.now().strftime('%Y-%m-%d %H:%M:%S WITA')}")
    
    # Run all agents
    print_header("🔍 AGENT 1: LINK CHECKER")
    lc_result = agent_link_checker()
    
    print_header("✅ AGENT 2: QA CHECKER")
    qa_result = agent_qa_checker()
    
    print_header("📋 AGENT 3: CONTENT VALIDATOR")
    cv_result = agent_content_validator()
    
    # Generate report
    success = generate_report(lc_result, qa_result, cv_result)
    
    # Exit code
    sys.exit(0 if success else 1)

if __name__ == "__main__":
    main()
