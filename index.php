<?php

use Bpjs\Framework\Helpers\ErrorHandler;
/**
 * ---------------------------------------------------------------
 *  Bpjs Framework - Front Controller
 * ---------------------------------------------------------------
 *  Semua request masuk ke sini dan diteruskan ke Kernel.
 */
define('BPJS_START', microtime(true));
define('BPJS_VERSION','0.1.2');

// ---------------------------------------------------------------
//  Path Definition
// ---------------------------------------------------------------
$baseDir = realpath(__DIR__.'/');
define('BPJS_BASE_PATH',$baseDir);

// ---------------------------------------------------------------
//  Register The Composer Autoloader
// ---------------------------------------------------------------
require BPJS_BASE_PATH . '/vendor/autoload.php';

ErrorHandler::register();
// ---------------------------------------------------------------
//  Bootstrap The Application
// ---------------------------------------------------------------
$app = require BPJS_BASE_PATH . '/bootstrap/app.php';

// ---------------------------------------------------------------
//  Handle The Incoming Request
// ---------------------------------------------------------------
$kernel = $app->make(\Bpjs\Core\Kernel::class);

$response = $kernel->handle(
    \Bpjs\Core\Request::capture()
);

$response->send();

$kernel->terminate();
