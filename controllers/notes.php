<?php

// Config
$config = require './config.php';

// Database
$db = new Database($config['database'], 'root', 'password');

$notes = $db->query("SELECT * FROM notes")->fetchAll();

require './views/notes.view.php';