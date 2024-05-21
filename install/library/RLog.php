<?php

namespace library;

use Ryantao\Logger\Logger;

/**
 * @method static void test(string $title, $context = [], string $type = 'info')
 */
class RLog
{
    public static function __callStatic($name, $arguments)
    {
        Logger::$name(...$arguments);
    }
}
