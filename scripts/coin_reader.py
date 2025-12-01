#!/usr/bin/env python3
import sqlite3
import time
import json
import OPi.GPIO as GPIO  # for Orange Pi

# --- Load config from JSON ---
with open('../config/config.json') as f:
    config = json.load(f)

DB_PATH = '../database/wifi.db'
COIN_PIN = config.get('coin_pin', 7)
RATE_PER_PESO = config.get('default_rate_per_peso', 5)
DEFAULT_MINUTES = config.get('default_minutes', 30)
DEFAULT_VALUE = config.get('default_coin_value', 1)
DEFAULT_MAC = config.get('default_mac', 'AA:BB:CC:DD:EE:FF')

# --- Setup GPIO ---
GPIO.setmode(GPIO.BOARD)
GPIO.setup(COIN_PIN, GPIO.IN, pull_up_down=GPIO.PUD_UP)

# --- Coin insertion function ---
def insert_coin(mac, value):
    conn = sqlite3.connect(DB_PATH)
    cursor = conn.cursor()

    minutes_added = value * RATE_PER_PESO

    cursor.execute("""
        INSERT INTO coins (mac, value, minutes_added, timestamp)
        VALUES (?, ?, ?, ?)
    """, (mac, value, minutes_added, int(time.time())))

    cursor.execute("""
        UPDATE users
        SET total_minutes = total_minutes + ?,
            expire_time = expire_time + ?
        WHERE mac = ?
    """, (minutes_added, minutes_added * 60, mac))

    conn.commit()
    conn.close()
    print(f"[{time.strftime('%H:%M:%S')}] Added {minutes_added} minutes to {mac}")

# --- Detect coin inserted ---
def coin_detected_callback(channel):
    insert_coin(DEFAULT_MAC, DEFAULT_VALUE)

# --- Setup interrupt for coin pin ---
GPIO.add_event_detect(COIN_PIN, GPIO.FALLING, callback=coin_detected_callback, bouncetime=300)

# --- Keep script running ---
print("Coin reader running... Press CTRL+C to exit.")
try:
    while True:
        time.sleep(1)
except KeyboardInterrupt:
    print("Exiting coin reader.")
finally:
    GPIO.cleanup()
