<?php

namespace app\Models;

class Product extends Model
{
    protected $table = 'products';
    protected $attributes = [];

    public function withAttributes()
    {
        $records = static::$db->query('
            select p.id, p.sku , p.name, p.price, i.value, t.name attribute_name, t.unit
            from products p
            join product_type_attributes i
            on p.id = i.product_id
            join type_attributes t
            on i.attribute_id = t.id;
        ')->get();

        $collection = [];
        foreach ($records as $record) {
            if (!array_key_exists($record['id'], $collection)) {
                $product = new $this;
                foreach ($record as $key => $value) {
                    if ($key == 'attribute_name' || $key == 'value') {
                        break;
                    };
                    $product->$key = $value;
                }
                $product->attributes[] = [
                    'name' => $record['attribute_name'],
                    'value' => $record['value'],
                    'unit' => $record['unit']
                ];
                $collection[$record['id']] = $product;
            } else {
                $collection[$record['id']]->attributes[] = [
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
        if (count($this->attributes) > 1) {
            $values = array_map(fn ($attribute) => $attribute['value'], $this->attributes);
            return 'Dimension: ' . implode('x', array_values($values));
        }

        $attribute = $this->attributes[0];
        return  $attribute['name'] . ': ' . $attribute['value'] . ' '. $attribute['unit'];
    }
}
