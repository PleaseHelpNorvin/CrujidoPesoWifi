<?php
// db.php - centralized PDO connection to SQLite

// usage:
// include '../db.php';  // Adjust path based on location
// $stmt = $db->query("SELECT * FROM users");

try {
    $db = new PDO('sqlite:' . __DIR__ . '/../database/wifi.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
