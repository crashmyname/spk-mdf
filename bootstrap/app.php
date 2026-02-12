<?php
use Bpjs\Core\App;
use Bpjs\Core\Cache;
use Bpjs\Core\FileCacheDriver;

// Inisialisasi instance utama framework
$app = new App();

// Registrasi service / kernel
$app->singleton(Bpjs\Core\Kernel::class, function () use ($app) {
    return new Bpjs\Core\Kernel($app);
});

Cache::init(
    new FileCacheDriver(BPJS_BASE_PATH . '/storage/cache')
);

return $app;
