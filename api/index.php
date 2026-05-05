<?php

// Serve static files from public/ directly, before Laravel boots
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$publicPath = realpath(__DIR__ . '/../public');
$filePath   = realpath($publicPath . $uri);

if ($filePath && is_file($filePath) && str_starts_with($filePath, $publicPath)) {
    $ext  = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $mime = match ($ext) {
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'json'  => 'application/json',
        'svg'   => 'image/svg+xml',
        'png'   => 'image/png',
        'jpg', 'jpeg' => 'image/jpeg',
        'gif'   => 'image/gif',
        'ico'   => 'image/x-icon',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        default => 'application/octet-stream',
    };
    header('Content-Type: ' . $mime);
    header('Cache-Control: public, max-age=31536000, immutable');
    readfile($filePath);
    exit;
}

// Writable dirs Laravel needs
foreach ([
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy read-only bootstrap cache to writable /tmp
foreach (['services.php', 'packages.php'] as $file) {
    $src  = __DIR__ . '/../bootstrap/cache/' . $file;
    $dest = '/tmp/bootstrap/cache/' . $file;
    if (!file_exists($dest) && file_exists($src)) {
        copy($src, $dest);
    }
}

// Point Laravel cache + I/O paths to writable /tmp
foreach ([
    'APP_SERVICES_CACHE' => '/tmp/bootstrap/cache/services.php',
    'APP_PACKAGES_CACHE' => '/tmp/bootstrap/cache/packages.php',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
    'LOG_CHANNEL'        => 'stderr',
    'SESSION_DRIVER'     => 'cookie',
    'CACHE_STORE'        => 'array',
] as $key => $value) {
    $_ENV[$key] = $value;
    putenv("$key=$value");
}

// Copy seeded SQLite DB to writable /tmp
$src  = __DIR__ . '/../database/database.sqlite';
$dest = '/tmp/database.sqlite';
if (!file_exists($dest)) {
    copy($src, $dest);
}
$_ENV['DB_DATABASE'] = $dest;
putenv('DB_DATABASE=' . $dest);

require __DIR__ . '/../public/index.php';
