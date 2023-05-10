<?php

// Config
$config = require './config.php';

// Database
$db = new Database($config['database'], 'root', 'password');

$note = $db->query("SELECT * FROM notes WHERE id = ?", [$_GET['id']])->findOrFail();

authorize($note['user_id'] === 1, Response::FORBIDDEN);

require './views/notes/show.view.php';