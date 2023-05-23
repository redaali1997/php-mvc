<?php

namespace app\Controllers;

use app\Models\Product;
use app\Models\ProductTypeAttribute;
use app\Models\Type;
use Core\Validator;

class ProductController
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function index()
    {
        $products = $this->product->withAttributes();

        return view('home', compact('products'));
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
            'attributes' => ['required', 'array']
        ];

        $validator = Validator::make($_POST, $rules);

        if (empty($validator)) {
            $attributes = $_POST['attributes'];
            unset($_POST['attributes']);

            $product = $this->product->save($_POST);

            foreach ($attributes as $id => $value) (new ProductTypeAttribute)->save([
                'product_id' => $product->id,
                'attribute_id' => $id,
                'value' => $value
            ]);
            return header('location: /', 200);
        }
dd($validator);
        $_SESSION['errors'] = $validator;
        $_SESSION['data'] = $_POST;

        return header('location: /add-product', 200);
    }
}
