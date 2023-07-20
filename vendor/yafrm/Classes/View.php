<?php

namespace YafrmCore\Classes;

use RedBeanPHP\R;
use RuntimeException;
use YafrmCore\Helpers\Str;

class View
{
    public string $content = '';

    public function __construct(
        public array $route,
        public ?string $layout,
        public string $view,
        public array $meta,
    ) {
        if (null !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render(mixed $data): void
    {
        if (is_array($data)) {
            extract($data);
        }

        // "Front\" => "Front/"
        $prefix = str_replace('\\', '/', $this->route['prefix']);

        $viewFile =
            VIEW_PATH
            . '/'
            . strtolower($prefix)
            . strtolower($this->route['controller'])
            . '/'
            . strtolower($this->view)
            . '.php';

        if (!is_file($viewFile)) {
            throw new RuntimeException("Вид: $viewFile не найден", 500);
        }

        ob_start();
        require_once $viewFile;
        $this->content = ob_get_clean();

        if (null !== $this->layout) {
            $layoutFile =
                VIEW_PATH
                . '/'
                . 'layouts/'
                . strtolower($prefix)
                . strtolower($this->layout)
                . '.php';

            if (!is_file($layoutFile)) {
                throw new RuntimeException("Шаблон: $layoutFile не найден", 500);
            }

            require_once $layoutFile;
        }
    }

    public function getMeta(): string
    {
        $title = Str::h($this->meta['title']);
        $description = Str::h($this->meta['description']);
        $keywords = Str::h($this->meta['keywords']);

        return <<<META
        <title>$title</title>
        <meta name="description" content="$description">
        <meta name="keywords" content="$keywords">
        META;
    }

    public function getDbLogs(): void
    {
        if ('dev' === DEBUG) {
            $log = R::getDatabaseAdapter()
                ->getDatabase()
                ->getLogger();

            if ($log) {
                $logs = array_merge(
                    $log->grep('SELECT'),
                    $log->grep('select'),
                    $log->grep('INSERT'),
                    $log->grep('insert'),
                    $log->grep('DELETE'),
                    $log->grep('delete'),
                    $log->grep('UPDATE'),
                    $log->grep('update'),
                    $log->grep('ALTER'),
                    $log->grep('alter'),
                );
                dump($logs);
            }
        }
    }

    public function getPart(string $path, ?array $data = null): void
    {
        if (is_array($data)) {
            extract($data);
        }

        $pathToFile = VIEW_PATH . '/' . $path . '.php';

        if (file_exists($pathToFile)) {
            require $pathToFile;
        } else {
            echo "Шаблон: <strong>$pathToFile<strong> не найден";
        }
    }
}
