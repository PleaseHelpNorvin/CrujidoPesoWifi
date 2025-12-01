<?php
namespace Core;

class Controller {
    protected function view($path, $data = []) {
        extract($data); 
        include __DIR__ . "/../app/views/$path";
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
