# 🔧 GOOGLE SEARCH CONSOLE SETUP GUIDE
## RS Payangan Hospital

**Tanggal:** 2026-07-19
**Status:** Ready to Setup

---

## 📋 PANDUAN LENGKAP

### STEP 1: Buka Google Search Console

1. Buka browser dan kunjungi: **https://search.google.com/search-console**
2. Login dengan akun Google Anda
3. Klik **"Add property"**

---

### STEP 2: Pilih Metode Verifikasi

#### **OPSI A: Domain Verification (Recommended)**
```
1. Pilih "Domain"
2. Masukkan: payanganhospital.gianyarkab.go.id
3. Copy kode TXT verification
4. Buka cPanel → DNS Zone Editor → Tambah TXT record
5. Klik "Verify"
```

#### **OPSI B: URL Prefix (Lebih Mudah)**
```
1. Pilih "URL prefix"
2. Masukkan: https://payanganhospital.gianyarkab.go.id/
3. Pilih metode verifikasi:
   - HTML file upload → Download file → Upload ke hosting
   - HTML tag → Copy meta tag → Tambahkan ke index.html
   - Google Analytics → Tambahkan kode tracking
   - Google Tag Manager → Tambahkan container snippet
```

---

### STEP 3: Verifikasi (Opsi B - HTML Tag)

#### Tambahkan meta tag ke index.html:

```html
<!-- Google Search Console Verification - TAMBAHKAN DI <HEAD> -->
<meta name="google-site-verification" content="XXXXX_VERIFICATION_CODE_XXXXX" />
```

**Code verification akan diberikan saat setup**

---

### STEP 4: Submit Sitemap.xml

1. Setelah verifikasi berhasil
2. Di sidebar kiri → Klik **"Sitemaps"**
3. Di field "Add a sitemap" → Masukkan: `sitemap.xml`
4. Klik **"Submit"**

---

### STEP 5: Setup Monitoring

#### Fitur yang perlu diaktifkan:

| Fitur | Lokasi | Fungsi |
|-------|--------|--------|
| **Performance** | Dashboard | Track impressions, clicks, CTR |
| **URL Inspection** | Search bar | Periksa status URL individual |
| **Coverage** | Index → Coverage | Cek indexing status |
| **Sitemaps** | Index → Sitemaps | Monitor sitemap health |
| **Links** | Index → Links | Backlinks & internal links |

---

## 📊 FEATURES YANG AKAN DIGUNAKAN

### 1. Performance Report
```
Melihat:
- Total impressions (tampilan di Google)
- Total clicks (orang yang klik)
- Average CTR (click-through rate)
- Average position (ranking rata-rata)

Target Metrics:
- Impressions: 500 → 2,000/mo
- Clicks: 50 → 500/mo
- CTR: 2% → 5%
- Position: 10 → 3
```

### 2. URL Inspection
```
Untuk cek:
- Apakah page ter-index
- Error indexing
- Canonical URL
- Mobile usability
- Core Web Vitals
```

### 3. Coverage Report
```
Status yang perlu dipantau:
- ✅ Valid - Good
- ⚠️ Valid with warnings
- ❌ Error
- ⏳ Excluded
```

---

## 🎯 TARGET SETELAH SETUP GSC

| Metric | Baseline | Target (3 bulan) |
|--------|---------|------------------|
| Indexed Pages | ~20 | 35 |
| Impressions | 500/mo | 2,000/mo |
| Clicks | 50/mo | 500/mo |
| Avg Position | 10 | 3 |
| CTR | 2% | 5% |

---

## 📱 MOBILE USABILITY CHECK

Pastikan semua halaman:
- [ ] Responsive di mobile
- [ ] Tap targets cukup besar
- [ ] Viewport configured
- [ ] No horizontal scroll
- [ ] Font size readable

---

## 🔍 CORE WEB VITALS TARGET

| Metric | Good | Needs Work | Poor |
|--------|------|------------|------|
| LCP | <2.5s | 2.5-4s | >4s |
| FID | <100ms | 100-300ms | >300ms |
| CLS | <0.1 | 0.1-0.25 | >0.25 |

---

## 📧 ALERT SETTINGS

Setup email alerts untuk:

| Alert Type | Threshold | Action |
|------------|-----------|--------|
| Indexing Errors | Any | Fix immediately |
| Manual Actions | Any | Fix immediately |
| Performance Drop | >20% | Investigate |
| Coverage Issues | >5% | Review |

---

## 🚀 NEXT STEPS SETELAH GSC TERSETUP

### Minggu 1:
1. [ ] Verify ownership di GSC ✅
2. [ ] Submit sitemap.xml ✅
3. [ ] Cek Coverage report
4. [ ] Request indexing untuk halaman baru

### Minggu 2:
1. [ ] Analisis Performance report
2. [ ] Identifikasi top performing pages
3. [ ] Identifikasi pages dengan impressions tapi low clicks
4. [ ] Optimize meta titles & descriptions

### Minggu 3-4:
1. [ ] Fix any indexing errors
2. [ ] Improve Core Web Vitals
3. [ ] Optimize pages dengan high impressions, low CTR

---

## 📞 VERIFIKASI CODE (ISI SESUDAH DAPAT)

```html
<!-- Google Search Console Verification -->
<!-- Place this meta tag in the <head> section of your homepage -->
<meta name="google-site-verification" content="VERIFICATION_CODE_DISINI" />
```

---

## ❓ TROUBLESHOOTING

### Error: "Verification failed"
```
1. Pastikan meta tag ada di <head> (bukan di <body>)
2. Pastikan kode verifikasi benar
3. Tunggu 1-2 menit setelah add tag
4. Clear cache browser
5. Coba lagi
```

### Error: "Sitemap not found"
```
1. Pastikan sitemap.xml accessible: https://payanganhospital.gianyarkab.go.id/sitemap.xml
2. Check robots.txt untuk确认 sitemap URL
3. Submit dengan URL lengkap
```

### Error: "Page not indexed"
```
1. Gunakan URL Inspection tool
2. Klik "Request indexing"
3. Pastikan page tidak di-disallow di robots.txt
4. Cek canonical tags
5. Pastikan page load dengan benar
```

---

## 📞 CONTACT & SUPPORT

Google Search Console Help:
- https://support.google.com/webmasters
- https://developers.google.com/search/docs

---

**Created:** 2026-07-19
**Next Steps:** Verifikasi ownership, Submit sitemap
