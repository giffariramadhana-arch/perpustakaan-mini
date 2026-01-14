# Perpustakaan Mini

Aplikasi sederhana untuk manajemen buku dan peminjaman.

## Anggota Kelompok
- Mitsna Giffari Ramadhana (2402310129)
- Alif Isfanah (2402310135)
- Fatimah Zahro (2402310119)

## Fitur
- **Admin**
  - CRUD Buku (title, author, year, stock, category)
  - Lihat semua transaksi peminjaman
  - Mengubah status transaksi & mengembalikan buku
  - Export transaksi CSV
- **User**
  - Lihat daftar buku
  - Meminjam buku (maks. 3 buku aktif, stock > 0)
  - Melihat daftar pinjaman sendiri
- **Aturan bisnis**
  - Stock buku tidak bisa negatif
  - Limit peminjaman 3 buku aktif per user
  - Borrow date otomatis, return deadline +7 hari
  - Denda keterlambatan (opsional)
 
## Instalasi
1. Clone repository:
```bash
git clone https://github.com/giffariramadhana-arch/perpustakaan-mini.git
cd perpustakaan-mini
```
2. Install dependencies:
```bash
composer install
npm install
npm run dev
```
3. Copy .env.example → .env dan sesuaikan database:
```bash
cp .env.example .env
```
4. Generate key aplikasi:
```bash
php artisan key:generate
```
5. Migrasi dan seed database:
```bash
php artisan migrate --seed
```
6. Jalankan serve:
```bash
php artisan serve
```
7. Akses di browser: http://127.0.0.1:8000

## Akun Demo
- Admin
Email: admin@demo.com / Password: admin123
- User
Email: user@demo.com / Password: 12345678
