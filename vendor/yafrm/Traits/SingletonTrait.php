<?php

namespace YafrmCore\Traits;

trait SingletonTrait
{
    private static ?self $instance = null;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance(): static
    {
        return static::$instance ?? static::$instance = new static();
    }
}
