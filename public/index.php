<?php

use YafrmCore\App;

try {
    require_once dirname(__DIR__) . '/config/init.php';
    new App();
    dump('OK');

} catch (Exception $exception) {
    dd("ПРОИЗОШЛО ИСКЛЮЧЕНИЕ:\r\n\r\n\r\n$exception");
} catch (Error $error) {
    dd("ПРОИЗОШЛА ОШИБКА:\r\n\r\n\r\n$error");
}
