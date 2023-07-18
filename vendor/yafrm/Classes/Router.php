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
        if (self::matchRoute($uri)){
            echo 'OK';
        } else {
            echo 'NOT OK';
        }

    }

    public static function matchRoute(string $uri): bool
    {
        foreach (self::getRoutes() as $pattern => $route) {
            if (preg_match("#$pattern#", $uri, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)){
                        $route[$k] = $v;
                    }
                }

                if (!array_key_exists('action', $route)) {
                    $route['action'] = 'index';
                }

                if (!array_key_exists('admin_prefix', $route)) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] = '\\';
                }

                $route['controller'] = self::toCamelCase($route['controller']);

                return true;
            }
        }

        return false;
    }

    public static function toCamelCase(string $name, bool $capitalizeFirstChar = true): string
    {
        $words = array_map('ucfirst', explode('-', $name));
        $result = implode('', $words);

        if (!$capitalizeFirstChar) {
            $result = lcfirst($result);
        }

        return $result;
    }
}
