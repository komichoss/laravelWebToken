<?php

namespace komicho;

use komicho\Models\ModelSession;

define('MAKETOKEN', md5(uniqid()));

class laravelWebToken
{
    private static $makeToken = MAKETOKEN;
    private static $sessionName = 'komicho_laravelWebToken';
    private static $sessionTime = 3600;

    public static function add($key, $value)
    {
        if(!isset($_COOKIE[self::$sessionName])) {
            $token = self::$makeToken;
        } else {
            $token = $_COOKIE[self::$sessionName];
        }

        $exist = ModelSession::exist($token, $key);
        if ( $exist == false ) {
            setcookie(self::$sessionName, $token, time()+self::$sessionTime, '/');
            ModelSession::addValue($token, $key, $value);
        } else {
            ModelSession::updateValue($token, $key, $value);
        }
    }

    public static function get($key)
    {
        if(!isset($_COOKIE[self::$sessionName])) {
            $token = self::$makeToken;
        } else {
            $token = $_COOKIE[self::$sessionName];
            setcookie(self::$sessionName, $token, time()+self::$sessionTime, '/');
        }

        $exist = ModelSession::exist($token, $key);
        if ( $exist != false ) {
            return ModelSession::getValue($token, $key);
        }
        return false;
    }

    public static function getToken()
    {
        if(!isset($_COOKIE[self::$sessionName])) {
            $token = self::$makeToken;
        } else {
            $token = $_COOKIE[self::$sessionName];
            setcookie(self::$sessionName, $token, time()+self::$sessionTime, '/');
        }
        return $token;
    }

    public static function exists($key)
    {
        if(!isset($_COOKIE[self::$sessionName])) {
            $token = self::$makeToken;
        } else {
            $token = $_COOKIE[self::$sessionName];
        }

        $exist = ModelSession::exist($token, $key);
        if ( $exist != false ) {
            return true;
        } else {
            return false;
        }
    }

    public static function delete($key)
    {
        if(!isset($_COOKIE[self::$sessionName])) {
            $token = self::$makeToken;
        } else {
            $token = $_COOKIE[self::$sessionName];
        }

        $exist = ModelSession::exist($token, $key);
        if ( $exist != false ) {
            ModelSession::del($token, $key);
            setcookie(self::$sessionName, null, -1, '/');
        } else {
            return false;
        }
    }
}
