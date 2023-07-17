<?php

use YafrmCore\Classes\ErrorHandler;

/**
 * @var $errno ErrorHandler
 * @var $errstr ErrorHandler
 * @var $errfile ErrorHandler
 * @var $errline ErrorHandler
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>
<div>
    <p>Используется базовый шаблон 404 страницы</p>
    <p>Пожалуйста переопределите его, создав в своем приложение константу <strong>VIEW_PATH</strong> и указав путь до шаблона</p>
</div>
<hr>
<h1>Произошла ошибка</h1>
<p><b>Код ошибки:</b> <?= $errno ?></p>
<p><b>Текст ошибки:</b> <?= $errstr ?></p>
<p><b>Файл, в котором произошла ошибка:</b> <?= $errfile ?></p>
<p><b>Строка, в которой произошла ошибка:</b> <?= $errline ?></p>

</body>
</html>