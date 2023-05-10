<?php

// Config
$config = require './config.php';

// Database
$db = new Database($config['database'], 'root', 'password');

$notes = $db->query("SELECT * FROM notes")->get();

require './views/notes/index.view.php';