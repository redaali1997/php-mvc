<?php
session_start();

use Core\Router;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

// Class Autoload
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require base_path("$class.php");
});

// Bootstrap Container
require base_path('bootstrap.php');

// Router
$router = new Router();
require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method);
