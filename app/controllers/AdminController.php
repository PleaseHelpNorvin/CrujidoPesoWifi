<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class AdminController extends Controller {

    protected $User;

    public function __construct()
    {
        $this->User = new User();
    }

    public function dashboard() {
        // $userModel = new User();
        $users = $this->User->getAll();

        $this->view('admin/dashboard', ['users' => $users]);
    }
}
