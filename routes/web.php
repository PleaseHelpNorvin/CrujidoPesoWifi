<?php
// Web routes (portal + admin pages)

// Portal routes
$router->get('/', 'PortalController@index');         
$router->get('/remaining', 'PortalController@remaining'); 

// Admin routes
$router->get('/admin/login', function() {
    include __DIR__ . '/../app/views/admin/login.php';
});
$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/admin/logs', function() {
    include __DIR__ . '/../app/views/admin/logs.php';
});
$router->get('/admin/settings', function() {
    include __DIR__ . '/../app/views/admin/settings.php';
});
$router->get('/admin/rates', function() {
    include __DIR__ . '/../app/views/admin/rates.php';
});
