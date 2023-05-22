<?php

namespace Core;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username, $password)
    {
        $dsn = "mysql:" . http_build_query($config, '', ';');
        $this->connection = new \PDO($dsn, $username, $password, [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
    }

    public function query($statement, $params = [])
    {
        $this->statement = $this->connection->prepare($statement);
        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result)
            abort(404);

        return $result;
    }

    public function exists()
    {
        return !empty($this->find());
    }

    public function lastInserted()
    {
        return $this->connection->lastInsertId();
    }
}
