<?php

namespace YafrmCore\Classes;

use RedBeanPHP\R;
use RedBeanPHP\RedException;
use RuntimeException;
use YafrmCore\Traits\SingletonTrait;

class DB
{
    use SingletonTrait;

    /**
     * @throws RedException
     */
    private function __construct()
    {
        $dbConfigPath = CONFIG_PATH . '/db.php';

        if (!file_exists($dbConfigPath)) {
            throw new RuntimeException("Файл: '$dbConfigPath' для подключения к БД не найден", 500);
        }

        $dbConfigFile = require $dbConfigPath;

        R::setup($dbConfigFile['dns'], $dbConfigFile['user'], $dbConfigFile['password']);

        if (!R::testConnection()) {
            throw new RuntimeException('Не удалось установить подключение с БД', 500);
        }

        R::freeze(true);

        if ('dev' === DEBUG) {
            R::debug(true, 3);
        }
    }
}
