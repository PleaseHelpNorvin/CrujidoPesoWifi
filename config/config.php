<?php
return [
    'default_rate_per_peso' => 5,     // fallback if device has no rate
    'default_minutes' => 30,          // default time when coin inserted
    'ssid_name' => 'PisoWiFi',        // WiFi SSID
    'wifi_password' => '12345678',    // WiFi password
    'coin_pin' => 7,                  // GPIO pin for coin slot (for Orange Pi)
    'expire_check_interval' => 60,    // seconds between expire checks
    'log_path' => __DIR__ . '/database/logs.txt',  // optional log file
];