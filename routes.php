<?php

// return [
//     '/' => 'controllers/home.php',
//     '/about' => 'controllers/about.php',
//     '/notes' => 'controllers/notes/index.php',
//     '/notes/create' => 'controllers/notes/create.php',
//     '/note' => 'controllers/notes/show.php',
//     '/dashboard' => 'controllers/dashboard.php'
// ];

$router->get('/', 'controllers/home.php');
$router->get('/about', 'controllers/about.php');
$router->get('/dashboard', 'controllers/dashboard.php');

$router->get('/notes', 'controllers/notes/index.php');
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/show.php');
$router->get('/notes/create', 'controllers/notes/create.php');
$router->post('/notes/create', 'controllers/notes/create.php');