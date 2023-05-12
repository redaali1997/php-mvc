<?php

namespace controllers;

use Core\Database;

class NoteController {

    protected $db;

    public function __construct()
    {
        $config = require base_path('config.php');

        $this->db = new Database($config['database'], 'root', 'password');
    }

    public function index()
    {
        $notes = $this->db->query("SELECT * FROM notes")->get();

        return view('notes/index.view.php', [
            'heading' => 'Notes',
            'notes' => $notes
        ]);
    }
}