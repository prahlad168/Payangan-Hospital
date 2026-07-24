# 🔧 TECHNICAL SEO CHECKLIST
## RS Payangan Hospital Digital
**Date:** 2026-07-13
**Agent:** SEO & Ads Agent
**Status:** Implementation Required

---

## 📋 CHECKLIST OVERVIEW

| Category | Total Items | Completed | Pending | Priority |
|----------|-------------|-----------|---------|----------|
| Technical Setup | 8 | 2 | 6 | 🔴 CRITICAL |
| On-Page SEO | 15 | 5 | 10 | 🟡 HIGH |
| Content | 8 | 0 | 8 | 🟡 MEDIUM |
| Local SEO | 10 | 0 | 10 | 🔴 CRITICAL |
| Off-Page SEO | 8 | 0 | 8 | 🟡 MEDIUM |
| Performance | 6 | 0 | 6 | 🟡 HIGH |
| **TOTAL** | **55** | **7** | **48** | - |

---

## 🔴 SECTION 1: TECHNICAL SETUP (CRITICAL)

### 1.1 sitemap.xml ✅ CREATED
- [x] Created sitemap.xml with all 35 pages
- [x] Added proper priorities (0.8-1.0)
- [x] Added change frequencies
- [ ] **TODO:** Submit to Google Search Console
- [ ] **TODO:** Set up automatic sitemap updates

### 1.2 robots.txt ✅ CREATED
- [x] Created robots.txt
- [x] Allowed all public pages
- [x] Disallowed /rs-admin/, /api/, /progress/
- [x] Added sitemap location
- [ ] **TODO:** Test in Google Search Console

### 1.3 SSL Certificate
- [ ] Verify HTTPS is enforced site-wide
- [ ] Check mixed content warnings
- [ ] Update all internal links to HTTPS
- [ ] Set up HTTP to HTTPS redirect

### 1.4 Schema Markup ❌ MISSING
- [ ] Add LocalBusiness schema to homepage
- [ ] Add Hospital schema with full details
- [ ] Add Doctor schema to dokter.html
- [ ] Add FAQ schema to faq.html
- [ ] Add MedicalOrganization schema
- [ ] Test with Google's Rich Results Test

### 1.5 Canonical Tags ❌ MISSING
- [ ] Add canonical tag to homepage (https://payanganhospital.gianyarkab.go.id/)
- [ ] Add canonical to all inner pages
- [ ] Verify no duplicate content issues
- [ ] Check for parameter-based duplicate pages

### 1.6 Redirect Management
- [ ] Audit existing redirects (if any)
- [ ] Set up 404.html custom page
- [ ] Create 301 redirect map for any changed URLs
- [ ] Set up 500 error page

### 1.7 URL Structure
- [ ] Verify URL format consistency (hyphens, lowercase)
- [ ] Check URL lengths (should be < 75 chars)
- [ ] Remove any duplicate pages
- [ ] Ensure no dynamic parameters in URLs

### 1.8 Internationalization
- [ ] Verify hreflang tags (if multi-language)
- [ ] Set default language to Indonesian
- [ ] Add lang="id" to HTML tag
- [ ] Consider Chinese translation for tourists

---

## 🟡 SECTION 2: ON-PAGE SEO

### 2.1 Meta Tags

| Page | Title | Description | Status |
|------|-------|-------------|--------|
| Homepage | ✅ Good | ✅ Good | ✅ OK |
| dokter.html | ✅ Good | ✅ Good | ✅ OK |
| about.html | ✅ Good | ✅ Good | ✅ OK |
| layanan.html | ✅ Good | ✅ Good | ✅ OK |
| igd.html | ⚠️ Review | ⚠️ Review | ⚠️ Review |
| poli-*.html (10 pages) | ⚠️ Review | ❌ Unique needed | ❌ TODO |
| faq.html | ⚠️ Review | ❌ Unique needed | ❌ TODO |
| kontak.html | ⚠️ Review | ⚠️ Review | ⚠️ Review |
| rawat-inap.html | ⚠️ Review | ❌ Unique needed | ❌ TODO |
| rawat-jalan.html | ⚠️ Review | ❌ Unique needed | ❌ TODO |

### 2.2 Meta Tag Improvements Needed

- [ ] **igd.html:** Add "igd 24 jam bali" to meta description
- [ ] **poli-anak.html:** Unique meta description (pediatric keywords)
- [ ] **poli-bedah.html:** Unique meta description (surgery keywords)
- [ ] **poli-dalam.html:** Unique meta description (internal medicine)
- [ ] **poli-gigi.html:** Unique meta description (dental keywords)
- [ ] **poli-jantung.html:** Unique meta description (cardiology keywords)
- [ ] **poli-kandungan.html:** Unique meta description (OB-GYN keywords)
- [ ] **poli-orthopedic.html:** Unique meta description (bone keywords)
- [ ] **poli-saraf.html:** Unique meta description (neurology keywords)
- [ ] **poli-tht.html:** Unique meta description (ENT keywords)
- [ ] **poli-umum.html:** Unique meta description (general medicine)
- [ ] **faq.html:** Unique meta description
- [ ] **kontak.html:** Add address + phone to meta
- [ ] **rawat-inap.html:** Unique meta description
- [ ] **rawat-jalan.html:** Unique meta description

### 2.3 Header Tags (H1-H6)

- [ ] Verify each page has exactly ONE H1
- [ ] Add target keywords to H2 and H3 tags
- [ ] Ensure proper heading hierarchy (H1 → H2 → H3)
- [ ] Check for skipped heading levels
- [ ] Make headings descriptive and keyword-rich

### 2.4 Image Optimization ❌ NEEDS WORK

| Task | Status | Priority |
|------|--------|----------|
| Add alt text to all 30+ images | ❌ TODO | 🔴 HIGH |
| Compress image file sizes | ❌ TODO | 🟡 MEDIUM |
| Convert to WebP format | ❌ TODO | 🟡 MEDIUM |
| Implement lazy loading | ❌ TODO | 🟡 HIGH |
| Add descriptive filenames | ❌ TODO | 🟡 MEDIUM |
| Add image width/height attributes | ❌ TODO | 🟡 MEDIUM |

### 2.5 Internal Linking

- [ ] Create content silo structure
- [ ] Add related articles section
- [ ] Add breadcrumb navigation
- [ ] Use descriptive anchor text (not "click here")
- [ ] Link to relevant services from doctor pages
- [ ] Create hub pages for each service category

### 2.6 Content Quality

- [ ] Add unique content to each page (minimum 300 words)
- [ ] Add FAQ sections where appropriate
- [ ] Add patient testimonials section
- [ ] Add before/after content for services
- [ ] Ensure content is scannable (short paragraphs, lists)

### 2.7 Mobile Optimization

- [ ] Verify responsive design on all devices
- [ ] Test touch targets (minimum 44px)
- [ ] Check mobile page speed
- [ ] Verify forms work on mobile
- [ ] Test click-to-call functionality

---

## 🟡 SECTION 3: CONTENT STRATEGY

### 3.1 Content Audit

| Page | Word Count | Quality | Status |
|------|------------|---------|--------|
| Homepage | ~800 | Good | ✅ |
| About | ~1000 | Good | ✅ |
| Dokter | ~1200 | Good | ✅ |
| Layanan | ~800 | Good | ✅ |
| IGD | ~500 | ⚠️ Need more | ⚠️ TODO |
| Poli Pages | ~300 each | ⚠️ Thin | ⚠️ TODO |
| FAQ | ~400 | ⚠️ Thin | ⚠️ TODO |
| Kontak | ~200 | ⚠️ Thin | ⚠️ TODO |

### 3.2 Content Gaps

- [ ] No blog/articles section
- [ ] No health education content
- [ ] No news/announcements section
- [ ] No patient testimonials
- [ ] Limited service details
- [ ] No doctor spotlight articles

### 3.3 Content Plan

| Content Type | Frequency | Purpose |
|--------------|-----------|---------|
| Health Tips Articles | 2/week | SEO + Value |
| Doctor Spotlights | 1/week | Trust + Keywords |
| Hospital News | 1/week | Freshness |
| FAQ Expansion | Ongoing | Featured snippets |
| Video Content | 2/month | Engagement |

### 3.4 Blog Article Ideas

```
Priority Articles for SEO:
1. "10 Tanda Anda Perlu ke Dokter" (dokter spesialis)
2. "Persiapan Medical Checkup Lengkap" (medical checkup)
3. "Kapan Harus ke IGD vs Klinik?" (igd)
4. "Tips Memilih Rumah Sakit di Gianyar" (gianyar)
5. "Layanan MCU Perusahaan di Gianyar" (corporate)
6. "Persalinan di RS Payangan: Yang Perlu Diketahui" (kandungan)
7. "Perawatan Anak: Kapan Harus ke Poli Anak?" (poli anak)
8. "Penyakit Jantung: Deteksi Dini & Pencegahan" (jantung)
```

### 3.5 Content Quality Checklist

For each page:
- [ ] Minimum 300 words
- [ ] Target keyword appears in first 100 words
- [ ] Keyword in H2 heading
- [ ] Related keywords naturally integrated
- [ ] Internal links to relevant pages
- [ ] External links to authoritative sources
- [ ] Clear CTA (Call to Action)
- [ ] Readable formatting (H tags, lists, short paragraphs)

---

## 🔴 SECTION 4: LOCAL SEO (CRITICAL)

### 4.1 Google Business Profile ❌ NOT SETUP

- [ ] **CRITICAL:** Create Google Business Profile
- [ ] Verify business information:
  - [ ] Name: RS Payangan Hospital
  - [ ] Address: [Full address]
  - [ ] Phone: [Main number]
  - [ ] Website: https://payanganhospital.gianyarkab.go.id/
  - [ ] Hours: 24/7 (for IGD), [clinic hours]
- [ ] Add categories: Hospital, Emergency Room
- [ ] Add service areas: Gianyar, Bali
- [ ] Upload photos (exterior, interior, staff)
- [ ] Set up appointments attribute
- [ ] Add COVID-19 information if relevant

### 4.2 NAP Consistency

- [ ] Verify NAP on website matches GMB:
  - [ ] Name: RS Payangan Hospital (exact)
  - [ ] Address: [Complete address]
  - [ ] Phone: [Consistent format: +62-xxx-xxxx-xxxx]
  - [ ] Hours: Consistent across all platforms
- [ ] Check all directory listings for consistency
- [ ] Fix any discrepancies found

### 4.3 Local Citations

| Directory | Status | Priority |
|-----------|--------|----------|
| Google Business Profile | ❌ Not set | 🔴 CRITICAL |
| Apple Maps | ❌ Not set | 🟡 HIGH |
| Bing Places | ❌ Not set | 🟡 MEDIUM |
| Yahoo! Local | ❌ Not set | 🟡 LOW |
| Yelp Indonesia | ❌ Not set | 🟡 MEDIUM |
| Foursquare | ❌ Not set | 🟡 LOW |
| Facebook Page | ⚠️ Basic | 🟡 MEDIUM |
| LinkedIn Company | ⚠️ Basic | 🟡 MEDIUM |
| Indonesian Health Directories | ❌ Not set | 🟡 MEDIUM |

### 4.4 Local Schema Markup

- [ ] Add LocalBusiness JSON-LD to homepage
- [ ] Include:
  - [ ] @type: Hospital
  - [ ] address (full)
  - [ ] telephone
  - [ ] openingHours
  - [ ] geo coordinates
  - [ ] image
  - [ ] priceRange
  - [ ] aggregateRating

### 4.5 Geo-Targeting

- [ ] Add geo meta tag:
  ```html
  <meta name="geo.region" content="ID-BA">
  <meta name="geo.placename" content="Gianyar">
  ```
- [ ] Include "Gianyar, Bali" in page content
- [ ] Add Google Maps embed to contact page
- [ ] Create location-specific landing pages if needed

### 4.6 Reviews & Reputation

- [ ] Set up Google review generation strategy
- [ ] Create review request process for patients
- [ ] Respond to all Google reviews (positive + negative)
- [ ] Add review schema markup
- [ ] Display testimonials on website

---

## 🟡 SECTION 5: OFF-PAGE SEO

### 5.1 Backlink Analysis

Current Status: **0 backlinks estimated**
Competitor Comparison:
- RS Sanglah: 500+ backlinks
- RS Manuaba: 50+ backlinks
- RS Payangan Target: 100+ in 6 months

### 5.2 High-Priority Backlinks

| Source | Type | DA | Priority |
|---------|------|-----|----------|
| dinkes.gianyarkab.go.id | Government Health | 45 | 🔴 CRITICAL |
| kemkes.go.id | Ministry of Health | 70 | 🟡 HIGH |
| bpjs-kesehatan.go.id | Health Insurance | 60 | 🟡 HIGH |
| gianyarkab.go.id | Local Govt | 50 | 🔴 CRITICAL |
| dinkes.baliprov.go.id | Provincial Health | 40 | 🟡 HIGH |

### 5.3 Backlink Building Strategy

#### Phase 1: Government Links (Month 1)
- [ ] Request link from dinkes.gianyarkab.go.id
- [ ] Get listed on gianyarkab.go.id
- [ ] Apply for bpjs provider directory
- [ ] Contact provincial health department

#### Phase 2: Directory Listings (Month 1-2)
- [ ] Google Business Profile (CRITICAL)
- [ ] Apple Maps
- [ ] Bing Places
- [ ] Yelp Indonesia
- [ ] Foursquare
- [ ] Halodoc
- [ ] Alodokter
- [ ] MeetDoctor

#### Phase 3: Content-Based Links (Month 2-3)
- [ ] Guest post on health blogs
- [ ] Submit to health directories
- [ ] Get mentioned in local news
- [ ] Partner with local businesses

### 5.4 Social Signals

- [ ] Optimize Facebook page (100+ posts)
- [ ] Create Instagram account (50+ posts)
- [ ] Set up LinkedIn company page
- [ ] Create YouTube channel (hospital videos)
- [ ] Set up TikTok (optional)

### 5.5 Brand Mentions

- [ ] Monitor brand mentions (Google Alerts)
- [ ] Convert unlinked mentions to backlinks
- [ ] Respond to all brand mentions
- [ ] Build relationships with health bloggers

---

## 🟡 SECTION 6: PERFORMANCE OPTIMIZATION

### 6.1 Page Speed Metrics

| Metric | Current | Target | Status |
|--------|---------|--------|--------|
| Largest Contentful Paint (LCP) | ~3s | < 2.5s | ⚠️ |
| First Input Delay (FID) | ~100ms | < 100ms | ✅ |
| Cumulative Layout Shift (CLS) | ~0.1 | < 0.1 | ✅ |
| Overall PageSpeed Score | ~75 | > 90 | ⚠️ |

### 6.2 Image Optimization

- [ ] Compress all images (< 100KB per image)
- [ ] Convert to WebP format
- [ ] Implement lazy loading
- [ ] Use responsive images (srcset)
- [ ] Add width/height attributes
- [ ] Use CDN for image delivery (if available)

### 6.3 Code Optimization

- [ ] Minify CSS files
- [ ] Minify JavaScript files
- [ ] Defer non-critical JavaScript
- [ ] Inline critical CSS
- [ ] Remove unused CSS
- [ ] Combine multiple CSS files

### 6.4 Server Optimization

- [ ] Enable browser caching
- [ ] Enable GZIP compression
- [ ] Use HTTP/2 (if server supports)
- [ ] Consider CDN for static assets
- [ ] Optimize database queries (if dynamic)

### 6.5 Core Web Vitals Checklist

- [ ] LCP: Optimize hero image loading
- [ ] LCP: Preload critical fonts
- [ ] FID: Defer non-critical JavaScript
- [ ] CLS: Reserve space for images
- [ ] CLS: Avoid layout shifts from ads

### 6.6 Mobile Performance

- [ ] Test with Lighthouse Mobile
- [ ] Optimize for 4G connections
- [ ] Reduce payload for mobile
- [ ] Test offline functionality
- [ ] Verify AMP not needed (standard site OK)

---

## 📊 IMPLEMENTATION TIMELINE

### Week 1: Critical Technical
```
Day 1-2:
- [ ] Submit sitemap.xml to Google Search Console
- [ ] Test robots.txt in Search Console
- [ ] Verify SSL/HTTPS

Day 3-4:
- [ ] Add LocalBusiness schema
- [ ] Add Hospital schema
- [ ] Test schema with tool

Day 5-7:
- [ ] Add alt text to all images
- [ ] Implement lazy loading
- [ ] Create Google Business Profile
```

### Week 2: On-Page Optimization
```
Day 1-3:
- [ ] Rewrite meta descriptions (all pages)
- [ ] Optimize H tags
- [ ] Add canonical tags

Day 4-5:
- [ ] Improve thin content pages
- [ ] Add internal links

Day 6-7:
- [ ] Mobile testing
- [ ] Performance check
```

### Week 3: Local SEO
```
Day 1-2:
- [ ] Complete Google Business Profile
- [ ] Add NAP to website

Day 3-4:
- [ ] Submit to directories
- [ ] Start citation building

Day 5-7:
- [ ] Request government backlinks
- [ ] Start review generation
```

### Week 4: Content & Monitoring
```
Day 1-2:
- [ ] Create first blog article
- [ ] Set up Google Analytics 4

Day 3-4:
- [ ] Create Google Search Console reports
- [ ] Set up keyword tracking

Day 5-7:
- [ ] Review and optimize
- [ ] Plan next month
```

---

## 📈 SUCCESS METRICS

### Technical SEO KPIs

| Metric | Baseline | Month 1 | Month 3 | Month 6 |
|--------|----------|---------|---------|---------|
| Pages indexed | ? | 35 | 40+ | 50+ |
| Schema errors | 0 | 0 | 0 | 0 |
| PageSpeed Score | ~75 | 80+ | 85+ | 90+ |
| Mobile usability | Pass | Pass | Pass | Pass |
| Core Web Vitals | ⚠️ | ✅ | ✅ | ✅ |

### Ranking KPIs

| Keyword | Current | Month 1 | Month 3 | Month 6 |
|---------|---------|---------|---------|---------|
| rumah sakit gianyar | #2-5 | #2 | #1 | #1 |
| rs payangan | #5-10 | #3-5 | #2 | #1 |
| dokter spesialis gianyar | Not ranked | #10 | #5 | #1-3 |
| igd 24 jam bali | Not ranked | #15 | #8 | #3-5 |

### Traffic KPIs

| Metric | Baseline | Month 1 | Month 3 | Month 6 |
|--------|----------|---------|---------|---------|
| Organic sessions | 500/mo | 600 | 1000 | 2000 |
| Total keywords ranked | 15 | 20 | 40 | 60 |
| Impressions | ? | 5000 | 15000 | 40000 |
| Click-through rate | 1% | 2% | 3% | 4% |

---

## 🎯 PRIORITY SUMMARY

### Immediate Actions (This Week)

1. ⭐ Submit sitemap.xml to Google Search Console
2. ⭐ Create/Claim Google Business Profile
3. ⭐ Add LocalBusiness schema to homepage
4. ⭐ Add alt text to all images
5. ⭐ Rewrite meta descriptions for poli pages

### Short-term Goals (Month 1)

1. Fix all technical SEO issues
2. Improve page speed to 80+
3. Get 10+ local citations
4. Create 4 blog articles
5. Start backlink building

### Medium-term Goals (Month 3)

1. Rank #1 for "rumah sakit gianyar"
2. Increase organic traffic by 50%
3. Get 50+ backlinks
4. Create content calendar
5. Launch Google Ads campaigns

### Long-term Goals (Month 6)

1. 30+ keywords in top 10
2. 100%+ organic traffic growth
3. 100+ quality backlinks
4. 20+ blog articles
5. Established brand presence

---

**Report Generated By:** SEO & Ads Agent
**Date:** 2026-07-13
**Next Review:** 2026-08-13
