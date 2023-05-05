<?php

// Config
$config = require './config.php';

// Database
$db = new Database($config['database'], 'root', 'password');

$note = $db->query("SELECT * FROM notes WHERE id = ?", [$_GET['id']])->fetch();

require './views/note.view.php';