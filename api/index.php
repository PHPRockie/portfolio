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

// Debug: log env and dir state to Vercel stderr
error_log('VERCEL_DEBUG VIEW_COMPILED_PATH=' . getenv('VIEW_COMPILED_PATH'));
error_log('VERCEL_DEBUG views_dir_exists=' . (is_dir('/tmp/storage/framework/views') ? 'YES' : 'NO'));
error_log('VERCEL_DEBUG views_dir_writable=' . (is_writable('/tmp/storage/framework/views') ? 'YES' : 'NO'));

// Point Blade compiled views to writable /tmp location
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

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

// Catch any PHP-level errors and surface them in the response
try {
    require __DIR__ . '/../public/index.php';
} catch (Throwable $e) {
    error_log('VERCEL_FATAL: ' . $e->getMessage());
    error_log('VERCEL_FATAL_FILE: ' . $e->getFile() . ':' . $e->getLine());
    http_response_code(500);
    echo '<pre>' . htmlspecialchars($e->getMessage()) . "\n\n" . htmlspecialchars($e->getTraceAsString()) . '</pre>';
}
