<?php

namespace YafrmApp\Controllers\Front;

use YafrmCore\Classes\BaseController;

class MainController extends BaseController
{
    public function indexAction()
    {
        $this->setMeta(
            'Главная страница',
            'Описание главной страницы',
            'ключ1, ключ2, ключ3, ключ4, ключ5',
        );
        $this->set([
            'test' => 'test!'
        ]);
    }
}
