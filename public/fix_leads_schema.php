<?php
// public/fix_leads_schema.php
define('APPROOT', dirname(__DIR__) . '/app');
require_once dirname(__DIR__) . '/app/config/config.php';
require_once dirname(__DIR__) . '/app/core/Database.php';

use App\Core\Database;

try {
    $db = Database::getInstance()->getConnection();

    // 1. Rename existing incompatible table
    // Check if table has 'title' column which indicates old schema
    $stmt = $db->query("SHOW COLUMNS FROM leads LIKE 'title'");
    $hasTitle = $stmt->fetch();

    if ($hasTitle) {
        $db->exec("RENAME TABLE leads TO leads_backup_" . time());
        echo "Renamed incompatible 'leads' table to backup.<br>";
    }

    // 2. Create correct table
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
    echo "Created correct 'leads' table.<br>";

    // 3. Seed some sample data?
    $stmt = $db->prepare("INSERT INTO leads (name, email, phone, company, source, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute(['John Doe', 'john@example.com', '555-0123', 'Acme Corp', 'Website', 'New']);
    echo "Seeded 1 sample lead.<br>";

    // Also check deals table just in case
    $stmt = $db->query("SHOW COLUMNS FROM deals LIKE 'title'");
    $hasTitleDeals = $stmt->fetch();
    if ($hasTitleDeals) {
        // If deals exist but wrong schema (unlikely but safe to check)
        $db->exec("RENAME TABLE deals TO deals_backup_" . time());
        echo "Renamed incompatible 'deals' table to backup.<br>";
        // Re-create deals (copy from setup_db)
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
        echo "Re-created 'deals' table.<br>";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
