<?php

namespace Core;

class Validator
{
    public static function make($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rulesArray) {
            if (array_key_exists($field, $data)) {
                foreach ($rulesArray as $rule) {
                    [$ruleName, $option] = explode(':', $rule . ':');

                    $result = static::$ruleName($field, $data[$field], $option);

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

        [$table, $column] = explode(',', $option);

        $query = "SELECT * from $table where $column = ?";
        $record = $db->query($query, [$value])->exists();

        if ($record)
            return "Field $field must be unique.";

        return true;
    }

    public static function required($field, $value)
    {
        if (empty($value))
            return "Field " . $field . ' is required.';

        return true;
    }

    public static function string($field, $value)
    {
        if (!is_string($value))
            return "Field $field must be string.";

        return true;
    }

    public static function email($field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            return "Field $field must be email.";

        return true;
    }

    public static function numeric($field, $value)
    {
        if (!is_numeric($value))
            return "Field $field must be numeric.";

        return true;
    }

    public static function array($field, $value)
    {
        if (!is_array($value))
            return "Field $field must be array.";

        return true;
    }
}
