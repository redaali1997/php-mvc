<?php

namespace app\Controllers\Api;

use app\Models\TypeAttribute;

class TypeAttributeController
{
    public function index()
    {
        $typeId = $_GET['type_id'] ?? null;

        if ($typeId) {
            $attributes = (new TypeAttribute)->findAllWhere('type_id', $typeId);
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
            return;
        }

        echo null;
    }
}
