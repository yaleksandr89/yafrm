<?php

use  YafrmCore\Classes\Router;

/**
 * 'controller' - название класса с его неймспейсом
 * 'action' - экшен, который будет вызван
 * 'prefix' - отвечает за то, где будет расположены контроллер: 'YafrmApp\Controllers\Front', 'YafrmApp\Controllers\Admin' и т.д.
 */

// Админка
Router::add('^admin/?$', [
    'controller' => 'Main',
    'action' => 'index',
    'prefix' => 'admin',
]);

Router::add('^admin/?(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$', ['prefix' => 'admin']);


// Фронт
Router::add('^$', [
    'controller' => 'Main',
    'action' => 'index',
    'prefix' => 'front',
]);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$', ['prefix' => 'front']);
