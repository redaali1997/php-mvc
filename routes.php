<?php

use app\Controllers\ProductController;

$router->get('/', [ProductController::class, 'index']);
$router->get('/products/create', [ProductController::class, 'create']);
$router->post('/products', [ProductController::class, 'store']);
