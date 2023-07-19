<?php

namespace YafrmCore\Helpers;

final class Str
{
    public static function h(string $str): string
    {
        return htmlspecialchars($str);
    }
}
