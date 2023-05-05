<?php
require './functions.php';
// require './router.php';
require './Database.php';

// Config
$config = require './config.php';

// Database
$db = new Database($config['database'], 'root', 'password');

// Sql Injection
$id = $_GET['id'];
$products = $db->query("SELECT * FROM products where id = :id", ['id' => $id])->fetchAll();
dd($products);