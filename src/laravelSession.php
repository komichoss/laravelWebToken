<?php

namespace komicho;

use komicho\Models\ModelSession;

class laravelSession
{
    public static function add($key, $value)
    {
        if(!isset($_COOKIE['sessionToken'])) {
            $token = md5(time());
        } else {
            $token = $_COOKIE['sessionToken'];
        }
        
        $exist = ModelSession::exist($token, $key);
        if ( $exist == false ) {
            setcookie('sessionToken', $token, time()+3600, '/');
            ModelSession::addValue($token, $key, $value);   
        } else {
            ModelSession::updateValue($token, $key, $value);
        }
    }
    
    public static function get($key)
    {
        if(!isset($_COOKIE['sessionToken'])) {
            $token = md5(time());
        } else {
            $token = $_COOKIE['sessionToken'];
            setcookie('sessionToken', $token, time()+3600, '/');
        }
        
        $exist = ModelSession::exist($token, $key);
        if ( $exist != false ) {
            return ModelSession::getValue($token, $key);   
        }
        return false;
    }
    
    public static function exists($key)
    {
        if(!isset($_COOKIE['sessionToken'])) {
            $token = md5(time());
        } else {
            $token = $_COOKIE['sessionToken'];
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
        if(!isset($_COOKIE['sessionToken'])) {
            $token = md5(time());
        } else {
            $token = $_COOKIE['sessionToken'];
        }
        
        $exist = ModelSession::exist($token, $key);
        if ( $exist != false ) {
            ModelSession::del($token, $key);
            setcookie('sessionToken', null, -1, '/');
        } else {
            return false;
        }
    }
}
