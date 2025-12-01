<?php
namespace Core;

class Model {
    protected $db;

    public function __construct() {
        // Database connection is global in bootstrap
        global $db;
        $this->db = $db;
    }
}
