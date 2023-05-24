<?php

namespace Core;

class Token
{
    public static function generateSessionToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function destroySessionToken()
    {
        Session::destory('csrf_token');
    }

    public static function generateToken()
    {
        return bin2hex(random_bytes(32));
    }
}
