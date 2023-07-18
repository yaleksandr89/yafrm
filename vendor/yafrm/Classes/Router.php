<?php

namespace YafrmCore\Classes;

class Router
{
    private static array $routes = [];

    private static array $route = [];

    public static function add(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$routes;
    }

    public static function dispatch(string $uri)
    {
        dump($uri);
    }
}
