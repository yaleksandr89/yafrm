<?php

try {
    require_once dirname(__DIR__) . '/vendor/autoload.php';

    dump(ARRAY_PATH);
} catch (Exception $exception) {
    echo "Произошло исключение:";
    dd($exception);
} catch (Error $error) {
    echo "Произошла ошибка:";
    dd($error);
}
