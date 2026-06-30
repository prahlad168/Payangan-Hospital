# Payangan Hospital - Website Repository

## Struktur Proyek
- Website rumah sakit static (HTML/CSS/JS)
- Semua file `.html` di root directory
- Gambar dokter di `img/dokter/`
- Foto dokter: 22 foto spesialis (nama file sesuai nama dokter)
- Deployed ke GitHub Pages via `github.com/prahlad168/Payangan-Hospital`

## Link Standards (WAJIB DIPATUH!)

### Link Halaman Dokter
**Selalu gunakan `href="dokter.html"` untuk navigasi ke halaman daftar dokter**

| ❌ SALAH | ✅ BENAR |
|----------|----------|
| `href="#dokter"` | `href="dokter.html"` |
| `href="index.html#dokter"` | `href="dokter.html"` |

### Verifikasi Link
Sebelum commit, selalu jalankan:
```bash
grep -rn 'href.*#dokter' *.html
```
Jika ada hasil, berarti ada link yang salah.

## Checklist Sebelum Commit HTML
1. ✅ Semua link "Dokter" mengarah ke `dokter.html`
2. ✅ Semua foto dokter ada di folder `img/dokter/`
3. ✅ Nama file foto sesuai dengan referensi di HTML
4. ✅ Tidak ada link rusak

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
