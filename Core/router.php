<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = require(base_path('routes.php'));

if (array_key_exists($uri, $routes)) {
    require base_path($routes[$uri]);
} else {
    abort();
}
