<?php

namespace YafrmCore\Classes;

use JetBrains\PhpStorm\NoReturn;
use Throwable;
use YafrmCore\Helpers\Filesystem;

/**
 * @see https://habr.com/ru/articles/161483/
 */
class ErrorHandler
{
    public function __construct()
    {
        $this->checkExistenceOfConstants();

        if ('dev' === DEBUG) {
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    #[NoReturn]
    public function exceptionHandler(Throwable $throwable): void
    {
        $this->logError(
            $throwable->getMessage(),
            $throwable->getFile(),
            $throwable->getLine(),
        );

        $this->displayError(
            'Исключение',
            $throwable->getMessage(),
            $throwable->getFile(),
            $throwable->getLine(),
            $throwable->getCode()
        );
    }

    #[NoReturn]
    public function errorHandler(
        int|string $errno,
        string $errstr,
        string $errfile,
        string $errline,
    ): void {
        $this->logError(
            $errstr,
            $errfile,
            $errline,
        );

        $this->displayError(
            $errno,
            $errstr,
            $errfile,
            $errline,
        );
    }

    public function fatalErrorHandler(): void
    {
        $error = error_get_last();

        if (null !== $error && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    private function logError(string $message = '', string $file = '', string $line = ''): void
    {
        Filesystem::createFolderIfNotExist(LOGS_PATH);

        $currentDate = date('d-m-Y H:i:s');
        file_put_contents(
            LOGS_PATH . '/errors.log',
            <<< ERROR_LOG_TEXT
            [$currentDate]
            Текст ошибки: $message
            Файл: $file
            Строка: $line
            ===========
            
            ERROR_LOG_TEXT,
            FILE_APPEND
        );
    }

    #[NoReturn]
    private function displayError(
        int|string $errno,
        string $errstr,
        string $errfile,
        string $errline,
        int $response = 500
    ): void {
        if (0 === $errno) {
            $response = 404;
        }

        http_response_code($response);

        if (404 === $response && 'prod' === DEBUG) {
            require_once VIEW_PATH . '/errors/4xx.tpl.php';
            die;
        }

        if ('dev' === DEBUG) {
            require_once VIEW_PATH . '/errors/development.php';
        } else {
            require_once VIEW_PATH . '/errors/production.php';
        }

        die;
    }

    private function checkExistenceOfConstants(): void
    {
        if (!defined('DEBUG')) {
            define('DEBUG', 'prod');
        }

        if (!defined('VIEW_PATH')) {
            define('VIEW_PATH', dirname(__DIR__) . '/Views');
        }

        if (!defined('LOGS_PATH')) {
            define('LOGS_PATH', dirname(__DIR__, 3) . '/tmp/logs');
        }
    }
}
