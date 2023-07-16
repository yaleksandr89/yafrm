<?php

try {
    require_once dirname(__DIR__) . '/config/init.php';

    dump(PATH_CONSTANTS);
    dump(URL_CONSTANTS);
} catch (Exception $exception) {
    dd("ПРОИЗОШЛО ИСКЛЮЧЕНИЕ:\r\n\r\n\r\n$exception");
} catch (Error $error) {
    dd("ПРОИЗОШЛА ОШИБКА:\r\n\r\n\r\n$error");
}
