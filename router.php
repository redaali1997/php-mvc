<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => './controllers/home.php',
    '/about' => './controllers/about.php',
    '/dashboard' => './controllers/dashboard.php'
];

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    abort();
}

function abort($status = 404)
{
    http_response_code($status);

    require "./views/{$status}.view.php";

    die();
}
