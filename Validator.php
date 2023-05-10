<?php

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) > $min && strlen($value) <= $max;
    }

    public static function email($valie)
    {
        return filter_var($valie, FILTER_VALIDATE_EMAIL);
    }
}
