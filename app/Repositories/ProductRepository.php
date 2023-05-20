<?php

namespace app\Repositories;

use Core\App;
use Core\Database;

class ProductRepository
{

    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function index()
    {
        $products = $this->db->query('
            select p.id, p.sku, p.name, p.price, t.name as type
            from products p
            join types t
            on p.type_id = t.id
        ')->get();
        dd($products);

        return $products;
    }
}
