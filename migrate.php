<?php
// migrate.php - creates tables in wifi.db using centralized db.php

// Include the centralized DB connection
include __DIR__ . '/../config/database.php'; // Adjust path if needed

try {
    // Users table
    $db->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        mac TEXT UNIQUE,
        ip TEXT,
        total_minutes I DEFAULT 0,
        expire_time INTEGER DEFAULT 0,
        status TEXT DEFAULT 'offline',
        last_seen INTEGER DEFAULT 0
    )");

    // Coins table
    $db->exec("
    CREATE TABLE IF NOT EXISTS coins (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        mac TEXT,
        value INTEGER,
        minutes_added INTEGER,
        timestamp INTEGER
    )");

    // Logs table
    $db->exec("
    CREATE TABLE IF NOT EXISTS logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        mac TEXT,
        type TEXT,
        message TEXT,
        timestamp INTEGER
    )");

    // Vouchers table (optional)
    $db->exec("
    CREATE TABLE IF NOT EXISTS vouchers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        code TEXT UNIQUE,
        minutes INTEGER,
        is_used INTEGER DEFAULT 0,
        used_by_mac TEXT,
        used_at INTEGER
    )");

    // Devices table
    $db->exec("
    CREATE TABLE IF NOT EXISTS devices (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        device_name TEXT UNIQUE,
        mac TEXT,
        ssid TEXT,
        password TEXT
    )");

    // Device-specific settings table
    $db->exec("
    CREATE TABLE IF NOT EXISTS device_settings (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        device_id INTEGER,
        key TEXT,
        value TEXT,
        FOREIGN KEY(device_id) REFERENCES devices(id)
    )");

    echo "Tables created successfully!\n";

} catch (Exception $e) {
    die("Migration failed: " . $e->getMessage());
}
