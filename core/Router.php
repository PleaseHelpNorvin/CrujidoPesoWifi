<?php
namespace Core;

class Router
{
    private $routes = [];
    private $currentGroupPrefix = '';

    //usecase example:
    // normal use of router 
    // $router->get('/admin/dashboard', 'AdminController@dashboard');
    // $router->get('/admin/logs', 'AdminController@logs');

    // using group
    // $router->group('/admin', function() use ($router) {
    //     $router->get('/dashboard', 'AdminController@dashboard'); 
    //     $router->get('/logs', 'AdminController@logs');
    // });

    public function get($uri, $callback)
    {
        $uri = $this->currentGroupPrefix . $uri;
        $this->routes['GET'][$uri] = $callback;
    }

    public function post($uri, $callback)
    {
        $uri = $this->currentGroupPrefix . $uri;
        $this->routes['POST'][$uri] = $callback;
    }

    public function group($prefix, $callback)
    {
        $previousGroup = $this->currentGroupPrefix;
        $this->currentGroupPrefix .= $prefix;
        $callback();
        $this->currentGroupPrefix = $previousGroup;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $callback = $this->routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);
            echo "404 Not Found";
            exit;
        }

        if (is_callable($callback)) {
            call_user_func($callback);
        } elseif (is_string($callback)) {
            [$controller, $method] = explode('@', $callback);
            $controller = "App\\Controllers\\$controller";
            (new $controller())->$method();
        }
    }

}
