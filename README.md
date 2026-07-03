# Aplikasi CRUD Mahasiswa - Laravel

Aplikasi manajemen data mahasiswa dengan fitur CRUD lengkap menggunakan Laravel.

## Fitur
- ✅ Authentication (Login & Register)
- ✅ Dashboard
- ✅ CRUD Mahasiswa (Create, Read, Update, Delete)
- ✅ Manajemen User
- ✅ Responsive Design dengan Bootstrap 5

## Teknologi
- Laravel 12
- PHP 8.2+
- Bootstrap 5
- MySQL/SQLite

## Instalasi Lokal

### 1. Clone atau Download Project

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database
Edit file `.env` dan sesuaikan database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_mahasiswa
DB_USERNAME=root
DB_PASSWORD=
```

Atau gunakan SQLite (sudah default):
```
DB_CONNECTION=sqlite
```

### 5. Migrate & Seed Database
```bash
php artisan migrate:fresh --seed
```

### 6. Build Assets
```bash
npm run build
```

### 7. Jalankan Server
```bash
php artisan serve
```

Buka browser: http://127.0.0.1:8000

## Login Default

**Email:** admin@gmail.com  
**Password:** admin123

## Struktur Database

### Tabel: mahasiswas
- id (Primary Key)
- nim (Unique)
- nama
- email
- program_studi
- semester
- created_at
- updated_at

### Tabel: users
- id (Primary Key)
- name
- email (Unique)
- password
- created_at
- updated_at

## Screenshot Fitur
- Login Page
- Dashboard
- Data User
- Data Mahasiswa (dengan tombol Create, Edit, Delete)
- Form Tambah Mahasiswa
- Form Edit Mahasiswa

## Deployment ke Hosting

### Untuk Shared Hosting (cPanel):
1. Upload semua file kecuali folder `node_modules` dan `storage`
2. Move isi folder `public` ke `public_html`
3. Update `index.php` di `public_html` untuk path yang benar
4. Setup database di cPanel
5. Import database atau jalankan migration
6. Set permission folder `storage` dan `bootstrap/cache` ke 775

### Untuk VPS/Cloud:
1. Clone repository
2. Install dependencies
3. Setup web server (Nginx/Apache)
4. Configure domain
5. Setup SSL certificate
6. Run migrations

## Kontak
Dibuat untuk tugas praktikum.

## Lisensi
Open Source - MIT License
