<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use App\Models\DeviceSetting;

class PortalController extends Controller {

    protected $User;
    protected $DeviceSetting;
    
    public function __construct() 
    {
        $this->User = new User();
        $this->DeviceSetting = new DeviceSetting();
    }

    public function index() {
        $this->view('portal/index');
    }

    public function remaining() {
        $mac = $_GET['mac'] ?? null;
        if (!$mac) {
            $this->json(['error' => 'MAC required']);
        }

        $data = $this->User->findByMac($mac);

        if (!$data) {
            $this->json(['error' => 'User not found']);
        } else {
            $this->json([
                'mac' => $mac,
                'minutes_left' => max(0, floor(($data['expire_time'] - time())/60))
            ]);
        }
    }

    public function addTime() {
        $mac = $_GET['mac'] ?? null;
        $device_id = $_GET['device_id'] ?? 1;
        $value = $_GET['value'] ?? 1;

        if (!$mac) {
            $this->json(['error' => 'MAC required']);
        }

        $rateModel = $this->DeviceSetting;
        $rate = $rateModel->getRatePerPeso($device_id) ?? 5;

        $minutes = $value * $rate;

        $this->User->addMinutes($mac, $minutes);

        $this->json(['success' => true, 'minutes_added' => $minutes]);
    }
}
