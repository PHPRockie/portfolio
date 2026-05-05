<?php

// Create writable directories Laravel needs in /tmp
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

// Point Laravel's storage and cache to /tmp
$_ENV['APP_STORAGE'] = '/tmp/storage';
putenv('APP_STORAGE=/tmp/storage');

// Copy SQLite DB to /tmp so Laravel can write to it
$src  = __DIR__ . '/../database/database.sqlite';
$dest = '/tmp/database.sqlite';
if (!file_exists($dest)) {
    copy($src, $dest);
}

$_ENV['DB_DATABASE'] = $dest;
putenv('DB_DATABASE=' . $dest);

require __DIR__ . '/../public/index.php';
