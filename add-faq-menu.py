#!/usr/bin/env python3
"""Add FAQ menu to all HTML pages"""
import os
import re

def add_faq_to_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    original_content = content
    
    # Add FAQ to desktop navigation (before Contact) - nav-link-premium style
    patterns_premium = [
        (r'(<a href="kontak\.html" class="nav-link-premium nav-link">Contact</a>)', '<a href="faq.html" class="nav-link-premium nav-link">FAQ</a>\n                    \\1'),
        (r'(<a href="kontak\.html" class="nav-link-premium nav-link">Kontak</a>)', '<a href="faq.html" class="nav-link-premium nav-link">FAQ</a>\n                    \\1'),
        (r'(<a href="kontak\.html" class="mobile-nav-link">Kontak</a>)', '<a href="faq.html" class="mobile-nav-link">FAQ</a>\n            \\1'),
        (r'(<a href="kontak\.html" class="mobile-nav-link">Contact</a>)', '<a href="faq.html" class="mobile-nav-link">FAQ</a>\n            \\1'),
    ]
    
    for pattern, replacement in patterns_premium:
        content = re.sub(pattern, replacement, content)
    
    # Add FAQ to nav-links li style
    patterns_li = [
        (r'(<li><a href="kontak\.html">Kontak</a></li>)', '<li><a href="faq.html">FAQ</a></li>\n                    \\1'),
        (r'(<li><a href="kontak\.html" onclick="toggleMenu\(\)">Kontak</a></li>)', '<li><a href="faq.html" onclick="toggleMenu()">FAQ</a></li>\n            \\1'),
    ]
    
    for pattern, replacement in patterns_li:
        content = re.sub(pattern, replacement, content)
    
    # Add FAQ to Tailwind-style navigation (dokumen.html)
    patterns_tw = [
        (r'(<a href="kontak\.html" class="text-gray-600 hover:text-teal-600 transition">Kontak</a>)', '<a href="faq.html" class="text-gray-600 hover:text-teal-600 transition">FAQ</a>\n                    \\1'),
    ]
    
    for pattern, replacement in patterns_tw:
        content = re.sub(pattern, replacement, content)
    
    if content != original_content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        return True
    return False

def main():
    html_files = [
        'index.html', 'about.html', 'dokter.html', 'igd.html',
        'kontak.html', 'antrean.html', 'preview.html', 'chat.html',
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
            if add_faq_to_file(filepath):
                print(f"✅ Added FAQ menu to: {filename}")
            else:
                print(f"⬜ No changes in: {filename}")
        else:
            print(f"❌ File not found: {filename}")

if __name__ == '__main__':
    main()
