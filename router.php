<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = require('./routes.php');

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    abort();
}
