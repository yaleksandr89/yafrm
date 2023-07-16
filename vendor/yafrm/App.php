<?php

namespace YafrmCore;

use RuntimeException;
use YafrmCore\Classes\Registry;

class App
{
    public static Registry $app;

    public function __construct()
    {
        self::$app = Registry::getInstance();
        self::getParams();
    }

    private static function getParams(): void
    {
        $paramsFile = CONFIG_PATH . '/params.php';
        if (!file_exists($paramsFile)) {
            throw new RuntimeException("File $paramsFile not found");
        }

        $params = require $paramsFile;

        if (0 !== count($params)) {
            foreach ($params as $nameParam => $valueParam) {
                self::$app->setProperty($nameParam, $valueParam);
            }
        }
    }
}
