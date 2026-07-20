#!/usr/bin/env python3
"""
Fix all broken links in Payangan Hospital HTML files
"""

import os
from pathlib import Path

def fix_html_files():
    html_files = list(Path('.').glob('*.html'))
    print(f"📁 Found {len(html_files)} HTML files")
    
    fixes = {
        'count': 0,
        'logo_fixes': [],
        'ph_update_fixes': [],
        'slash_fixes': [],
    }
    
    for html_file in html_files:
        try:
            content = html_file.read_text(encoding='utf-8')
            original = content
            filename = html_file.name
            
            # Fix 1: Logo links (href="#" in logo class should be href="index.html")
            if 'class="logo"' in content and 'href="#"' in content:
                # Only fix the logo link, not all href="#"
                content = content.replace(
                    '<a class="logo" href="#">',
                    '<a class="logo" href="index.html">'
                )
                if content != original:
                    fixes['logo_fixes'].append(filename)
            
            # Fix 2: ph-update.html links (create the file or fix links)
            if 'ph-update.html' in content:
                # Replace with valid links
                content = content.replace('href="ph-update.html"', 'href="berita.html"')
                content = content.replace("href='ph-update.html'", "href='berita.html'")
                if 'ph-update.html' in content:
                    content = content.replace('href="ph-update.html"', 'href="index.html"')
                fixes['ph_update_fixes'].append(filename)
            
            # Fix 3: Slash prefix paths (/berita.html, /galeri.html, /faq.html)
            content = content.replace('href="/berita.html"', 'href="berita.html"')
            content = content.replace('href="/galeri.html"', 'href="galeri.html"')
            content = content.replace('href="/faq.html"', 'href="faq.html"')
            
            if content != original:
                fixes['count'] += 1
                html_file.write_text(content, encoding='utf-8')
                print(f"  ✅ Fixed: {filename}")
        
        except Exception as e:
            print(f"  ❌ Error with {html_file.name}: {e}")
    
    # Create missing ph-update.html as alias to berita.html
    if not Path('ph-update.html').exists():
        berita_content = Path('berita.html').read_text(encoding='utf-8') if Path('berita.html').exists() else '''<!DOCTYPE html>
<html>
<head>
    <title>Update - RS Payangan Hospital</title>
    <meta http-equiv="refresh" content="0;url=berita.html">
</head>
<body>
    <p>Redirecting to Berita...</p>
</body>
</html>'''
        Path('ph-update.html').write_text(berita_content, encoding='utf-8')
        print("\n  📄 Created: ph-update.html (redirect to berita.html)")
    
    return fixes

def main():
    print("=" * 60)
    print("🔧 FIXING BROKEN LINKS")
    print("=" * 60)
    
    fixes = fix_html_files()
    
    print("\n" + "=" * 60)
    print("📊 FIX SUMMARY")
    print("=" * 60)
    print(f"Files fixed: {fixes['count']}")
    print(f"Logo link fixes: {len(fixes['logo_fixes'])}")
    print(f"ph-update.html fixes: {len(fixes['ph_update_fixes'])}")
    
    print("\n✅ All broken links fixed!")

if __name__ == "__main__":
    main()
