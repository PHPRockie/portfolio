<?php

// Create writable dirs Laravel needs before config is loaded
$dirs = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Point Blade compiled views to writable /tmp location
// (avoids realpath() returning false on read-only storage dir)
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

// Route all other Laravel I/O away from the read-only filesystem
foreach ([
    'LOG_CHANNEL'    => 'stderr',
    'SESSION_DRIVER' => 'cookie',
    'CACHE_STORE'    => 'array',
] as $key => $value) {
    $_ENV[$key] = $value;
    putenv("$key=$value");
}

// Copy seeded SQLite DB to /tmp so Laravel can write to it
$src  = __DIR__ . '/../database/database.sqlite';
$dest = '/tmp/database.sqlite';
if (!file_exists($dest)) {
    copy($src, $dest);
}
$_ENV['DB_DATABASE'] = $dest;
putenv('DB_DATABASE=' . $dest);

require __DIR__ . '/../public/index.php';
