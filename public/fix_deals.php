<?php
// public/fix_deals.php
define('APPROOT', dirname(__DIR__) . '/app');
require_once dirname(__DIR__) . '/app/config/config.php';
require_once dirname(__DIR__) . '/app/core/Database.php';

use App\Core\Database;

try {
    $db = Database::getInstance()->getConnection();

    // 1. Check DEALS
    $stmt = $db->query("SHOW COLUMNS FROM deals LIKE 'title'");
    $hasTitle = $stmt->fetch();

    if ($hasTitle) {
        $backupName = "deals_backup_" . time();
        $db->exec("RENAME TABLE deals TO $backupName");
        echo "Renamed legacy 'deals' to '$backupName'.<br>";

        $sqlDeals = "CREATE TABLE IF NOT EXISTS deals (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            customer_id INT,
            stage VARCHAR(50) DEFAULT 'Prospect',
            amount DECIMAL(10, 2) DEFAULT 0.00,
            close_date DATE,
            created_by INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($sqlDeals);
        echo "Created correct 'deals' table.<br>";
    } else {
        echo "Deals table schema appears correct (no 'title' column).<br>";
    }

    // 2. Check LEADS (Sanity Check)
    $stmt = $db->query("SHOW COLUMNS FROM leads LIKE 'name'");
    $hasName = $stmt->fetch();

    if (!$hasName) {
        echo "WARNING: Leads table MISSING 'name' column! Re-running leads fix...<br>";
        // Force fix leads
        $db->exec("RENAME TABLE leads TO leads_backup_" . time());
        $sqlLeads = "CREATE TABLE IF NOT EXISTS leads (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255),
            phone VARCHAR(50),
            company VARCHAR(255),
            source VARCHAR(100) DEFAULT 'Website',
            status VARCHAR(50) DEFAULT 'New',
            notes TEXT,
            created_by INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($sqlLeads);
        echo "Fixed 'leads' table.<br>";
    } else {
        echo "Leads table schema appears correct.<br>";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
