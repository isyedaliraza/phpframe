<?php
namespace App\Core;

class App {
    protected static $register = [];

    public static function bind($key, $value) {
        static::$register[$key] = $value;
    }

    public static function get($key) {
        if (array_key_exists($key, static::$register)) {
            return static::$register[$key];
        }
        else {
            throw new Exception("No item bound to key {$key}");
        }
    }
}