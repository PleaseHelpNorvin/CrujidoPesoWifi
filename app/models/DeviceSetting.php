<?php
namespace App\Models;

use Core\Model;

class DeviceSetting extends Model {
    
    public function getRatePerPeso($device_id) {
        $stmt = $this->db->prepare("SELECT value FROM device_settings WHERE device_id = :device_id AND key = 'rate_per_peso'");
        $stmt->execute([':device_id' => $device_id]);
        return $stmt->fetchColumn();
    }
}
