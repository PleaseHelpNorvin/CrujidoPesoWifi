<?php
// helpers/functions.php

function redirect($url) {
    header("Location: $url");
    exit;
}

function now() {
    return time(); // current timestamp
}

function formatMinutes($minutes) {
    $h = floor($minutes / 60);
    $m = $minutes % 60;
    return sprintf("%02d:%02d", $h, $m);
}

function jsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
