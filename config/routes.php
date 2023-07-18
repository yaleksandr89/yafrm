<?php

use  YafrmCore\Classes\Router;

// Админка
Router::add('^admin/?$', [
    'controller' => 'Main',
    'action' => 'index',
    'admin_prefix' => 'admin',
]);

Router::add('^admin/?(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$', ['admin_prefix' => 'admin']);


// Фронт
Router::add('^$', [
    'controller' => 'Main',
    'action' => 'index',
]);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');