<?php

use app\Controllers\Api\TypeAttributeController;
use app\Controllers\ProductController;

$router->get('/', [ProductController::class, 'index']);
$router->get('/add-product', [ProductController::class, 'create']);
$router->post('/add-product', [ProductController::class, 'store']);
$router->delete('/products', [ProductController::class, 'delete']);
$router->get('/api/type-attributes', [TypeAttributeController::class, 'index']);
