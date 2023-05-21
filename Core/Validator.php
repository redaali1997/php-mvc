<?php

namespace Core;

class Validator
{
    public static function make($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $value) {
            if (array_key_exists($field, $data)) {
                foreach ($value as $rule) {
                    $rule = explode(':', $rule);
                    $rule_name = $rule[0];
                    $result = static::$rule_name($field, $data[$field], $rule[1] ?? null);
                    if (is_string($result)) {
                        $errors[$field] = $result;
                    }
                }
            } else {
                return $field . ' field doesn\'t exist.';
            }
        }

        return $errors;
    }

    public static function unique($field, $value, $option)
    {
        $db = App::resolve(Database::class);

        $option = explode(',', $option);

        $record = $db->query("SELECT * from $option[0] where $field = '$value'")->exists();

        if ($record)
            return "Field $field must be unique";

        return true;
    }

    public static function required($field, $value)
    {
        if (empty(trim($value)))
            return "Field " . $field . ' is required';

        return true;
    }

    public static function string($field, $value)
    {
        if (!is_string($value))
            return "Field $field must be string";

        return true;
    }

    public static function email($field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            return "Field $field must be email";

        return true;
    }

    public static function numeric($field, $value)
    {
        if (!is_numeric($value))
            return "Field $field must be numeric";

        return true;
    }
}
