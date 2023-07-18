<?php

namespace YafrmCore\Classes;

use RuntimeException;

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

    public static function dispatch(string $uri): void
    {
        if (self::matchRoute($uri)) {
            $controller = 'YafrmApp\Controllers\\'
                . self::$route['prefix']
                . self::$route['controller']
                . 'Controller';

            if (class_exists($controller)) {
                $objController = new $controller(self::$route);
                $action = self::toCamelCase(self::$route['action'], false) . 'Action';

                if (method_exists($objController,$action)){
                    $objController->$action();
                } else {
                    throw new RuntimeException("Метод: $controller::$action не найден", 404);
                }
            } else {
                throw new RuntimeException("Контроллер: $controller не найден", 404);
            }
        } else {
            throw new RuntimeException('Страница не найдена', 404);
        }
    }

    public static function matchRoute(string $uri): bool
    {
        foreach (self::getRoutes() as $pattern => $route) {
            if (preg_match("#$pattern#", $uri, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }

                if (!array_key_exists('action', $route)) {
                    $route['action'] = 'index';
                }

                if (!array_key_exists('prefix', $route)) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] = ucfirst($route['prefix']) . '\\';
                }

                $route['controller'] = self::toCamelCase($route['controller']);
                self::$route = $route;

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
