# Issue 01 — Implementasi Login dan Register

## Tujuan

Menyediakan autentikasi pengguna agar pengguna dapat membuat akun, masuk ke aplikasi, keluar dari sesi, dan mengakses halaman yang memerlukan autentikasi.

## Ruang lingkup

- Halaman dan route register.
- Halaman dan route login.
- Validasi server-side untuk nama, email, password, dan konfirmasi password.
- Penyimpanan password menggunakan hashing bawaan Laravel.
- Regenerasi sesi setelah login untuk mencegah session fixation.
- Logout yang mengakhiri sesi dan membatalkan token CSRF.
- Redirect pengguna yang sudah login dari halaman login/register.
- Perlindungan route yang memerlukan autentikasi menggunakan middleware `auth`.
- Pesan error validasi dan kredensial tidak valid.

## Kriteria selesai

- Pengguna dapat register memakai nama, email unik, password, dan konfirmasi password yang valid.
- Password tidak disimpan dalam bentuk plain text.
- Register sukses membuat user dan mengautentikasi pengguna.
- Pengguna dapat login memakai email dan password yang terdaftar.
- Login dengan kredensial salah gagal tanpa mengungkap apakah email terdaftar.
- Pengguna dapat logout dan tidak lagi dapat membuka route yang dilindungi.
- Pengguna tamu dialihkan ke halaman login saat membuka route dengan middleware `auth`.
- Pengguna yang sudah login tidak dapat mengakses halaman login atau register.
- Feature test mencakup register, login, logout, validasi, dan akses route terlindungi.

## Batasan

- Gunakan fitur autentikasi dan session bawaan Laravel.
- Jangan menambahkan package baru bila implementasi bawaan Laravel sudah mencukupi.
- Ikuti aturan pada `doc/doc.md`, `AGENTS.md`, dan skill project yang relevan.

## Verifikasi

```sh
php artisan test --compact
vendor/bin/pint --dirty --format agent
npm run build
```
