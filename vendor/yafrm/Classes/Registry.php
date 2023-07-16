<?php

namespace YafrmCore\Classes;

use YafrmCore\Traits\SingletonTrait;

class Registry
{
    use SingletonTrait;

    private static array $properties = [];

    public function setProperty(string $name, mixed $value): void
    {
        self::$properties[$name] = $value;
    }

    public function getProperty(string $name)
    {
        return self::$properties[$name] ?? null;
    }

    public function getProperties(): array
    {
        return self::$properties;
    }
}
