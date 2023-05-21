<?php

namespace app\Models;

use Core\App;
use Core\Database;

class Model
{
    protected $table;
    protected $primary_key;
    protected static $db;
    protected $data = [];

    public function __construct()
    {
        static::$db = App::resolve(Database::class);
    }

    public function get()
    {
        $collection = [];
        $records = static::$db->query("SELECT * from {$this->table}")->get();
        foreach ($records as $record) {
            $instance = new $this;
            foreach ($record as $key => $value) {
                $instance->$key = $value;
            }
            $collection[] = $instance;
        }

        return $collection;
    }

    public function find($id)
    {
        $record = static::$db->query("SELECT * from {$this->table} WHERE {$this->primary_key} = {$id}")->find();
        $instance = new $this;
        foreach ($record as $key => $value)
            $instance->$key = $value;

        return $instance;
    }

    public function __get($property)
    {
        if (array_key_exists($property, $this->data))
            return $this->data[$property];

        return null;
    }

    public function __set($property, $value)
    {
        $this->data[$property] = $value;
    }
}
