<?php

// require base_path('Response.php');
// require base_path('Database.php');

// Config

use Core\Database;
use Core\Response;

$config = require base_path('config.php');
$db = new Database($config['database'], 'root', 'password');

// dd($_POST);
if ($_POST['_method'] === 'DELETE') {

    $note = $db->query("SELECT * FROM notes WHERE id = ?", [$_GET['id']])->findOrFail();

    authorize($note['user_id'] === 1, Response::FORBIDDEN);

    $db->query('DELETE FROM notes where id = :id', ['id' => $note['id']]);

    header('location: /notes');
    die();

} else {
    $note = $db->query("SELECT * FROM notes WHERE id = ?", [$_GET['id']])->findOrFail();

    authorize($note['user_id'] === 1, Response::FORBIDDEN);
}

view('notes/show.view.php', [
    'heading' => $note['note'],
    'note' => $note
]);
