/**
 * Schema Markup for RS Payangan Hospital
 * Add this to all pages in the <head> section
 * 
 * Usage: Include this file before </head> or add inline
 */

// Hospital Schema
const hospitalSchema = {
    "@context": "https://schema.org",
    "@type": "Hospital",
    "name": "RS Payangan Hospital",
    "alternateName": "Rumah Sakit Payangan",
    "description": "Rumah Sakit Pemerintah Daerah Gianyar, Bali dengan pelayanan kesehatan modern dan sentuhan humanis. 22+ dokter spesialis, IGD 24 jam, fasilitas modern.",
    "url": "https://payanganhospital.gianyarkab.go.id/",
    "telephone": "+62-361-xxxxxxx",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Payangan",
        "addressLocality": "Gianyar",
        "addressRegion": "Bali",
        "postalCode": "80552",
        "addressCountry": "ID"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "-8.4085",
        "longitude": "115.2315"
    },
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens": "00:00",
            "closes": "23:59"
        }
    ],
    "medicalSpecialty": [
        "General Medicine",
        "Pediatrics",
        "Obstetrics & Gynecology",
        "Internal Medicine",
        "Surgery",
        "Cardiology",
        "Neurology",
        "ENT (Ear, Nose, Throat)",
        "Orthopedics",
        "Dentistry"
    ],
    "availableService": [
        {
            "@type": "MedicalProcedure",
            "name": "IGD 24 Jam",
            "description": "Instalasi Gawat Darurat 24 jam"
        },
        {
            "@type": "MedicalProcedure",
            "name": "Rawat Inap",
            "description": "Pelayanan rawat inap dengan kamar moderna"
        },
        {
            "@type": "MedicalProcedure",
            "name": "Rawat Jalan",
            "description": "Konsultasi dokter spesialis"
        },
        {
            "@type": "MedicalProcedure",
            "name": "Laboratorium",
            "description": "Pemeriksaan laboratorium lengkap"
        },
        {
            "@type": "MedicalProcedure",
            "name": "Radiologi",
            "description": "Pemeriksaan radiologi modern"
        }
    ],
    "image": "https://payanganhospital.gianyarkab.go.id/img/logo.png",
    "logo": "https://payanganhospital.gianyarkab.go.id/img/logo.png",
    "sameAs": [
        "https://www.facebook.com/rspayangan",
        "https://www.instagram.com/rspayangan",
        "https://maps.google.com/?q=RS+Payangan+Hospital+Gianyar"
    ]
};

// Doctor Schema Template (for individual doctor pages)
const doctorSchemaTemplate = {
    "@context": "https://schema.org",
    "@type": "Physician",
    "name": "", // Fill with doctor name
    "description": "", // Fill with doctor specialization
    "medicalSpecialty": "", // Fill with specialty
    "hospital": {
        "@type": "Hospital",
        "name": "RS Payangan Hospital",
        "url": "https://payanganhospital.gianyarkab.go.id/"
    },
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Gianyar",
        "addressRegion": "Bali",
        "addressCountry": "ID"
    },
    "telephone": "+62-361-xxxxxxx"
};

// Function to inject schema markup
function injectSchemaMarkup() {
    // Hospital Schema
    const hospitalScript = document.createElement('script');
    hospitalScript.type = 'application/ld+json';
    hospitalScript.textContent = JSON.stringify(hospitalSchema);
    document.head.appendChild(hospitalScript);
    
    // Add Hospital to Search Box
    const searchBoxSchema = {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "RS Payangan Hospital",
        "url": "https://payanganhospital.gianyarkab.go.id/",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://payanganhospital.gianyarkab.go.id/?s={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    };
    
    const searchScript = document.createElement('script');
    searchScript.type = 'application/ld+json';
    searchScript.textContent = JSON.stringify(searchBoxSchema);
    document.head.appendChild(searchScript);
}

// Inject on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', injectSchemaMarkup);
} else {
    injectSchemaMarkup();
}

// Export for manual use if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { hospitalSchema, doctorSchemaTemplate };
}
