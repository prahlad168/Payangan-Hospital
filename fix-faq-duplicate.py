#!/usr/bin/env python3
"""Fix duplicate FAQ links in all HTML files"""
import os
import re

def fix_duplicates(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    original_content = content
    
    # Remove duplicate FAQ lines - keep only one
    # Pattern: multiple <a href="faq.html" in sequence
    content = re.sub(
        r'(<a href="faq\.html"[^>]*>FAQ</a>\s*)\1+',
        r'\1',
        content
    )
    
    # Remove duplicate FAQ lines more aggressively
    lines = content.split('\n')
    new_lines = []
    prev_line = None
    faq_count = 0
    
    for line in lines:
        if 'href="faq.html"' in line and 'FAQ</a>' in line:
            faq_count += 1
            if faq_count == 1:
                new_lines.append(line)
            # Skip duplicate FAQ lines
        else:
            new_lines.append(line)
            faq_count = 0
    
    content = '\n'.join(new_lines)
    
    if content != original_content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        return True
    return False

def main():
    html_files = [
        'index.html', 'about.html', 'dokter.html', 'igd.html',
        'kontak.html', 'antrean.html', 'preview.html',
        'poli-anak.html', 'poli-bedah.html', 'poli-dalam.html', 'poli-gigi.html',
        'poli-jantung.html', 'poli-kandungan.html', 'poli-orthopedic.html',
        'poli-saraf.html', 'poli-tht.html', 'poli-umum.html',
        'berita.html', 'dokumen.html', 'faq.html', 'fasilitas.html',
        'galeri.html', 'laboratorium.html', 'layanan.html',
        'rawat-inap.html', 'rawat-jalan.html', '404.html'
    ]
    
    for filename in html_files:
        filepath = os.path.join(os.path.dirname(__file__), filename)
        if os.path.exists(filepath):
            if fix_duplicates(filepath):
                print(f"✅ Fixed duplicates in: {filename}")
            else:
                print(f"⬜ No duplicates in: {filename}")
        else:
            print(f"❌ File not found: {filename}")

if __name__ == '__main__':
    main()
