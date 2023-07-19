<?php

namespace YafrmCore\Classes;

use RuntimeException;

abstract class BaseController
{
    public array $data = [];

    public array $meta = [
        'title' => '',
        'description' => '',
        'keywords' => '',
    ];

    public ?string $layout = '';

    public string $view = '';

    public object $model;

    public function __construct(
        public array $route = []
    ) {
    }

    public function getModel(): void
    {
        $model = $this->route['begin_app_namespace']
            . 'Models\\'
            . $this->route['prefix']
            . $this->route['controller'];

        if (!class_exists($model)) {
            throw new RuntimeException("Модель: $model не найдена", 500);
        }

        $this->model = new $model;
    }

    public function getView(): void
    {
        $this->view = $this->view ?: $this->route['action'];

        $objView = new View(
            $this->route,
            $this->layout,
            $this->view,
            $this->meta,
        );

        $objView->render($this->data);
    }

    public function set(array $data): void
    {
        $this->data = $data;
    }

    public function setMeta(string $title = '', string $description = '', string $keywords = ''): void
    {
        $this->meta = [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ];
    }
}
