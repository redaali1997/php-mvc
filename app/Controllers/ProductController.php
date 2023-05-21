<?php

namespace app\Controllers;

use app\Models\Product;
use app\Models\Type;
use app\Repositories\ProductRepository;
use Core\App;
use Core\Database;
use Core\Validator;

class ProductController
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function index()
    {
        echo '<ul>';
        foreach (Product::all() as $product) {
            echo '<li>' . $product->id . ' - ' . $product->name . '</li>';
        }
        echo '</ul>';
        // dd($this->repository->index());
    }

    public function create()
    {
        $types = (new Type)->get();

        return view('create', compact('types'));
    }

    public function store()
    {
        $rules = [
            'sku' => ['required', 'unique:products,sku'],
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'type_id' => ['required', 'numeric'],
        ];

        $validator = Validator::make($_POST, $rules);
        
        if (empty($validator)) {
            Product::save($_POST);
            return header('location: /', 200);
        }

        dd($validator);
    }
}
