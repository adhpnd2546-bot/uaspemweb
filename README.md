# TaniPantau — Fullstack Application

Aplikasi monitoring lahan pertanian dan kunjungan petugas lapangan.
Dibuat untuk memenuhi kualifikasi UAS Pemrograman Web.

## Struktur Project

```
tani-pantau-app/
├── backend/      → Laravel 12 (REST API & Admin Panel)
├── frontend/     → PHP Native (Public View)
└── README.md
```

## Teknologi Yang Digunakan

| Layer    | Stack                                        |
|----------|----------------------------------------------|
| Backend  | Laravel 12, MySQL, REST API, Bootstrap 5     |
| Frontend | PHP Native, Bootstrap 5, cURL (Consuming API)|

## Cara Instalasi

### 1. Buat Database
Buat database baru bernama `tanipantau` di phpMyAdmin atau MySQL.

### 2. Konfigurasi & Jalankan Backend
```bash
cd backend
cp .env.example .env
```
Edit file `.env`, sesuaikan konfigurasi database:
```env
DB_DATABASE=tanipantau
DB_USERNAME=root
DB_PASSWORD=
```
Jalankan perintah berikut:
```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```
Backend akan berjalan di `http://127.0.0.1:8000`.

### 3. Konfigurasi & Jalankan Frontend
Buka terminal **terpisah**:
```bash
cd frontend
php -S localhost:8080
```
Frontend akan berjalan di `http://localhost:8080`.

> ⚠️ Pastikan `frontend/includes/api.php` memiliki `API_BASE_URL` yang mengarah ke `http://127.0.0.1:8000/api`.

## Akun Login (Admin Panel Backend)

| Peran   | Email                  | Password   |
|---------|------------------------|------------|
| Admin   | `admin@example.com`    | `password` |
| Petugas | `petugas@example.com`  | `password` |

## Fitur Utama

### Admin Panel (Backend)
- Dashboard Statistik (Total Petani, Lahan, Kunjungan).
- CRUD Petani (Nama, NIK, Alamat, dll).
- CRUD Lahan (Komoditas, Lokasi, Tanggal Tanam).
- Input Kunjungan (Kondisi lahan, Catatan, Foto Dokumentasi).
- Fitur update otomatis Fase Lahan saat input kunjungan.

### Frontend (Public View)
- Landing page dengan Hero Banner & Statistik.
- Pencarian lahan dan petani.
- Detail lahan lengkap dengan peta Leaflet & histori kunjungan petugas.

## Catatan
- Pastikan Laravel server berjalan (`php artisan serve`) agar frontend dapat mengambil data via API.
- Foto dokumentasi disimpan di `backend/storage/app/public/kunjungan`.
