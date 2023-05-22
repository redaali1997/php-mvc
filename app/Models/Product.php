<?php

namespace app\Models;

use Core\App;
use Core\Database;

class Product extends Model
{
    protected $table = 'products';
    protected $primary_key = 'id';
}
