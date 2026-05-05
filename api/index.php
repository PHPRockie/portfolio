<?php

// Route Laravel internals away from the read-only filesystem
foreach ([
    'LOG_CHANNEL'     => 'stderr',
    'SESSION_DRIVER'  => 'cookie',
    'CACHE_STORE'     => 'array',
] as $key => $value) {
    $_ENV[$key] = $value;
    putenv("$key=$value");
}

// Create writable dirs Laravel may still need
foreach ([
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/views',
] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
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
