# Panduan Deploy ke Hosting

## Pilihan Hosting Gratis yang Direkomendasikan:

### 1. InfinityFree (Recommended)
- Website: https://infinityfree.net
- Fitur: PHP 8.2, MySQL, SSL Gratis
- Unlimited Bandwidth

### 2. 000webhost
- Website: https://www.000webhost.com
- Fitur: PHP 8.2, MySQL, SSL Gratis

### 3. Railway.app
- Website: https://railway.app
- Fitur: Support Laravel, PostgreSQL, SSL Auto
- $5 credit gratis per bulan

## Cara Deploy ke InfinityFree (Shared Hosting)

### Step 1: Daftar Akun
1. Kunjungi https://infinityfree.net
2. Klik "Sign Up"
3. Buat akun gratis
4. Buat hosting account baru

### Step 2: Setup Database
1. Login ke Control Panel (cPanel)
2. Buka "MySQL Databases"
3. Buat database baru (contoh: `epiz_xxxxx_mahasiswa`)
4. Buat user baru dan set password
5. Tambahkan user ke database
6. Catat: Database Name, Username, Password, Host

### Step 3: Upload File
1. Buka "File Manager" di cPanel
2. Navigasi ke folder `htdocs`
3. Upload semua file project KECUALI:
   - folder `node_modules`
   - folder `tests`
   - file `.git`

### Step 4: Move Public Files
1. Copy semua isi folder `public` ke folder `htdocs`
2. Hapus folder `public` dari htdocs
3. Folder structure sekarang:
   ```
   htdocs/
   ├── index.php (dari public)
   ├── .htaccess (dari public)
   ├── build/ (dari public)
   ├── app/
   ├── bootstrap/
   ├── config/
   ├── database/
   ├── resources/
   ├── routes/
   ├── storage/
   ├── vendor/
   └── ...
   ```

### Step 5: Edit index.php
Edit file `htdocs/index.php` line 17 dan 31:

**SEBELUM:**
```php
require __DIR__.'/../bootstrap/app.php';
```

**SESUDAH:**
```php
require __DIR__.'/bootstrap/app.php';
```

### Step 6: Setup .env
1. Copy file `.env.example` menjadi `.env`
2. Edit file `.env`:
   ```
   APP_NAME="CRUD Mahasiswa"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=http://yourdomain.infinityfreeapp.com

   DB_CONNECTION=mysql
   DB_HOST=sql123.infinityfree.com
   DB_PORT=3306
   DB_DATABASE=epiz_xxxxx_mahasiswa
   DB_USERNAME=epiz_xxxxx
   DB_PASSWORD=your_password
   ```

### Step 7: Set Permissions
Set permission folder berikut ke `755` atau `775`:
- `storage/`
- `storage/framework/`
- `storage/logs/`
- `bootstrap/cache/`

### Step 8: Generate Key
Buat file `artisan.php` di root dengan isi:
```php
<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\ConsoleOutput
);
echo $status;
```

Lalu akses: `http://yourdomain.com/artisan.php key:generate`

### Step 9: Run Migration
Buat file `migrate.php` di root:
```php
<?php
use Illuminate\Support\Facades\Artisan;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

Artisan::call('migrate:fresh --seed --force');
echo '<pre>';
echo Artisan::output();
echo '</pre>';
echo "Migration completed!";
```

Akses: `http://yourdomain.com/migrate.php`

**PENTING:** Hapus file `artisan.php` dan `migrate.php` setelah selesai!

### Step 10: Test Aplikasi
1. Buka: `http://yourdomain.infinityfreeapp.com`
2. Login dengan:
   - Email: admin@gmail.com
   - Password: admin123

## Cara Deploy ke Railway.app (VPS Cloud)

### Step 1: Setup GitHub
1. Upload project ke GitHub repository
2. Pastikan file `.gitignore` sudah benar

### Step 2: Deploy ke Railway
1. Kunjungi https://railway.app
2. Login dengan GitHub
3. Klik "New Project"
4. Pilih "Deploy from GitHub repo"
5. Pilih repository Laravel Anda

### Step 3: Setup Environment
Tambahkan environment variables:
```
APP_KEY=(generate dengan php artisan key:generate)
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
```

### Step 4: Setup Database
1. Klik "+ Add Plugin"
2. Pilih "MySQL"
3. Railway akan auto-connect database

### Step 5: Setup Build
Tambahkan file `nixpacks.toml`:
```toml
[phases.setup]
nixPkgs = ['php82', 'php82Packages.composer']

[phases.build]
cmds = [
    'composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader',
    'php artisan config:cache',
    'php artisan route:cache',
    'php artisan view:cache',
]

[start]
cmd = 'php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT}'
```

### Step 6: Deploy
Railway akan auto-deploy. Tunggu hingga selesai.

## Troubleshooting

### Error: 500 Internal Server Error
- Cek file `.env` sudah benar
- Cek permission folder `storage` dan `bootstrap/cache`
- Cek APP_KEY sudah di-generate

### Error: Database Connection
- Cek credentials database di `.env`
- Pastikan database sudah dibuat
- Test koneksi dari cPanel

### Error: 404 Not Found
- Pastikan `.htaccess` ada di root public
- Pastikan mod_rewrite aktif

### CSS/JS Tidak Load
- Jalankan `npm run build` sebelum upload
- Cek path di `index.php` sudah benar
- Cek folder `public/build` sudah terupload

## Support
Jika ada masalah, cek Laravel logs di `storage/logs/laravel.log`

## Informasi Login

**Email:** admin@gmail.com  
**Password:** admin123

Jangan lupa ganti password setelah deploy!
