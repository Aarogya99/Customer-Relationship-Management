<?php
// public/debug_schema.php
define('APPROOT', dirname(__DIR__) . '/app');
require_once dirname(__DIR__) . '/app/config/config.php';
require_once dirname(__DIR__) . '/app/core/Database.php';

use App\Core\Database;

try {
    $db = Database::getInstance()->getConnection();

    // 1. Describe Table
    $stmt = $db->query("DESCRIBE deals");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h1>Table Schema: leads</h1>";
    echo "<pre>" . print_r($columns, true) . "</pre>";

    // 2. Fetch One Record
    $stmt = $db->query("SELECT * FROM deals LIMIT 1");
    $lead = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h1>Sample Data</h1>";
    echo "<pre>" . print_r($lead, true) . "</pre>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
