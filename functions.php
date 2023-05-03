<?php

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
