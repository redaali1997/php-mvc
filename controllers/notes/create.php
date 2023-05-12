<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');

// Database
$db = new Database($config['database'], 'root', 'password');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!Validator::string($_POST['note'], 1, 100)) {
        $errors['note'] = 'The note body is required and minimum than 100';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes(note, user_id) VALUES(:note, :user_id)', [
            'note' => $_POST['note'],
            'user_id' => 1
        ]);
    }
}

view('notes/create.view.php', ['heading' => 'Note Creating', 'errors' => $errors]);
