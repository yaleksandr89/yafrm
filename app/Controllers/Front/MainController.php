<?php

namespace YafrmApp\Controllers\Front;

use YafrmApp\Models\Front\Main;
use YafrmCore\Classes\BaseController;

/** @property Main $model */
class MainController extends BaseController
{
    public function indexAction(): void
    {
        $this->setMeta(
            'Главная страница',
            'Описание главной страницы',
            'ключ1, ключ2, ключ3, ключ4, ключ5',
        );
        $this->set([
            'test' => '<h1>test!</h1>'
        ]);
    }
}
