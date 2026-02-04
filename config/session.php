<?php

return [
    'app_name' => env('APP_NAME','bpjs'),
    'driver' => env('SESSION_DRIVER', 'file'),
    'lifetime' => env('SESSION_LIFETIME', 120),
    'idle_timeout' => env('SESSION_IDLE_TIMEOUT', 28800),
    'expire_on_close' => false,
    'encrypt' => false,

    'http_only' => true,
    'secure' => env('SESSION_SECURE_COOKIE', false),
    'same_site' => 'lax',

    'storage_path' => BPJS_BASE_PATH . '/storage/session',
];
