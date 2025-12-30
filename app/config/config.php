<?php
// app/config/config.php

// Define App Root
define('APPROOT', dirname(dirname(__FILE__)));

// Define URL Root (dynamic)
// This autodetects the subdirectory (e.g., /professional-crm)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
// Do NOT strip /public. We want the links to match the current running path.
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
// Fix Windows backslashes
$base_path = str_replace('\\', '/', $scriptName);
$base_url = $protocol . '://' . $host . $base_path;

// Remove trailing slash if present
$base_url = rtrim($base_url, '/');

define('BASE_URL', $base_url);

// Site Name
define('SITENAME', 'Nexus CRM');

// Database Config (Moved from database.php or simply include it here if preferred)
// For now, let's keep database.php separate but maybe define constants here if needed.
// But database.php returns an array, so we can stick with that or use constants.
// Let's use constants for global access if existing code doesn't use the array config widely yet.
// However, the existing database.php returns an array. Let's respect that pattern 
// but BASE_URL is critical for routing.
