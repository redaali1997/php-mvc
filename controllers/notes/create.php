<?php
$heading = 'Note Creating';

require './Validator.php';
// Config
$config = require './config.php';

// Database
$db = new Database($config['database'], 'root', 'password');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    if(! Validator::string($_POST['note'], 1, 100)) {
        $errors['note'] = 'The note body is required and minimum than 100';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes(note, user_id) VALUES(:note, :user_id)', [
            'note' => $_POST['note'],
            'user_id' => 1
        ]);
    }
}

require "./views/notes/create.view.php";
