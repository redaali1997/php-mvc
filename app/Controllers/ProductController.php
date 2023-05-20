<?php

namespace app\Controllers;

use app\Models\Product;
use app\Repositories\ProductRepository;
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
        dd('dd');
        // return view('create.php');
    }

    public function store()
    {
        $rules = [
            'sku' => ['required', 'unique:products,sku'],
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'type_id' => ['required', 'numeric'],
        ];

        $data = [
            'sku' => 'test-create-2',
            'name' => 'Test create 2',
            'price' => 2,
            'type_id' => 1,
        ];

        $validator = Validator::make($data, $rules);
        dd($validator);
        if (empty($validator)) {
            Product::save($data);
            return header('location: /', 200);
        }
    }
}
