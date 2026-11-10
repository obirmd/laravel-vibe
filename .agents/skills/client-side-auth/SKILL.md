---
name: client-side-auth
version: 1.0.0
author: berU
license: MIT
description: Use when simple auth, no backend. Web Crypto + localStorage.
metadata:
  hermes:
    tags: [auth, frontend, web-crypto, vite, vanilla-js]
    related_skills: []
---

# Client-side auth (no backend)

Untuk Vite/vanilla-JS project tanpa backend: auth pake Web Crypto API (SHA-256 + per-user salt) + localStorage. Register/login/logout/session beneran jalan, password di-hash, gak plain-text.

## When to Use
- Demo, prototype, internal tool, vibe-coding.
- Halaman login/register sederhana tanpa server.
- BUKAN untuk data sensitif / production sungguhan (lihat Ceiling).

## Ceiling (penting)
Client-side auth = store di localStorage. Password di-hash bener, tapi:
- Hash bisa dibaca siapa pun akses browser. Brute-force offline possible.
- Session token di localStorage = bisa dicuri via XSS.
- Gak ada rate-limit, gak ada server-side validation.
- Gak boleh dipakai data sensitif / payment / PII sungguhan.

Upgrade path saat production: ganti `getUsers/saveUsers` + `login` jadi `fetch()` ke API endpoint `/api/register` `/api/login`, token di httpOnly cookie (bukan localStorage), hapus `SESSION_KEY` client-side. Letak upgrade udah ditandai `ponytail:` comment di auth.js.

## Komponen

### src/auth.js (drop-in module)
Inti: `hash(password, salt)` pake `crypto.subtle.digest('SHA-256', ...)`. `genSalt()` pake `crypto.getRandomValues(new Uint8Array(16))` → hex. Session token `crypto.randomUUID()`.

Penyimpanan:
- Users: `localStorage['vc_users']` = `[{username, salt, hash, createdAt}]`
- Session: `localStorage['vc_session']` = `{username, token, at}`

Exports: `register(username,password)`, `login(username,password)`, `logout()`, `getSession()`, `getUsers()`. Export `getUsers()` untuk render daftar akun terdaftar (mis. tabel di dashboard) — data real dari store yang sama, jangan duplikat store lain.

Validasi input (trust boundary): username min 3, password min 6. Error login di-samarin jadi satu pesan ("Username atau password salah") biar gak bocor user ada/tidak.

### src/main.js (SPA router + guard)
Hash routing `#login` / `#register` / `#dashboard`. `resolveRoute()` enforce:
- session ada + route login/register → redirect dashboard
- session null + route dashboard → redirect login (guard)
Views = template strings. `bind(route)` attach form submit listener. `escapeHtml()` untuk render username (XSS).

### index.html + style.css
Shell `<div id="app">` + `<script type=module src=/src/main.js>`. Theme/styling swappable — card, split-screen, atau dashboard layout semua jalan; logic auth independen dari styling.

## Pitfall yang udah ketemu
- `crypto.subtle` hanya jalan di secure context (https atau localhost/127.0.0.1). Di `file://` gak jalan.
- `crypto.randomUUID()` butuh secure context juga.
- Test browser: `requestSubmit()` pada form trigger submit event listener (bukan cuma button click). Works.
- `fill_input('#username')` ambigu kalau beberapa view punya input sama — cek `h1`/view dulu sebelum fill, atau pakai selector spesifik per form.
- Hash routing: `location.hash = '#x'` trigger `hashchange` event async — kasih sleep/wait setelah set sebelum baca state.

## Layout / UI Pattern
Styling independen dari logic auth — bisa swap tema tanpa sentuh `auth.js`. Pattern yang terbuki jalan:

### Split-panel (brand kiri + form kanan)
Layout 2 kolom (`grid-template-columns: 1fr 1fr`) yang sering dipakai portal login:
- **Panel kiri (brand):** Logo institusi, ilustrasi/SVG, footer copyright. Background biasanya putih atau branded.
- **Panel kanan (form):** Form login/register. Background bisa gelap (hijau/biru tua) dengan bokeh/subtle circle decoration.
- **Tombol CTA:** Warna kontras (teal/cyan di background gelap, atau hijau di background terang).
- **Responsive:** `@media (max-width: 820px)` → stack vertikal, sembunyikan ilustrasi.

Implementasi: CSS variables di `:root`, class `.split` / `.panel-left` / `.panel-right` / `.card`. Lihat `style.css` di project referensi untuk contoh lengkap split-panel hijau-putih.

### Tips implementasi UI
- **SVG inline:** Bisa embed SVG langsung di template string JavaScript (const `christmasSvg = ...`). Lebih mudah dikontrol daripada file eksternal untuk ilustrasi sederhana.
- **Image-guided redesign:** User kirim screenshot referensi → `vision_analyze` dulu untuk extract detail (warna, posisi elemen, typography) → baru kode. Jangan tebak dari deskripsi text saja.
- **Verifikasi visual:** Setelah ubah CSS/JS → jalankan dev server → `browser_exec` buka halaman → `capture_screenshot()` → `vision_analyze` cek apakah sesuai referensi.
- **Dark form panel:** Kalau background form gelap, sesuaikan: input `background` gelap (bukan putih), `placeholder` color rendah opacity, `border` subtle, label color terang, error message pakai background semi-transparan dengan border.

## Referensi implementasi
Lihat `vibe-coding/src/auth.js` + `main.js` + `style.css` di workspace user (`/Users/obiramdhani/9remote/vibe-coding/`). Project ini pakai split-panel layout (putih + hijau gelap) dengan SVG ilustrasi Natal.
