<?php

namespace app\Controllers;

use app\Models\Product;
use app\Models\ProductTypeAttribute;
use app\Models\Type;
use Core\Session;
use Core\Token;
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

        return view('home', compact('products', 'csrfToken'));
    }

    public function create()
    {
        $types = (new Type)->get();

        return view('create', compact('types', 'csrfToken'));
    }

    public function store()
    {
        if ($_SESSION['csrf_token'] !== $_POST['_token'])
            throw new \Exception('CSRF token error.');

        $rules = [
            'sku' => ['required', 'unique:products,sku'],
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'type_id' => ['required', 'numeric'],
            'attributes' => ['required', 'array']
        ];

        unset($_POST['_token']);
        $validator = Validator::make($_POST, $rules);

        if (empty($validator)) {
            $attributes = $_POST['attributes'];
            unset($_POST['attributes']);

            $product = $this->product->save($_POST);

            foreach ($attributes as $id => $value) {
                (new ProductTypeAttribute)->save([
                    'product_id' => $product->id,
                    'attribute_id' => $id,
                    'value' => $value
                ]);
            }

            header('location: /', 200);
            exit;
        }

        $types = (new Type)->get();

        return view('create', [
            'errors' => $validator,
            'data' => $_POST,
            'types' => $types
        ]);
    }

    public function delete()
    {
        $products = $_POST['products'];

        foreach ($products as $product)
            $this->product->delete($product);

        header('location: /', 200);
        exit;
    }
}
