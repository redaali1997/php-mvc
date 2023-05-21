<?php

use Core\Response;

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';

    die();
}

function currentUrl($path)
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] == $path ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white';
}

function asset($path)
{
    return __DIR__ . '/public/assets/' . $path;
}

function abort($status = Response::NOT_FOUND)
{
    http_response_code($status);

    view($status);

    die();
}

function authorize($condition, $status)
{
    if (!$condition)
        abort($status);
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/') . $path . '.view.php';
}
