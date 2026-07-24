# 📊 GOOGLE ANALYTICS 4 (GA4) SETUP GUIDE
## RS Payangan Hospital

**Tanggal:** 2026-07-19
**Status:** Ready to Setup

---

## 🎯 TUJUAN

Track semua aktivitas website:
- Jumlah pengunjung (users, sessions)
- Halaman yang paling populer
- Sumber traffic (Google, Facebook, direct, dll)
- Perilaku pengguna di website
- Konversi (antrean online, form kontak)
- Device/browser yang digunakan

---

## 📋 STEP 1: BUAT GOOGLE ANALYTICS ACCOUNT

### 1.1 Buka Google Analytics
```
👉 https://analytics.google.com/
```
Login dengan akun Google yang sama dengan Search Console.

### 1.2 Mulai Setup
1. Klik **"Sign up"** (kalau belum punya)
2. Atau klik **"Admin"** → **"Create Account"**

### 1.3 Isi Informasi Account
```
Account Name: Payangan Hospital
Account ID: Biarkan default

Configuration:
- Company Name: RS Payangan Hospital
- Company Size: 51-1000 employees
- Industry Category: Healthcare
- Timezone: Indonesia (Western Indonesia Time - WIB)
```

---

## 📋 STEP 2: BUAT PROPERTY

### 2.1 Property Settings
```
Property Name: RS Payangan Hospital Website
Property ID: Biarkan default (akan jadi GA4 Measurement ID)

Reporting Timezone: Asia/Jakarta (GMT+7)
Currency: Indonesian Rupiah (IDR)
```

### 2.2 Advanced Options
```
Enable all features:
☑ Create a Universal Analytics property (NO - GA4 only)
☑ Enable data sharing settings (optional)
```

---

## 📋 STEP 3: DAPATKAN MEASUREMENT ID

### 3.1 Setup Wizard
1. Setelah buat property, akan muncul **"Setup Assistant"**
2. Klik **"Web"** (untuk website)
3. Masukkan website URL:
   ```
   https://payanganhospital.gianyarkab.go.id/
   ```
4. Stream name: `RS Payangan Hospital Website`

### 3.2 Copy Measurement ID
Akan muncul kode seperti:
```
G-XXXXXXXXXX
```
**SIMPAN KODE INI** - akan dipakai di website.

---

## 📋 STEP 4: TAMBAHKAN KE WEBSITE

### 4.1 Measurement ID akan ditambahkan

Saya akan tambahkan kode tracking ke `index.html`:

```html
<!-- Google Analytics 4 -->
<!-- Paste sebelum </head> -->
<!-- 
Ganti G-XXXXXXXXXX dengan Measurement ID dari Google Analytics
-->
<!-- 
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX');
</script>
-->
```

---

## 📋 STEP 5: VERIFIKASI SETUP

### 5.1 Install GA4 Debugger (Chrome Extension)
1. Buka: https://chrome.google.com/webstore/detail/google-analytics-debugger
2. Install extension
3. Aktifkan dengan klik icon di Chrome

### 5.2 Test Tracking
1. Buka website RS Payangan
2. Refresh beberapa halaman
3. Buka GA4 Dashboard → Realtime
4. Harus muncul 1 user aktif

---

## 📊 DASHBOARD YANG AKAN DITARGET

| Metric | Target | Description |
|--------|--------|-------------|
| Users | 500/mo | Unique visitors |
| Sessions | 1000/mo | Total visits |
| Bounce Rate | <60% | Visitors leaving quickly |
| Avg. Session Duration | >2 min | Time on site |
| Pageviews | 3000/mo | Total pages viewed |

---

## 🎯 YANG AKAN DITRAKING

### Basic Metrics
- [ ] Total Users
- [ ] New Users
- [ ] Sessions
- [ ] Pageviews
- [ ] Bounce Rate
- [ ] Avg. Session Duration

### User Behavior
- [ ] Most visited pages
- [ ] Traffic sources (Google, Facebook, direct)
- [ ] Device categories (mobile, desktop)
- [ ] Geographic data (Indonesia, Bali, Gianyar)
- [ ] Browser/OS used

### Conversions (Events)
- [ ] Form submissions (kontak)
- [ ] Button clicks (antrean, dokter)
- [ ] PDF downloads
- [ ] External link clicks

---

## 🔧 EVENT TRACKING TAMBAHAN

### Events yang perlu di-track:

```javascript
// Antrean button click
gtag('event', 'antrean_click', {
  'event_category': 'Button',
  'event_label': 'Antrean Online'
});

// Contact form submission
gtag('event', 'form_submit', {
  'event_category': 'Form',
  'event_label': 'Contact Form'
});

// Doctor profile view
gtag('event', 'doctor_view', {
  'event_category': 'Engagement',
  'event_label': doctor_name
});

// Phone call click
gtag('event', 'phone_click', {
  'event_category': 'Conversion',
  'event_label': 'Telepon RS'
});

// WhatsApp click
gtag('event', 'whatsapp_click', {
  'event_category': 'Conversion',
  'event_label': 'WhatsApp'
});
```

---

## 📱 MOBILE APP TRACKING (FUTURE)

Kalau nanti ada app:
```
Measurement ID Mobile: G-XXXXXXXXXX
```

---

## 📅 SCHEDULE REVIEW

| Schedule | Activity |
|----------|----------|
| Daily | Cek Realtime traffic |
| Weekly | Review top pages, sources |
| Monthly | Full performance report |

---

## 💰 FREE TIER LIMIT

Google Analytics 4 Free:
- ✅ Unlimited websites
- ✅ 500 events/day (free)
- ✅ 10 million events/month (free)
- ✅ User-centric measurement
- ✅ Predictive metrics
- ❌ No sampling for standard reports

---

## 📞 SUPPORT

Google Analytics Help:
- https://support.google.com/analytics
- https://analytics.google.com/analytics/academy/

---

## ✅ CHECKLIST

- [ ] Buat Google Analytics account
- [ ] Buat GA4 property
- [ ] Dapat Measurement ID (G-XXXXXXXXXX)
- [ ] Kirim Measurement ID ke Agent
- [ ] Tambahkan kode ke website
- [ ] Push ke hosting
- [ ] Verifikasi tracking (Realtime report)
- [ ] Setup conversions/events
- [ ] Share access dengan team

---

## 📧 DATA SHARING SETTINGS

Di Account Settings:
```
☑ Browser features
☑ Benchmarking
☑ Technical support
☑ Account specialists
```

---

**Created:** 2026-07-19
**Next Step:** Kirim Measurement ID ke Agent untuk ditambahkan ke website
