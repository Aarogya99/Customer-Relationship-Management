<?php
// router.php for PHP built-in server

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Serve static files directly
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

// Emulate .htaccess rewrite
$_GET['url'] = ltrim($uri, '/');

require_once __DIR__ . '/public/index.php';
