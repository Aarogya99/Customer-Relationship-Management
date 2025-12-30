<?php
// app/init.php

// Load Config
require_once 'config/config.php';

// Autoloader
spl_autoload_register(function ($className) {
    // Convert namespace to full file path
// App\Core\Controller -> app/core/Controller.php

    // Remove "App\" prefix
    $className = str_replace('App\\', '', $className);

    // Construct path
    $path = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load cleanup/helper functions if needed
// require_once 'helpers.php';