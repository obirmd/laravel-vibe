# Instruksi Pengerjaan Fitur

Gunakan dokumen ini sebagai panduan saat menambahkan atau mengubah fitur project.
Perbarui instruksi di sini bila keputusan atau kebutuhan project berubah.

## Aturan kerja

1. Baca `AGENTS.md`, `CLAUDE.md`, dan skill relevan di `.agents/skills/` sebelum mengubah kode.
2. Pahami implementasi, route, model, migration, dan test yang sudah ada. Ikuti pola project; hindari duplikasi dan perubahan di luar kebutuhan.
3. Gunakan Laravel dan API yang sesuai versi package terpasang. Gunakan Artisan untuk membuat file Laravel.
4. Validasi semua input di server. Lindungi route dan data sesuai kebutuhan otorisasi. Jangan menaruh credential atau rahasia di kode maupun dokumentasi.
5. Untuk perubahan perilaku, tulis test terlebih dahulu, pastikan gagal karena perilaku belum ada, implementasikan perubahan minimum, lalu jalankan test kembali.
6. Perubahan database harus dibuat lewat migration. Jangan menghapus atau mengubah data pengguna tanpa kebutuhan dan persetujuan yang jelas.
7. Jalankan test yang relevan; untuk perubahan PHP jalankan `vendor/bin/pint --dirty --format agent`. Untuk perubahan frontend, jalankan `npm run build`.
8. Periksa hasil akhir dan laporkan file/perilaku yang berubah, perintah verifikasi, hasil, serta hal yang masih perlu dilakukan.

## Alur pengerjaan fitur

1. Catat tujuan fitur, pengguna yang terdampak, dan kriteria selesai.
2. Periksa struktur project dan dokumentasi Laravel/package yang relevan.
3. Pecah pekerjaan ke perubahan terkecil yang memenuhi kriteria.
4. Implementasikan test dan kode mengikuti pola yang sudah ada.
5. Jalankan test, formatter, dan build yang sesuai dengan perubahan.
6. Tinjau diff untuk memastikan tidak ada perubahan tak terkait atau rahasia.
7. Perbarui dokumen ini bila fitur memperkenalkan aturan project yang berlaku untuk fitur berikutnya.

## Format instruksi fitur

Tambahkan bagian baru di bawah ini untuk instruksi khusus fitur:

- **Fitur:** nama fitur
- **Tujuan:** masalah yang diselesaikan
- **Kriteria selesai:** hasil yang dapat diuji
- **Aturan khusus:** validasi, izin, batasan data, atau integrasi penting
- **Verifikasi:** test atau perintah yang harus dijalankan

## Instruksi fitur

Belum ada instruksi khusus fitur.
