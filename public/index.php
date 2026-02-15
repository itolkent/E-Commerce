<?php
declare(strict_types=1);

session_start();

// Load core config
require_once __DIR__ . '/../app/config/config.php';

// Autoload controllers, models
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/controllers/' . $class . '.php',
        __DIR__ . '/../app/models/' . $class . '.php',
        __DIR__ . '/../app/core/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Extract URL for PHP built‑in server
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');
$_GET['url'] = $path;

// Start router
$router = new Router();
require_once __DIR__ . '/../app/config/routes.php';
$router->dispatch();