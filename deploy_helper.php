<?php
/**
 * Laravel Deployment Helper
 * Akses file ini di browser untuk menjalankan perintah artisan
 * HAPUS FILE INI SETELAH DEPLOYMENT SELESAI!
 */

// Cek apakah sudah di production, jika ya, blokir akses
if (file_exists(__DIR__.'/.env')) {
    $env = file_get_contents(__DIR__.'/.env');
    if (strpos($env, 'APP_ENV=production') !== false && strpos($env, 'APP_DEBUG=false') !== false) {
        die('Deployment helper is disabled in production mode. Please delete this file.');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Deployment Helper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-warning">
                    <strong>⚠️ PERINGATAN:</strong> Hapus file ini setelah deployment selesai!
                </div>
                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Laravel Deployment Helper</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['action'])) {
                            echo '<div class="alert alert-info">Menjalankan perintah...</div>';
                            echo '<pre class="bg-dark text-light p-3 rounded">';
                            
                            require __DIR__.'/vendor/autoload.php';
                            $app = require_once __DIR__.'/bootstrap/app.php';
                            $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
                            
                            switch ($_GET['action']) {
                                case 'key':
                                    $kernel->call('key:generate', ['--force' => true]);
                                    echo "✅ Application key generated!\n";
                                    break;
                                    
                                case 'migrate':
                                    $kernel->call('migrate', ['--force' => true]);
                                    echo "✅ Database migrated!\n";
                                    break;
                                    
                                case 'migrate-seed':
                                    $kernel->call('migrate:fresh', ['--seed' => true, '--force' => true]);
                                    echo "✅ Database migrated and seeded!\n";
                                    echo "\n📧 Login: admin@gmail.com\n";
                                    echo "🔑 Password: admin123\n";
                                    break;
                                    
                                case 'cache-clear':
                                    $kernel->call('config:clear');
                                    $kernel->call('cache:clear');
                                    $kernel->call('route:clear');
                                    $kernel->call('view:clear');
                                    echo "✅ All caches cleared!\n";
                                    break;
                                    
                                case 'cache-build':
                                    $kernel->call('config:cache');
                                    $kernel->call('route:cache');
                                    $kernel->call('view:cache');
                                    echo "✅ Caches built for production!\n";
                                    break;
                                    
                                case 'storage-link':
                                    $kernel->call('storage:link');
                                    echo "✅ Storage linked!\n";
                                    break;
                            }
                            
                            echo '</pre>';
                            echo '<a href="deploy_helper.php" class="btn btn-secondary">← Kembali</a>';
                        } else {
                        ?>
                        
                        <h5>Pilih Perintah Deployment:</h5>
                        <div class="list-group mt-3">
                            <a href="?action=key" class="list-group-item list-group-item-action">
                                <strong>1. Generate Application Key</strong>
                                <br><small>Jalankan ini PERTAMA KALI</small>
                            </a>
                            <a href="?action=migrate" class="list-group-item list-group-item-action">
                                <strong>2. Run Migration</strong>
                                <br><small>Buat tabel database (tanpa data sample)</small>
                            </a>
                            <a href="?action=migrate-seed" class="list-group-item list-group-item-action">
                                <strong>3. Run Migration + Seed</strong>
                                <br><small>Buat tabel database + isi data sample</small>
                            </a>
                            <a href="?action=cache-clear" class="list-group-item list-group-item-action">
                                <strong>4. Clear All Cache</strong>
                                <br><small>Hapus semua cache</small>
                            </a>
                            <a href="?action=cache-build" class="list-group-item list-group-item-action">
                                <strong>5. Build Cache (Production)</strong>
                                <br><small>Build cache untuk performa optimal</small>
                            </a>
                            <a href="?action=storage-link" class="list-group-item list-group-item-action">
                                <strong>6. Create Storage Link</strong>
                                <br><small>Link storage ke public</small>
                            </a>
                        </div>
                        
                        <div class="alert alert-info mt-4">
                            <strong>Urutan deployment yang benar:</strong>
                            <ol class="mb-0">
                                <li>Generate Application Key</li>
                                <li>Run Migration + Seed</li>
                                <li>Build Cache</li>
                                <li><strong>HAPUS FILE INI!</strong></li>
                            </ol>
                        </div>
                        
                        <?php } ?>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>System Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td><strong>PHP Version:</strong></td>
                                <td><?php echo phpversion(); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Laravel:</strong></td>
                                <td><?php echo file_exists('artisan') ? '✅ Detected' : '❌ Not Found'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>.env File:</strong></td>
                                <td><?php echo file_exists('.env') ? '✅ Found' : '❌ Not Found'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Vendor Folder:</strong></td>
                                <td><?php echo file_exists('vendor') ? '✅ Found' : '❌ Not Found (Run composer install)'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Storage Writable:</strong></td>
                                <td><?php echo is_writable('storage') ? '✅ Yes' : '❌ No (Change permission to 775)'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="text-center mt-3 mb-5">
                    <a href="/" class="btn btn-success">🏠 Buka Aplikasi</a>
                    <a href="README.md" class="btn btn-info">📖 Dokumentasi</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
