#!/usr/bin/env python3
"""
Payangan Hospital - /play Command (13 Agents)
Jalankan 13 agents untuk optimasi website!
"""
import os, sys, re
from pathlib import Path
from datetime import datetime

GREEN = '\033[92m'; RED = '\033[91m'; YELLOW = '\033[93m'
BLUE = '\033[94m'; CYAN = '\033[96m'; BOLD = '\033[1m'; RESET = '\033[0m'

results = []

def ph(t): print(f"\n{BLUE}{BOLD}{'='*60}{RESET}\n{BLUE}{BOLD}  {t}{RESET}\n{BLUE}{BOLD}{'='*60}{RESET}\n")
def ag(n, name, icon): print(f"{CYAN}Agent {n}:{RESET} {icon} {BOLD}{name}{RESET}")
def ok(t): print(f"{GREEN}✅ {t}{RESET}")
def er(t): print(f"{RED}❌ {t}{RESET}")
def wn(t): print(f"{YELLOW}⚠️  {t}{RESET}")
def nf(t): print(f"{BLUE}ℹ️  {t}{RESET}")

# 1: Link Checker
def a1():
    ag(1, "Link Checker", "🔍"); nf(f"Checking {len(list(Path('.').glob('*.html')))} files")
    issues = []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        if re.search(r'<a[^>]+class="[^"]*logo[^"]*"[^>]+href="#"', c, re.I): issues.append(f"Logo ({f.name})")
        if 'href="#dokter"' in c: issues.append(f"Dokter ({f.name})")
        if 'href="#kontak"' in c: issues.append(f"Kontak ({f.name})")
        for l in re.findall(r'href="([^"#]+\.html)"', c):
            if not Path(l).exists(): issues.append(f"Broken: {l}")
    if issues: [er(i) for i in issues[:5]]; return False, issues
    ok("Semua link benar!"); return True, []

# 2: QA Checker
def a2():
    ag(2, "QA Checker", "✅"); errors, warnings = [], []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        if '<!DOCTYPE' not in c.upper(): errors.append(f"DOCTYPE ({f.name})")
        if 'viewport' not in c.lower(): errors.append(f"viewport ({f.name})")
        if '<html' in c and 'lang=' not in c: warnings.append(f"lang ({f.name})")
    if errors: [er(e) for e in errors[:3]]; return False, errors
    ok("QA Check Passed!"); return True, warnings

# 3: Content Validator
def a3():
    ag(3, "Content Validator", "📋")
    dr = ["dr. I Gusti Putu Hery Sikesa","dr. Sang Ketut Widiana","dr. Tjokorda Prima Dewi Pemayun","dr. Made Ayu Widyaningsih","dr. Ni Made Ayu Agustini","dr. I Gede Agus Hendra Sujana","dr. I Made Brammartha Kusuma","dr. Pande Made Suwanpramana","dr. Kade Agus Sudha Naryana","dr. Ni Komang Dewi Mahayani","dr. I G N Bagus Arimanjaya","dr. Manik Dirgayunitri","dr. I Wayan Eka Arnawa","dr. I Wayan Suwarna","dr. I Putu Swastika Kepakisan","dr. I Ketut Wahyu Tri Saputra","dr. I Gede Ketut Alit Satria Nugraha","dr. Anak Agung Ayu Ngurah Desy Widya Putri","dr. Herry Juniada","dr. Ika Nurvidha Mahayanthi Mantra","dr. Made Minarti Witarini Dewi","dr. Theresia Maharani Sari Nastiti"]
    missing = []
    if Path('dokter.html').exists():
        c = Path('dokter.html').read_text(encoding='utf-8')
        for d in dr:
            if d not in c: missing.append(d)
    for p in ['index.html','about.html','dokter.html','kontak.html','antrean.html','igd.html']:
        if not Path(p).exists(): missing.append(f"Missing: {p}")
    img_count = len(list(Path('img/dokter').glob('*.png'))) if Path('img/dokter').exists() else 0
    if missing: [er(f"Missing: {m}") for m in missing[:5]]; return False, missing
    ok(f"Content valid! ({len(dr)} dokter, {img_count} images)"); return True, []

# 4: SEO Optimizer
def a4():
    ag(4, "SEO Optimizer", "🔍"); issues = []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        if 'meta name="description"' not in c.lower(): issues.append(f"description ({f.name})")
        if '<title>' not in c: issues.append(f"title ({f.name})")
    if issues: [wn(i) for i in issues[:5]]; return False, issues
    ok("SEO optimized!"); return True, []

# 5: Performance
def a5():
    ag(5, "Performance", "⚡"); issues = []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        s = len(re.findall(r'style="', c))
        if s > 30: issues.append(f"Inline styles: {s} ({f.name})")
    if issues: [wn(i) for i in issues[:3]]; return False, issues
    ok("Performance OK!"); return True, []

# 6: Accessibility
def a6():
    ag(6, "Accessibility", "♿"); issues = []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        for img in re.findall(r'<img[^>]+>', c):
            if 'alt=' not in img.lower(): issues.append(f"alt ({f.name})"); break
    if issues: [wn(i) for i in issues[:3]]; return False, issues
    ok("Accessibility OK!"); return True, []

# 7: UI/UX
def a7():
    ag(7, "UI/UX Enhancer", "🎨"); issues = []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        if 'div class="nav"' in c.lower(): issues.append(f"Use <nav> ({f.name})")
    if issues: [wn(i) for i in issues[:3]]; return False, issues
    ok("UI/UX OK!"); return True, []

# 8: Images
def a8():
    ag(8, "Image Optimizer", "🖼️")
    img_dir = Path('img/dokter')
    if not img_dir.exists(): er("img/dokter not found!"); return False, ["Dir not found"]
    imgs = list(img_dir.glob('*'))
    issues = [f"{i.name} ({i.stat().st_size//1024}KB)" for i in imgs if i.stat().st_size > 500000]
    if issues: [wn(f"Large: {i}") for i in issues[:3]]; return False, issues
    ok(f"All {len(imgs)} images OK!"); return True, []

# 9: Code Quality
def a9():
    ag(9, "Code Quality", "📝"); issues = []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        b = c.count('<br>')
        if b > 5: issues.append(f"<br> tags: {b} ({f.name})")
    if issues: [wn(i) for i in issues[:3]]; return False, issues
    ok("Code quality OK!"); return True, []

# 10: Mobile
def a10():
    ag(10, "Mobile Responsive", "📱"); issues = []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        if 'viewport' not in c.lower(): issues.append(f"viewport ({f.name})")
    if issues: [wn(i) for i in issues[:3]]; return False, issues
    ok("Mobile responsive!"); return True, []

# 11: Security
def a11():
    ag(11, "Security Checker", "🔒"); issues = []
    for f in Path('.').glob('*.html'):
        c = f.read_text(encoding='utf-8')
        if 'http://' in c and 'cdn' not in c.lower(): issues.append(f"HTTP ({f.name})")
    if issues: [wn(i) for i in issues[:3]]; return False, issues
    ok("Security OK!"); return True, []

# 12: Freshness
def a12():
    ag(12, "Content Freshness", "🕐"); issues = []
    if Path('ph-update.html').exists():
        c = Path('ph-update.html').read_text(encoding='utf-8')
        if '2026' not in c: issues.append("No 2026 content")
    else: issues.append("ph-update.html not found")
    if issues: [wn(i) for i in issues]; return False, issues
    ok("Content fresh!"); return True, []

# 13: Deployment
def a13():
    ag(13, "Deployment Ready", "🚀"); issues = []
    for item in ['index.html','logo.png']:
        if not Path(item).exists(): issues.append(f"Missing: {item}")
    if issues: [er(i) for i in issues]; return False, issues
    ok("Ready for deployment!"); return True, []

# Update Progress Page
def update_progress():
    Path('progress').mkdir(exist_ok=True)
    names = ["Link Checker","QA Checker","Content Validator","SEO Optimizer","Performance","Accessibility","UI/UX","Images","Code Quality","Mobile","Security","Freshness","Deployment"]
    passed = sum(1 for r in results if r[0])
    failed = sum(1 for r in results if not r[0])
    warnings = sum(len(r[1]) for r in results)
    ts = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
    
    html = f'''<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Optimization Report - Payangan Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {{ font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }}
        .glass {{ background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 8px 32px rgba(0,0,0,0.1); padding: 24px; margin-bottom: 20px; }}
    </style>
</head>
<body>
    <div class="max-w-5xl mx-auto">
        <div class="glass text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">📋 Website Optimization Report</h1>
            <p class="text-gray-600">Payangan Hospital - 13 Agents Optimization</p>
            <p class="text-sm text-gray-500 mt-2">Generated: {ts} WITA</p>
            <p class="text-xs text-gray-400 mt-1">Target: payanganhospital.gianyarkab.go.id/progress/</p>
        </div>
        
        <div class="glass">
            <h2 class="text-xl font-bold mb-4">📊 Summary</h2>
            <div class="grid grid-cols-4 gap-4">
                <div class="bg-blue-100 rounded-xl p-4 text-center"><div class="text-3xl font-bold text-blue-600">13</div><div class="text-sm text-gray-600">Total Agents</div></div>
                <div class="bg-green-100 rounded-xl p-4 text-center"><div class="text-3xl font-bold text-green-600">{passed}</div><div class="text-sm text-gray-600">Passed</div></div>
                <div class="bg-red-100 rounded-xl p-4 text-center"><div class="text-3xl font-bold text-red-600">{failed}</div><div class="text-sm text-gray-600">Failed</div></div>
                <div class="bg-yellow-100 rounded-xl p-4 text-center"><div class="text-3xl font-bold text-yellow-600">{warnings}</div><div class="text-sm text-gray-600">Warnings</div></div>
            </div>
        </div>
        
        <div class="glass">
            <h2 class="text-xl font-bold mb-4">🔍 Agent Results</h2>
            <table class="w-full">
                <thead><tr class="bg-gray-100"><th class="p-3 text-left">#</th><th class="p-3 text-left">Agent</th><th class="p-3 text-left">Status</th><th class="p-3 text-left">Issues</th></tr></thead>
                <tbody>
'''
    for i,(p,issues) in enumerate(results):
        status = '<span class="bg-green-100 text-green-600 px-2 py-1 rounded text-sm">✅ Pass</span>' if p else '<span class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm">❌ Fail</span>'
        html += f'<tr class="border-b"><td class="p-3">{i+1}</td><td class="p-3 font-medium">{names[i]}</td><td class="p-3">{status}</td><td class="p-3 text-gray-500">{len(issues)}</td></tr>'
    html += '</tbody></table></div>'
    
    html += '<div class="glass"><h2 class="text-xl font-bold mb-4">📝 Issues Found</h2><ul class="list-disc pl-5">'
    for i,(p,issues) in enumerate(results):
        if issues:
            html += f'<li class="mb-2"><strong>{names[i]}:</strong><ul class="list-disc pl-5 text-sm text-gray-600">'
            for issue in issues[:5]:
                html += f'<li>{issue}</li>'
            html += '</ul></li>'
    html += '</ul></div>'
    
    if failed == 0:
        html += '<div class="glass text-center"><p class="text-green-600 font-bold text-xl">🎉 ALL 13 AGENTS PASSED!</p><p class="text-gray-500 mt-2">Website optimization complete! Ready for deployment!</p></div>'
    else:
        html += f'<div class="glass text-center"><p class="text-red-600 font-bold text-xl">⚠️ {failed} AGENTS FAILED</p><p class="text-gray-500 mt-2">Please fix issues and run /play again</p></div>'
    
    html += f'''<div class="text-center text-gray-500 text-sm mt-6">
        <p>Generated by 🚀 Play Command - 13 Agents | {ts} WITA</p>
    </div></div></body></html>'''
    
    with open('progress/index.html', 'w', encoding='utf-8') as f:
        f.write(html)
    nf("Report saved to progress/index.html")

# MAIN
def main():
    ph("📋 PAYANGAN HOSPITAL - /play (13 AGENTS)")
    print(f"{BOLD}Timestamp:{RESET} {datetime.now().strftime('%Y-%m-%d %H:%M:%S WITA')}")
    print(f"{BOLD}Target:{RESET} https://payanganhospital.gianyarkab.go.id/progress/")
    ph("🔄 RUNNING ALL 13 AGENTS")
    results.append(a1()); results.append(a2()); results.append(a3()); results.append(a4()); results.append(a5())
    results.append(a6()); results.append(a7()); results.append(a8()); results.append(a9()); results.append(a10())
    results.append(a11()); results.append(a12()); results.append(a13())
    ph("📊 SUMMARY")
    names = ["Link","QA","Content","SEO","Perf","A11y","UI/UX","Images","Code","Mobile","Security","Fresh","Deploy"]
    passed = sum(1 for r in results if r[0]); failed = sum(1 for r in results if not r[0])
    for i,(p,issues) in enumerate(results):
        print(f"  Agent {i+1:2d}: {'✅' if p else '❌'} ({len(issues)})")
    print(f"\n{BOLD}Total: Passed {GREEN}{passed}{RESET}/13, Failed {RED if failed > 0 else GREEN}{failed}{RESET}/13")
    ph("💾 SAVING REPORT"); update_progress()
    print(f"\n{'='*60}")
    if failed == 0: print(f"{GREEN}{BOLD}🎉🎉🎉 ALL 13 AGENTS PASSED!{RESET}")
    else: print(f"{RED}{BOLD}⚠️ {failed} AGENTS FAILED{RESET}")
    print('='*60)
    sys.exit(0 if failed == 0 else 1)

if __name__ == "__main__": main()
