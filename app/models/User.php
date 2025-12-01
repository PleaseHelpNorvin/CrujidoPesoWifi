<?php
namespace App\Models;

use Core\Model;

class User extends Model {

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByMac($mac) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE mac = :mac");
        $stmt->execute([':mac' => $mac]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addMinutes($mac, $minutes) {
        $stmt = $this->db->prepare("
            INSERT INTO users (mac, total_minutes, expire_time, status, last_seen)
            VALUES (:mac, :minutes, strftime('%s','now') + :minutes*60, 'online', strftime('%s','now'))
            ON CONFLICT(mac) DO UPDATE SET
                total_minutes = total_minutes + :minutes,
                expire_time = strftime('%s','now') + total_minutes*60,
                status = 'online',
                last_seen = strftime('%s','now')
        ");
        $stmt->execute([
            ':mac' => $mac,
            ':minutes' => $minutes
        ]);
    }
}
