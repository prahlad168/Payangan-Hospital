#!/usr/bin/env python3
"""Remove shimmer animation from all HTML files"""
import os
import re

def remove_shimmer_from_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    original_content = content
    
    # Remove shimmer keyframes
    content = re.sub(
        r'\s*@keyframes shimmer\s*\{[^}]+\}\s*',
        '\n',
        content,
        flags=re.DOTALL
    )
    
    # Remove .logo-shimmer-wrap CSS class
    content = re.sub(
        r'\s*\.logo-shimmer-wrap\s*\{[^}]+\}\s*',
        '\n',
        content,
        flags=re.DOTALL
    )
    
    # Remove .logo-shimmer-wrap::before
    content = re.sub(
        r'\s*\.logo-shimmer-wrap::before\s*\{[^}]+\}\s*',
        '\n',
        content,
        flags=re.DOTALL
    )
    
    # Remove .logo-shimmer-wrap::after
    content = re.sub(
        r'\s*\.logo-shimmer-wrap::after\s*\{[^}]+\}\s*',
        '\n',
        content,
        flags=re.DOTALL
    )
    
    # Remove .logo-shimmer class
    content = re.sub(
        r'\s*\.logo-shimmer\s*\{[^}]+\}\s*',
        '\n',
        content,
        flags=re.DOTALL
    )
    
    # Remove shimmer from .logo-shimmer-wrap img
    content = re.sub(
        r'\s*\.logo-shimmer-wrap img\s*\{[^}]+\}\s*',
        '\n',
        content,
        flags=re.DOTALL
    )
    
    # Replace logo-shimmer-wrap span with just img
    content = re.sub(
        r'<span class="logo-shimmer-wrap"><img([^>]*)class="logo-shimmer"([^>]*)></span>',
        r'<img\1\2>',
        content
    )
    
    # Replace logo-shimmer class on img with just the img tag
    content = re.sub(
        r'<img([^>]*)class="[^"]*logo-shimmer[^"]*"([^>]*)>',
        r'<img\1\2>',
        content
    )
    
    if content != original_content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        return True
    return False

def main():
    html_files = [
        'about.html', 'antrean.html', 'kontak.html', 'igd.html',
        'dokter.html', 'index.html', 'poli-anak.html', 'poli-bedah.html',
        'poli-dalam.html', 'poli-gigi.html', 'poli-jantung.html',
        'poli-kandungan.html', 'poli-orthopedic.html', 'poli-saraf.html',
        'poli-tht.html', 'poli-umum.html', 'berita.html', 'dokumen.html',
        'faq.html', 'fasilitas.html', 'galeri.html', 'laboratorium.html',
        'layanan.html', 'preview.html', 'rawat-inap.html', 'rawat-jalan.html',
        '404.html', 'ga4-setup-code.html', 'google284d6a9dca3b4beb.html'
    ]
    
    for filename in html_files:
        filepath = os.path.join(os.path.dirname(__file__), filename)
        if os.path.exists(filepath):
            if remove_shimmer_from_file(filepath):
                print(f"✅ Removed shimmer from: {filename}")
            else:
                print(f"⬜ No shimmer found in: {filename}")
        else:
            print(f"❌ File not found: {filename}")

if __name__ == '__main__':
    main()
