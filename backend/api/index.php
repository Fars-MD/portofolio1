<?php

use Illuminate\Http\Request;

$basePath = __DIR__ . '/..';

if (getenv('VERCEL_ENV')) {
    $tmp = '/tmp/laravel';
    foreach (['framework/cache/data', 'framework/sessions', 'framework/views', 'logs'] as $dir) {
        $path = "$tmp/$dir";
        if (!is_dir($path)) {
            @mkdir($path, 0775, true);
        }
    }
    putenv("APP_STORAGE=$tmp");
}

require $basePath . '/vendor/autoload.php';

$app = require_once $basePath . '/bootstrap/app.php';

if (getenv('VERCEL_ENV')) {
    $app->useStoragePath($tmp);
}

$app->handleRequest(Request::capture());
