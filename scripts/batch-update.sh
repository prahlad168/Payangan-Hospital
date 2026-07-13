#!/bin/bash
# Batch update script for all HTML pages to add premium CSS and JS

# Add premium CSS links after Font Awesome
add_premium_css() {
    local file=$1
    
    # Check if premium CSS already added
    if grep -q "premium-upgrade.css" "$file"; then
        echo "⏭️  Skipping $file (already updated)"
        return
    fi
    
    # Add premium CSS after Font Awesome
    sed -i 's|<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">|<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">\n    <link rel="stylesheet" href="css/design-system.css">\n    <link rel="stylesheet" href="css/premium-upgrade.css">|' "$file"
    
    echo "✅ Updated CSS in $file"
}

# Add premium JS before closing body tag
add_premium_js() {
    local file=$1
    
    # Check if premium JS already added
    if grep -q "mahacare-ai.js" "$file"; then
        echo "⏭️  Skipping JS update for $file (already added)"
        return
    fi
    
    # Add premium JS before </body>
    sed -i 's|</body>|    <script src="js/premium-ui.js"></script>\n    <script src="js/mahacare-ai.js"></script>\n</body>|' "$file"
    
    echo "✅ Updated JS in $file"
}

# Update specific elements
update_elements() {
    local file=$1
    
    # Add premium classes to buttons
    sed -i 's/class="btn-appointment"/class="btn-primary-premium btn-appointment"/g' "$file"
    sed -i 's/class="btn-primary"/class="btn-premium btn-primary-premium"/g' "$file"
    sed -i 's/class="btn-emergency"/class="btn-premium btn-emergency-premium"/g' "$file"
    sed -i 's/class="btn-outline"/class="btn-premium btn-outline-premium"/g' "$file"
    
    # Add premium classes to cards
    sed -i 's/class="card"/class="premium-card card-hover"/g' "$file"
    
    # Add container-premium class
    sed -i 's/class="container"/class="container-premium container"/g' "$file"
    
    # Add section-label-premium
    sed -i 's/class="section-label"/class="section-label-premium section-label"/g' "$file"
    
    # Add section-title-premium
    sed -i 's/class="section-title"/class="section-title-premium section-title"/g' "$file"
    
    echo "✅ Updated elements in $file"
}

# List of HTML files to update
HTML_FILES=(
    "about.html"
    "dokter.html"
    "layanan.html"
    "kontak.html"
    "igd.html"
    "poli-anak.html"
    "poli-bedah.html"
    "poli-dalam.html"
    "poli-gigi.html"
    "poli-jantung.html"
    "poli-kandungan.html"
    "poli-orthopedic.html"
    "poli-saraf.html"
    "poli-tht.html"
    "poli-umum.html"
    "rawat-inap.html"
    "rawat-jalan.html"
    "fasilitas.html"
    "berita.html"
    "galeri.html"
    "faq.html"
    "antrean.html"
)

echo "🚀 Starting batch update..."
echo ""

for file in "${HTML_FILES[@]}"; do
    if [ -f "$file" ]; then
        echo "📄 Processing $file..."
        add_premium_css "$file"
        add_premium_js "$file"
        update_elements "$file"
        echo ""
    else
        echo "⚠️  File not found: $file"
        echo ""
    fi
done

echo "🎉 Batch update complete!"
