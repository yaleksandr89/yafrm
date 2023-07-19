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
        // TODO: возможно есть способ лучше, динамически получать начало пространство именно (которое указывается в composer.json). Другого варианта не придумал :\
        $composerData = json_decode(file_get_contents(dirname(__DIR__, 3) . '/composer.json'), true);
        $appNamespace = $composerData['extra']['app_namespaces'];

        $parseUrl = parse_url($uri);
        $uriPath = $parseUrl['path'] ?? '';

        if (self::matchRoute($uriPath)) {
            $beginAppNamespace = array_key_first($appNamespace);

            $controller = $beginAppNamespace . 'Controllers\\'
                . self::$route['prefix']
                . self::$route['controller']
                . 'Controller';

            if (class_exists($controller)) {
                self::$route['begin_app_namespace'] = $beginAppNamespace;

                /** @var BaseController $objController */
                $objController = new $controller(self::$route);
                $objController->getModel();

                $action = self::toCamelCase(self::$route['action'], false) . 'Action';
                if (method_exists($objController, $action)) {
                    $objController->$action();
                    $objController->getView();
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

    private static function matchRoute(string $uri): bool
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

    private static function toCamelCase(string $name, bool $capitalizeFirstChar = true): string
    {
        $words = array_map('ucfirst', explode('-', $name));
        $result = implode('', $words);

        if (!$capitalizeFirstChar) {
            $result = lcfirst($result);
        }

        return $result;
    }
}
