<?php

use controllers\NoteController;

$router->get('/', 'controllers/home.php');
$router->get('/about', 'controllers/about.php');
$router->get('/dashboard', 'controllers/dashboard.php');

$router->get('/notes', [NoteController::class, 'index']);
$router->get('/note', [NoteController::class, 'show']);
$router->get('/notes/create', [NoteController::class, 'create']);
// $router->delete('/note', 'controllers/notes/show.php');
// $router->post('/notes/create', 'controllers/notes/create.php');