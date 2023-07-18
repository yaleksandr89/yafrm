<?php

use YafrmCore\App;
require_once dirname(__DIR__) . '/config/init.php';

new App();

dump(\YafrmCore\Classes\Router::getRoutes());