<?php

namespace Core;

class Container
{

    protected $bindings = [];

    public function bind($key, $func)
    {
        $this->bindings[$key] = $func;
    }

    public function resolve($key)
    {
        $func = $this->bindings[$key];

        return call_user_func($func);
    }
}
