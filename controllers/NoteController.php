<?php

namespace controllers;

use Core\App;
use Core\Container;
use Core\Database;
use Core\Response;

class NoteController
{

    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function index()
    {
        $notes = $this->db->query("SELECT * FROM notes")->get();

        return view('notes/index.view.php', [
            'heading' => 'Notes',
            'notes' => $notes
        ]);
    }

    public function show()
    {
        $note = $this->db->query("SELECT * FROM notes WHERE id = ?", [$_GET['id']])->findOrFail();

        authorize($note['user_id'] === 1, Response::FORBIDDEN);

        return view('notes/show.view.php', [
            'heading' => $note['note'],
            'note' => $note
        ]);
    }

    public function create()
    {
        return view('notes/create.view.php', ['heading' => 'Note Creating']);
    }
}
