<?php

namespace app\Models;

use Core\App;
use Core\Database;

class Product
{
    private $data = [];

    public function __construct()
    {
        //
    }

    public static function all()
    {
        $db = App::resolve(Database::class);

        $products = $db->query('
            select p.id, p.sku, p.name, p.price, t.name as type
            from products p
            join types t
            on p.type_id = t.id
        ')->get();

        $collection = [];
        foreach ($products as $product) {
            $instance = new static();
            foreach ($product as $key => $value) {
                $instance->$key = $value;
            }

            $instance->attributes = $db->query(
                'select name, value 
                from product_type_attributes 
                where product_id = :id',
                ['id' => $instance->id]
            )->get();

            array_push($collection, $instance);
        }

        return $collection;
    }

    public static function save($data)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO products(sku, name, price, type_id) VALUES (:sku, :name, :price, :type_id)', [
            'sku' => $data['sku'],
            'name' => $data['name'],
            'price' => $data['price'],
            'type_id' => $data['type_id'],
        ]);
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
