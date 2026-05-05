<?php

// --- Writable dirs ---
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

// --- Copy read-only bootstrap cache to /tmp so Laravel can recompile it ---
$cacheFiles = ['services.php', 'packages.php'];
foreach ($cacheFiles as $file) {
    $src  = __DIR__ . '/../bootstrap/cache/' . $file;
    $dest = '/tmp/bootstrap/cache/' . $file;
    if (!file_exists($dest) && file_exists($src)) {
        copy($src, $dest);
    }
}

// --- Point Laravel cache paths to writable /tmp locations ---
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

// --- Copy seeded SQLite DB to /tmp so Laravel can write to it ---
$src  = __DIR__ . '/../database/database.sqlite';
$dest = '/tmp/database.sqlite';
if (!file_exists($dest)) {
    copy($src, $dest);
}
$_ENV['DB_DATABASE'] = $dest;
putenv('DB_DATABASE=' . $dest);

require __DIR__ . '/../public/index.php';
