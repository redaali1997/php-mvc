<?php

namespace Core;

class Session
{
    public static function get($name)
    {
        return $_SESSION[$name] ?? null;
    }

    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;

        return true;
    }

    public static function destory(string|array $names)
    {
        if (is_string($names)) {
            static::unsetSessionVariable($names);
        }

        if (is_array($names)) {
            foreach ($names as $name) {
                static::unsetSessionVariable($name);
            }
        }

        return false;
    }

    public static function destoryAll()
    {
        return session_destroy();
    }

    protected static function unsetSessionVariable($name)
    {
        if (!isset($_SESSION[$name]))
            return false;

        unset($_SESSION[$name]);
        return true;
    }
}
