<?php

namespace app\Models;

class Product extends Model
{
    protected $table = 'products';
    protected $attributes = [];

    public function withAttributes()
    {
        $query = "
            SELECT p.id, p.sku , p.name, p.price, i.value, t.name attribute_name, t.unit
            FROM products p
            JOIN product_type_attributes i ON p.id = i.product_id
            JOIN type_attributes t ON i.attribute_id = t.id;
        ";
        $records = static::$db->query($query)->get();

        $collection = [];
        foreach ($records as $record) {
            $id = $record['id'];
            if (!isset($collection[$id])) {
                $product = $this->createInstanceFromRecord($record);

                $product->attributes[] = [
                    'name' => $record['attribute_name'],
                    'value' => $record['value'],
                    'unit' => $record['unit']
                ];
                $collection[$id] = $product;
            } else {
                $collection[$id]->attributes[] = [
                    'name' => $record['attribute_name'],
                    'value' => $record['value'],
                    'unit' => $record['unit']
                ];
            }
        }
        return array_values($collection);
    }

    public function attributes()
    {
        $attributeCount = count($this->attributes);

        if ($attributeCount > 1) {
            $values = array_column($this->attributes, 'value');
            return 'Dimension: ' . implode('x', $values);
        }

        if ($attributeCount === 1) {
            $attribute = $this->attributes[0];
            return $attribute['name'] . ': ' . $attribute['value'] . ' ' . $attribute['unit'];
        }

        return '';
    }
}
