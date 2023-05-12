<?php

// require base_path('Database.php');

use Core\Database;

$config = require base_path('config.php');

$db = new Database($config['database'], 'root', 'password');

$notes = $db->query("SELECT * FROM notes")->get();

view('notes/index.view.php', [
    'heading' => 'Notes',
    'notes' => $notes
]);