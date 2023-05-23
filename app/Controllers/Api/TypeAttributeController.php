<?php

namespace app\Controllers\Api;

use app\Models\TypeAttribute;

class TypeAttributeController
{
    public function index()
    {
        if (isset($_GET['type_id'])) {
            $attributes = (new TypeAttribute)->findAllWhere('type_id', $_GET['type_id']);
            $collection = [];
            foreach($attributes as $attribute)
            {
                $collection[$attribute->id] = [
                    'name' => $attribute->name,
                    'type' => $attribute->field_type,
                    'unit' => $attribute->unit
                ];
            }
            echo json_encode($collection);
        }

        echo null;
    }
}
