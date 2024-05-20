<?php

namespace Ryantao\Logger;

use Ryantao\support\Log;

/**
 * @method static void test(string $title, $context = [], string $type = 'info')
 */
class Logger
{
    protected static $defaultLevel = 'info';

    /**
     * @throws Throwable
     */
    public static function __callStatic($name, $arguments)
    {
        $title = $arguments[0] ?? "";
        $level = $arguments[2] ?? static::$defaultLevel;
        $context = $arguments[1] ?? [];
        try {
            $logChannel = Log::channel($name);
        } catch (Throwable $e) {
            if ($e->getMessage() === 'Undefined index: ' . $name) {
                if (!in_array($name, config('log.channel', []), true)) {
                    throw new InvalidArgumentException('请先在 config/log.php 配置中配置 channels');
                }
                return;
            }
            throw $e;
        }
        if ($arguments[0] === 'line') {
            $line = str_repeat('=', 100);
            $logChannel->log($level, $line);
        } else {
            $logChannel->log($level, date('Y-m-d H:i:s') . " >>> " . $title . " >>> " . self::formatMessage($context));
        }
    }

    /**
     * 格式化日志信息
     * @param $context
     * @return string
     */
    protected static function formatMessage($context): string
    {
        if (is_array($context)) {
            $context = json_encode($context, 320);
        }
        return $context;
    }
}

Logger::test("测试标题", ["a" => "a", "b" => "b", "c" => "c"]);