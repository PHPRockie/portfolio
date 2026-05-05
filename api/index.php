<?php

// Vercel's filesystem is read-only, so copy the SQLite DB to /tmp
// so Laravel can write to it (contact form, sessions, etc.)
$src  = __DIR__ . '/../database/database.sqlite';
$dest = '/tmp/database.sqlite';

if (!file_exists($dest)) {
    copy($src, $dest);
}

$_ENV['DB_DATABASE'] = $dest;
putenv('DB_DATABASE=' . $dest);

require __DIR__ . '/../public/index.php';
