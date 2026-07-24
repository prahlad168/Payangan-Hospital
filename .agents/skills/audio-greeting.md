# рҹ“Ӣ Audio Greeting System

## рҹ‘Ө Overview

Sistem audio greeting yang otomatis memutar suara sapaan saat user mengakses repository. Dibuat khusus untuk **CEO i Made Purna Ananda (Pak Pur)**.

---

## рҹ‘Ҹ Cara Kerja

Setiap kali repository diakses, sistem audio greeting akan:
1. Mendeteksi user yang mengakses
2. Memutar file audio greeting yang sesuai
3. Menampilkan text greeting di AGENTS.md

---

## рҹ“§ Konfigurasi Audio

### File Audio yang Digunakan

| User | File Audio | Text |
|------|------------|------|
| Pak Pur (CEO) | `greeting-ceo.mp3` | "Selamat datang, Pak Pur!" |
| Admin | `greeting-admin.mp3` | "Halo Admin!" |
| Guest | `greeting-guest.mp3` | "Selamat datang!" |

### Lokasi File Audio

```
repository/
рӣ” audio/
рӣӮ   рӣ” greeting-ceo.mp3      # Audio greeting CEO
рӣӮ   рӣ” greeting-admin.mp3    # Audio greeting Admin
рӣӮ   рӣ” greeting-guest.mp3   # Audio greeting Guest
```

---

## рҹ“Ӯ Text Greeting untuk Pak Pur

### Versi Bahasa Indonesia (Formal)

```
Selamat datang, Bapak CEO i Made Purna Ananda.

Sistem RS Payangan Hospital siap digunakan.

Apakah ada yang bisa saya bantu hari ini?
```

### Versi Bahasa Indonesia (Santai)

```
Halo Pak Pur!

Saya Agent AI Anda, siap kerja bareng!

Ada yang perlu dibantu hari ini?
```

---

## рҹ“Ӣ HTML Audio Player

Tambahkan kode ini di README.md atau landing page repository:

```html
<!-- Audio Greeting System -->
<audio id="greetingAudio" autoplay>
  <source src="audio/greeting-ceo.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

<script>
  // Auto-play greeting on page load
  document.addEventListener('DOMContentLoaded', function() {
    var audio = document.getElementById('greetingAudio');
    audio.play().catch(function() {
      // Autoplay blocked, user needs to interact first
      console.log('Audio autoplay blocked - user interaction required');
    });
  });
</script>
```

---

## рҹ“§ GitHub Actions untuk Audio

### `.github/workflows/audio-greeting.yml`

```yaml
name: Audio Greeting Setup

on:
  push:
    branches:
      - main
  workflow_dispatch:

jobs:
  setup-audio:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout code
        uses: actions/checkout@v3

      - name: Create audio directory
        run: mkdir -p audio

      - name: Check audio files
        run: |
          if [ -f "audio/greeting-ceo.mp3" ]; then
            echo "CEO greeting audio found"
          else
            echo "Warning: CEO greeting audio not found"
          fi
```

---

## рҹ“® Setup di Repository Baru

### Step 1: Buat folder audio

```bash
mkdir -p audio
```

### Step 2: Buat atau upload file audio

Upload file MP3 dengan nama:
- `audio/greeting-ceo.mp3` - untuk Pak Pur
- `audio/greeting-admin.mp3` - untuk Admin
- `audio/greeting-guest.mp3` - untuk Guest

### Step 3: Update AGENTS.md

Tambahkan section greeting di awal file:

```markdown
# SELAMAT DATANG, PAK PUR!

---

**Halo Pak Pur!**

Saya Agent AI Anda, siap kerja bareng!

---

## рҹ“Ӣ Audio Greeting

 рҹ”Ҹ Klik untuk mendengar sapaan:

<audio controls>
  <source src="audio/greeting-ceo.mp3" type="audio/mpeg">
</audio>

---

## Quick Actions

...

```

### Step 4: Commit dan Push

```bash
git add .
git commit -m "feat: Add audio greeting system"
git push
```

---

## рҹ“Ӯ API Text-to-Speech (Optional)

### Google Cloud TTS Integration

```javascript
// Generate audio from text
async function generateGreeting(text, filename) {
  const https = require('https');
  
  const requestBody = {
    input: { text: text },
    voice: { 
      languageCode: 'id-ID',
      name: 'id-ID-Standard-A',
      ssmlGender: 'MALE'
    },
    audioConfig: {
      audioEncoding: 'MP3',
      speakingRate: 0.9,
      pitch: -2
    }
  };

  // Call Google Cloud TTS API
  // Save to audio/[filename].mp3
}
```

### Contoh Text untuk Pak Pur

```javascript
const ceoGreeting = `
Selamat datang, Bapak CEO i Made Purna Ananda.

Saya Agent AI Anda di repository Payangan Hospital.

Sistem siap digunakan. 

Apakah ada yang bisa saya bantu hari ini?
`;
```

---

## рҹ“Ҹ Trigger Phrases

Skill ini aktif ketika user mengatakan:

- "audio greeting"
- "suara sapaan"
- "pak pur greeting"
- "selamat datang audio"
- "tambah suara"
- "setup audio"
- "audio untuk repository baru"

---

## рҹ“§ TTS Providers

| Provider | Kualitas | Harga | Bahasa Indonesia |
|----------|----------|-------|------------------|
| Google Cloud TTS | tinggi | berbayar | ✅ |
| AWS Polly | tinggi | berbayar | ✅ |
| Azure TTS | tinggi | berbayar | ✅ |
| Coqui TTS | medium | gratis | ⚠️ terbatas |
| espeak-ng | rendah | gratis | ⚠️ |

---

## рҹ“Ӣ Checklist Setup

- [ ] Buat folder `audio/`
- [ ] Upload/generate file audio greeting
- [ ] Update AGENTS.md dengan audio player
- [ ] Test audio playback
- [ ] Commit dan push ke GitHub

---

## рҹ‘Ө Contoh Implementasi Lengkap

### Repository Structure

```
repository/
рӣ” audio/
рӣӮ   рӣ” greeting-ceo.mp3      # 5 detik audio greeting
рӣӮ   рӣ” greeting-admin.mp3
рӣӮ   рӣ” greeting-guest.mp3
рӣ” README.md                    # Dengan audio player
рӣ” .github/
    рӣ” workflows/
        рӣ” audio-greeting.yml
```

### README.md dengan Audio

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Repository - Greeting</title>
</head>
<body>
    <h1>SELAMAT DATANG!</h1>
    
    <div class="greeting-section">
        <h2>Halo Pak Pur!</h2>
        <p>Dengarkan sapaan dari Agent AI:</p>
        <audio controls autoplay>
            <source src="audio/greeting-ceo.mp3" type="audio/mpeg">
        </audio>
    </div>
    
    <script>
        // Play greeting when page loads
        document.addEventListener('load', function() {
            const audio = document.querySelector('audio');
            audio.play();
        });
    </script>
</body>
</html>
```

---

## рҹ“Ӯ Troubleshooting

### Audio tidak auto-play?

Browser modern memblokir autoplay audio. Solusi:

```javascript
// Tunggu interaksi user dulu
document.addEventListener('click', function() {
    const audio = document.getElementById('greetingAudio');
    audio.play();
}, { once: true });
```

### File audio tidak ditemukan?

Pastikan path benar:
- `audio/greeting-ceo.mp3` (relative)
- `/audio/greeting-ceo.mp3` (absolute dari root)

### Format audio tidak didukung?

Gunakan format MP3 untuk kompatibilitas terbaik.

---

## рҹ“Ӯ Catatan Penting

1. **File audio harus di-commit ke repository** atau hosted di CDN
2. **Ukuran file ideal**: < 100KB untuk greeting singkat
3. **Durasi ideal**: 3-10 detik
4. **Format**: MP3 (paling kompatibel)

---

**Created:** 2026-07-05  
**Version:** 1.0.0  
**Author:** GAURANGA AI System  
**Owner:** i Made Purna Ananda (Pak Pur)
