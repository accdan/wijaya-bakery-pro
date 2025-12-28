# 🥐 Wijaya Bakery Pro

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

> **Platform Manajemen & E-Commerce Bakery Modern yang Elegan & Cepat.**
> Didesain untuk memberikan pengalaman pengguna yang seamless mulai dari pemilihan menu hingga checkout, serta kontrol penuh bagi admin.

---

## ✨ Fitur Unggulan

### 🛍️ User Experience (Pelanggan)
*   **Katalog Menu Interaktif**: Jelajahi varian roti dan kue dengan tampilan visual yang menggugah selera.
*   **Sistem Keranjang & Checkout**: Alur pembelian yang mudah dengan kalkulasi otomatis.
*   **User Dashboard**: Riwayat pesanan dan pelacakan status pesanan secara real-time.
*   **Autentikasi Modern**: Login dengan Email atau integrasi **Google Auth**.
*   **Mobile Responsive**: Tampilan optimal di semua perangkat (Desktop, Tablet, Mobile).

### 🛠️ Admin Dashboard (Manajemen)
*   **Dashboard Analitik**: Ringkasan performa penjualan dan aktivitas terbaru.
*   **Manajemen Menu & Stok**: Tambah, edit, dan atur ketersediaan produk dengan mudah.
*   **Kontrol Pesanan (Order Management)**: Proses pesanan masuk, ubah status, dan cetak invoice.
*   **Laporan & Export**: Unduh laporan penjualan format CSV atau Print langsung.
*   **Role-Based Access Control (RBAC)**: Pembagian hak akses yang jelas antara Super Admin, Staff, dll.
*   **System Tools**:
    *   🛡️ **Sistem Backup**: Backup database aman.
    *   🧹 **Trash Management**: Restore data yang tidak sengaja terhapus.
    *   🔧 **Maintenance Mode**: Mode perbaikan sistem dengan satu klik.

---

## 🚀 Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan project di komputer lokal Anda.

### Prasyarat
*   PHP >= 8.2
*   Composer
*   Node.js & NPM
*   MySQL Database

### 1. Clone Repository
```bash
git clone https://github.com/Start-Z/wijaya-bakery-pro.git
cd wijaya-bakery-pro
```

### 2. Install Dependencies
Install dependencies backend (Laravel) dan frontend (Node.js).
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
Salin file `.env.example` ke `.env` dan atur konfigurasi database Anda.
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wijaya_bakery
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Key & Database
Generate aplikasi key dan jalankan migrasi database beserta seeder (data dummy).
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Build Assets & Jalankan Server
Compile asset CSS/JS dan jalankan server lokal.

**Terminal 1 (Vite Development Server):**
```bash
npm run dev
```

**Terminal 2 (Laravel Server):**
```bash
php artisan serve
```

Akses aplikasi di: [http://localhost:8000](http://localhost:8000)

---

## 🔐 Akun Default (Seeder)

Jika Anda menjalankan `--seed`, gunakan akun berikut untuk login:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@wijayabakery.com` (Cek Seeder) | `password` |
| **User** | `user@example.com` | `password` |

*(Catatan: Cek `database/seeders/UserSeeder.php` untuk detail kredensial yang lebih akurat jika berbeda)*

---

## 📂 Struktur Project

*   `app/Http/Controllers`: Logika backend utama.
*   `resources/views`: Tampilan antarmuka (Blade Templates).
*   `routes/web.php`: Definisi rute aplikasi.
*   `public`: Asset publik (Gambar, File upload).

---

## 🛡️ License

Project ini dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).

---

<p align="center">
  Dibuat dengan ❤️ oleh Tim Wijaya Bakery
</p>
