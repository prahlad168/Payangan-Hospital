# Payangan Hospital - Website Repository

## Struktur Proyek
- Website rumah sakit static (HTML/CSS/JS)
- Semua file `.html` di root directory
- Gambar dokter di `img/dokter/`
- Foto dokter: 22 foto spesialis (nama file sesuai nama dokter)
- Deployed ke GitHub Pages via `github.com/prahlad168/Payangan-Hospital`

## Link Standards (WAJIB DIPATUH!)

### Logo Link
**Selalu gunakan `href="index.html"` untuk link logo (ke branda/beranda)**

| ❌ SALAH | ✅ BENAR |
|----------|----------|
| `href="#"` | `href="index.html"` |
| `href="about.html"` | `href="index.html"` |

### Link Halaman Dokter
**Selalu gunakan `href="dokter.html"` untuk navigasi ke halaman daftar dokter**

| ❌ SALAH | ✅ BENAR |
|----------|----------|
| `href="#dokter"` | `href="dokter.html"` |
| `href="index.html#dokter"` | `href="dokter.html"` |

### Link Halaman Kontak
**Selalu gunakan `href="kontak.html"` untuk navigasi ke halaman kontak**

| ❌ SALAH | ✅ BENAR |
|----------|----------|
| `href="#kontak"` | `href="kontak.html"` |
| `href="index.html#kontak"` | `href="kontak.html"` |

### Verifikasi Link
Sebelum commit, selalu jalankan:
```bash
# Cek link dokter
grep -rn 'href.*#dokter' *.html

# Cek link kontak
grep -rn 'href.*#kontak' *.html

# Cek link logo
grep -rn 'href="#" class="logo"' *.html
```
Jika ada hasil, berarti ada link yang salah.

## Checklist Sebelum Commit HTML
1. ✅ Semua link logo mengarah ke `index.html`
2. ✅ Semua link "Dokter" mengarah ke `dokter.html`
3. ✅ Semua link "Kontak" mengarah ke `kontak.html`
4. ✅ Semua foto dokter ada di folder `img/dokter/`
5. ✅ Nama file foto sesuai dengan referensi di HTML
6. ✅ Tidak ada link rusak (`href="#"` pada logo/nav)

## Git Workflow
```bash
# 1. Stage perubahan
git add -A

# 2. Commit dengan pesan deskriptif
git commit -m "Deskripsi perubahan"

# 3. Push untuk deploy
git push origin main
```

## Command Berguna
```bash
# Cek semua link dokter
grep -rn 'href.*dokter' *.html

# Cek link yang salah
grep -rn 'href.*#dokter' *.html

# Hitung jumlah kartu dokter
grep -c '<div class="doctor-card"' dokter.html

# Cek foto dokter
ls img/dokter/ | wc -l
```

## Catatan Pengembangan
- Halaman `dokter.html` berisi 22 dokter spesialis dengan foto
- Filter poli: umum, saraf, anak, kandungan, tht, gigi, dalam, bedah, ortho, jantung, radiologi, anestesi, laboratorium
- Setiap dokter memiliki: nama, spesialisasi, poli, jadwal praktik, pendidikan, dan foto
