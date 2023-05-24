<?php

namespace app\Models;

use Core\App;
use Core\Database;

class Model
{
    protected $table;
    protected $primaryKey = 'id';
    protected static $db;
    protected $data = [];

    public function __construct()
    {
        static::$db = App::resolve(Database::class);
    }

    public function get()
    {
        $collection = [];
        $query = "SELECT * FROM {$this->table}";
        $records = static::$db->query($query)->get();

        foreach ($records as $record) {
            $instance = $this->createInstanceFromRecord($record);
            $collection[] = $instance;
        }

        return $collection;
    }

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $record = static::$db->query($query, [$id])->find();

        if (!$record)
            return false;

        return $this->createInstanceFromRecord($record);
    }

    public function findWhere($column, $value)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        $record = static::$db->query($query, [$value])->find();

        return $this->createInstanceFromRecord($record);
    }

    public function findAllWhere($column, $value)
    {
        $collection = [];
        $query = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        $records = static::$db->query($query, [$value])->get();

        foreach ($records as $record) {
            $instance = $this->createInstanceFromRecord($record);
            $collection[] = $instance;
        }

        return $collection;
    }

    public function save($data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $params = array_values($data);

        $id = static::$db->query($query, $params)->lastInserted();
        $record = $this->find($id);

        return $record;
    }

    public function delete($id)
    {
        $instance = $this->find($id);
        if (!$instance)
            return false;

        $query = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        static::$db->query($query, [$id]);
        return true;
    }

    protected function createInstanceFromRecord($record)
    {
        $instance = new static();
        foreach ($record as $key => $value) {
            $instance->$key = $value;
        }

        return $instance;
    }

    public function __get($property)
    {
        return $this->data[$property] ?? null;
    }

    public function __set($property, $value)
    {
        $this->data[$property] = $value;
    }
}
